<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select I.fecha_actual, I.hora_actual, U.nombre_usuario, U.apellido_usuario, I.origen, I.destino, I.observaciones, I.tarifa0, I.tarifa12, I.iva_ingreso, I.descuento_ingreso, I.total_ingreso from ingresos I, usuario U where I.id_usuario = U.id_usuario and I.id_ingresos='" . $id . "'");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[0];
    $arr_data[] = $row[1];
    $arr_data[] = $row[2];
    $arr_data[] = $row[3];
    $arr_data[] = $row[4];
    $arr_data[] = $row[5];
    $arr_data[] = $row[6];
    $arr_data[] = $row[7];
    $arr_data[] = $row[8];
    $arr_data[] = $row[9];
    $arr_data[] = $row[10];
    $arr_data[] = $row[11];
}
echo json_encode($arr_data);
?>
