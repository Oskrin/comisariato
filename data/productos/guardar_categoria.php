<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from categoria where nombre_categoria='" . strtoupper($_POST[nombre_categoria]) . "'");
while ($row = pg_fetch_row($consulta)) {
    $repe++;
}
///////////////////////////////////////////////
if ($repe == 0) {
///////////////contador categoria//////////////////
    $consulta = pg_query("select max(id_categoria) from categoria");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;
/////////////////////////////////////////////////
////////////////guardar categoria//////////////
    pg_query("insert into categoria values('$cont','" . strtoupper($_POST[nombre_categoria]) . "','Activo')");
    $data = 1;
/////////////////////////////////////////////
}else{
   $data = 0; 
}
echo $data;
?>
