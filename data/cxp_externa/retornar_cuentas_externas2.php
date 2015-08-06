<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select CP.fecha_actual, CP.hora_actual, U.nombre_usuario, U.apellido_usuario, P.tipo_documento, P.id_proveedor, P.identificacion_pro, P.empresa_pro, CP.num_factura, CP.tipo_documento, CP.total from c_pagarexternas  CP, proveedores P, usuario U where U.id_usuario = CP.id_usuario and P.id_proveedor = CP.id_proveedor and CP.comprobante='" . $id . "'");
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
}
echo json_encode($arr_data);
?>
