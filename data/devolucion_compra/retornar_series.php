<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$arr_data = array();

$consulta = pg_query("select * from series_compra where cod_productos = '$_GET[cod]' and id_factura_compra = '$_GET[num]' and estado = 'Activo' order by id_serie asc");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[3];
}
echo json_encode($arr_data);
?>
