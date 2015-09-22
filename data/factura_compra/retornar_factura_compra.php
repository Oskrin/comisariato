<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select F.id_factura_compra, F.fecha_actual, F.hora_actual, U.nombre_usuario, U.apellido_usuario, P.id_proveedor, P.tipo_documento, P.identificacion_pro, P.empresa_pro, F.tipo_comprobante, F.fecha_registro, F.fecha_emision, F.fecha_caducidad, F.num_serie, F.num_autorizacion, F.fecha_cancelacion, F.forma_pago, F.tarifa0, F.tarifa12, F.iva_compra, F.descuento_compra, F.total_compra from factura_compra F, proveedores P, usuario U where F.id_usuario = U.id_usuario and P.id_proveedor = F.id_proveedor and F.id_factura_compra='" . $id . "'");
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
    $arr_data[] = $row[18];
    $arr_data[] = $row[19];
    $arr_data[] = $row[20];
    $arr_data[] = $row[21];
}
echo json_encode($arr_data);
?>
