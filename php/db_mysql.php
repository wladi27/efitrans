<?php
require_once("db_general.php");

class db_mysql extends db_base
{
 	public function __construct()
	{
 	}
	
	function connect($host,$username,$passwd,$dbname,$port) 
	{
 		$this->link_identifier=mysqli_connect ($host,$username,$passwd,$dbname,$port);
		return $this->link_identifier;
	}
	
	function pconnect ($host,$username,$passwd,$dbname,$port) 
	{
 		$this->link_identifier=mysqli_connect ($host,$username,$passwd,$dbname,$port);
		return $this->link_identifier;	 
	}
	
	function connect_error() 
	{
		return mysqli_connect_error();
	}
	
	function close() 
	{
 		return mysqli_close ($this->link_identifier);
	}
	
	function select_db ($database_name) 
	{
		return true;
	}
	
	function query ($query) 
	{
 		return mysqli_query ( $this->link_identifier, $query); 	
	}

	function error () 
	{
 		return mysqli_error($this->link_identifier );	
	}
	
	function affected_rows () 
	{
 		return mysqli_affected_rows ($this->link_identifier); 
	}
	
	function last_insert_id ($sequence=NULL) 
	{
		return mysqli_insert_id($this->link_identifier);
	}
	
	function result ($result, $row, $field = NULL) 
	{	
		//return mysqli_fetch_result($result, $row, $field);
	}
	
	function num_rows ($result) 
	{
		return mysqli_num_rows($result);	
	}
	
	function fetch_row ($result) 
	{
		return mysqli_fetch_row($result);
	}
	
	function fetch_array ($result, $result_type = MYSQLI_BOTH ) 
	{
		return mysqli_fetch_array($result, $result_type);
	
	}
	
	function fetch_assoc ($result) 
	{
		return mysqli_fetch_assoc($result);
	}
	
	function fetch_object ($result, $class_name = NULL, array $params = NULL) 
	{
		return mysqli_fetch_object ($result, $class_name, $params);
	}
	
	function data_seek ($result, $row_number) 
	{
		return mysqli_data_seek($result,$row_number);
	}
	
	function free_result ($result) 
	{
		return mysqli_free_result($result);
	}
	
	function escape_string ($unescaped_string) 
	{
		if( is_array($unescaped_string) ) return $unescaped_string;
		return mysqli_real_escape_string($this->link_identifier,$unescaped_string);
	}
	
	function set_charset ($charset) 
	{
		return mysqli_set_charset($this->link_identifier,$charset);
	}
	
	function num_fields($result)
	{
		return mysqli_num_fields($result);
	}
	
	function field_name($result,$field_number)
	{
		//return mysqli_field_name($result,$field_number);
	}

	function fetch_field($result) {
		return mysqli_fetch_field($result);
	}
		
	
}

?>