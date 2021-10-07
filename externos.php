<?php

$cfg['db_host']="127.0.0.1";
$cfg['db_user']="root";
$cfg['db_password']="";
$cfg['db_database_name']="prueba";
$cfg['db_port']="3306";

header('Content-Type: text/html; charset=UTF-8');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_name("sistema-de-prueba");
session_start();

error_reporting(E_ALL & ~E_NOTICE);

require_once("php/db_mysql.php");


date_default_timezone_set('America/Bogota'); /* Ajustar zona horaria a colombia */
setlocale(LC_ALL, "esm", "es_CO.utf8"); /* Configuracion regional a Español */

$db = new db_mysql();
@$db->pconnect($cfg['db_host'], $cfg['db_user'], $cfg['db_password'], $cfg['db_database_name'], $cfg['db_port']);

if ($db->connect_error()) {
    echo "<h1>Error de conexión con el servidor de base de datos.</h1>";
    exit(0);
}



?>