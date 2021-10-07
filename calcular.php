<?php
require_once("php/validation.php");

$v = new Validation($_POST);
$v->addRules('buscar', 'Ingrese direccion', array('required' => true, 'maxLength' => 300) );
// se pueden añadir mas campos....

    $result = $v->validate();

        if ($result['messages'] == "") {//No hay errores de validacion
           // return true;
        } else { //Errores de validación
            $r['error'] = true;
            $r['msg'] = $result['messages'];
            $r['bad_fields'] = $result['bad_fields'];
            $r['errors'] = $result['errors'];
            echo json_encode($r);
            exit(0);
        }
       
 
$t="";

$t.='<table border="0" width="98%"> 
    <tr id="trecibe">
    <td>  <b id="t1"> 45 </b></td>
    <td>  <b id="u1" style="font-size:24px;color:"> 105</b> </td>
    <td>  <b id="v1"> $42.000 </b></td> </tr>
    </table>';

$t2="";

$t2.='   <table width="98%" border="0">
    <tr>
    
    <td ><b class="textos"> Tiempo </b> </td>
    <td ><b class="textos"> Unidades</b> </td>
    <td> <b class="textos"> Valor</b> </td>
    
    </tr>

    <tr>

    <td> <b id="t2" style="color:#B20000"></td>
    <td> <b id="u2" style="font-size:44px;color:#4ba614"></td>
    <td> <b id="v2" style="color:#FF0000"></td>
    
    </tr>
</table>';


            $r['error'] = false;
            $r['msg'] = $t;
            $r['tabla2'] = $t2;
            $r['errors'] = $result['errors'];
            echo json_encode($r);
            exit(0);


?>