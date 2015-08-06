<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['cod'];
$arr_data = array();

$consulta = pg_query("select * from series_compra  where cod_productos='" . $id . "' and estado='Activo'");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[3];
}
echo json_encode($arr_data);
?>
