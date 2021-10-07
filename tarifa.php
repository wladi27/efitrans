<?php
//require_once("externos.php");
//require_once("php/validation.php");


//$val=$_POST['val'];
                    
$val=$_POST['val'];
 /*
$s='SELECT * FROM tarifas';
$rs=$db->query($s);
$rw=$db->fetch_assoc($rs);
*/
//$valor=$rw['valor'] + $val;

$valor=20000 + $val;
$unidad = $valor/20000;

 $r['error'] = false;
            $r['msg'] = "mensaje";
            $r['valor'] = $valor;
            $r['unidades']=$unidad;
            $r['errors'] = $result['errors'];
            echo json_encode($r);
            exit(0);




?>