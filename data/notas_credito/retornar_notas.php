<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select  D.fecha_actual, D.hora_actual, U.nombre_usuario, U.apellido_usuario, C.id_cliente, C.tipo_documento, C.identificacion, C.nombres_cli, C.celular, C.direccion_cli, D.tipo_comprobante, D.num_serie, D.observaciones, D.tarifa0, D.tarifa12, D.iva_venta, D.descuento_venta, D.total_venta  from devolucion_venta D, clientes C, usuario U where D.id_usuario = U.id_usuario and D.id_cliente = C.id_cliente and D.id_devolucion_venta='" . $id . "'");
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
    $arr_data[] = $row[12];
    $arr_data[] = $row[13];
    $arr_data[] = $row[14];
    $arr_data[] = $row[15];
    $arr_data[] = $row[16];
    $arr_data[] = $row[17];
}
echo json_encode($arr_data);
?>
