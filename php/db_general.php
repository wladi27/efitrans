<?php
class db_base
{
	protected $link_identifier;
 
	function select_limit($sql,$numrows,$offset=0)
	{
		$sql.=" LIMIT $numrows OFFSET $offset";
		return $this->query($sql);
	}
	
	function select_row($sql) 
	{
		$result=$this->select_limit($sql,1,0);
		if($row=$this->fetch_assoc($result) )
		{
			return $row;
		}
		else
		{
			return NULL;
		}
	}
	
	function select_one($sql) 
	{
		
		$result=$this->select_limit($sql,1,0);
		if($row=$this->fetch_row($result) )
		{
			return $row[0];
		}
		else
		{
			return NULL;
		}
	}
	
	function fetch_all($result)
	{
		$r=array();
		while($row=$this->fetch_assoc($result))
		{
			$r[]=$row;
		}
		return $r;	
	}
	
	function select_all($sql) 
	{
		
		$result=$this->query($sql);
		$r=array();
	
		while($row=$this->fetch_assoc($result))
		{
			$r[]=$row;
		}
		return $r;	
	}
	
 
	function make_insert($table,$array,$empty_is_null=true)
	{
		$campos="";
		$valores="";
		foreach ($array as $campo => $valor)
		{
			$campos .= "$campo,";
			if( ($valor=="NULL" || $valor==NULL) || ($empty_is_null==true && trim($valor)=="") )
			{
				$valores .= "NULL,";
			}
			else
			{
				$valores .= "'$valor',";
			}
		}
		$campos=trim($campos, ", ");
		$valores=trim($valores, ", ");
		$sql="insert into $table ($campos) values($valores)";
		return $sql;
	}
	
	function insert($table,$array,$empty_is_null=true)
	{
		$sql=$this->make_insert($table,$array,$empty_is_null);
		$this->query($sql);
	}
	
	function make_update($table,$array,$empty_is_null=true)
	{
		$sql="update " . $table . " set  ";
		foreach ($array as $campo => $valor)
		{
			if( ($valor=="NULL" || $valor==NULL) || ($empty_is_null==true && trim($valor)=="") )
			{
				$sql.= $campo. " = NULL, ";
			}
			else
			{
				$sql.= $campo. " = '" . $valor . "', ";
			}
		}
		$sql=trim($sql,", "); //Permire borrar la ultima coma (,) y los espacios  que quedan al final	
		return $sql;
	}
	
	function count_rows($sql)
	{
		$pos=strripos($sql,"from ");
		if($pos!==false)
		{
			$sql=substr($sql,$pos);
		}		
 
		$pos=strripos($sql,"order by ");
		if($pos!==false)
		{
			$sql=substr($sql,0,$pos);
		}
		$sql="select count(*) " . $sql;
 
		return $this->select_one($sql);	
	}
	
	function list_rows($sql,$titulo=true)
	{
		$rs=@$this->query_assoc($sql);
		
		$fila="";
		$num=@$this->num_fields($rs);
		//Imprimir titulos
		if($titulo==true)
		{
			for($i=0;$i<$num;$i++)
				$fila.=@$this->field_name($rs,$i) . "\t";
			echo trim($fila,"\t") . "\n";
		}
		//Imprimir datos
		while( $rw=@$this->fetch_row($rs) )
		{
			$fila="";
			for($i=0;$i<$num;$i++) {
				$fila.=$rw[$i] . "\t";
			}
			echo trim($fila,"\t") . "\n";
		}	
	}
	
	function query_json_table($sql)
	{
		$data=$this->select_all($sql);
		return  json_encode($data) ;
	}
	
	function select_json($sql)
	{
		return $this->query_json_table($sql);
	}

	function exportar_excel($sql)
	{
	 
		$rs=$this->query($sql);
	 
		echo "<table style='border-collapse:collapse' border='1'>";
		echo "<tr>";
 
		while($f = $this->fetch_field($rs) )
		{
			echo "<th>".  $f->name. "</th>";
		}
		echo "</tr>";
		
		while( $rw= $this->fetch_row($rs) )
		{
			echo "<tr>";
			for($i=0;$i<count($rw);$i++)
			{
				echo "<td>".  $rw[$i]. "</td>";			
			}
			echo "</tr>";
		
		}
		echo "</table>";
		
	}
	
	function exportar_csv($sql)
	{
		$rs=$this->query($sql);
		while($f = $this->fetch_field($rs) )
		{
			echo $f->name. ";";
		}
		echo "\n";
		while( $rw= $this->fetch_row($rs) )
		{
			for($i=0;$i<count($rw);$i++)
			{
				echo   $rw[$i]. ";";			
			}
			echo "\n";
		}
	}
	
	function fill_select ($sql,$blanco=false)
	{ 
		if($blanco==true)
			echo '<option value=""></option>';
			
		$rs = @$this->query($sql);	
		while( $rw = @$this->fetch_row($rs) )
		{
			echo '<option value="'. $rw[0] .'">'. $rw[1] . '</option>';
		}
	}
}
?>