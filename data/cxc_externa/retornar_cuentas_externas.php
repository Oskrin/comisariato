<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select CC.fecha_actual, CC.hora_actual, U.nombre_usuario, U.apellido_usuario, C.id_cliente, C.identificacion, C.nombres_cli, CC.num_factura, CC.tipo_documento, CC.total from c_cobrarexternas  CC, clientes C, usuario U where U.id_usuario = CC.id_usuario and C.id_cliente = CC.id_cliente and CC.comprobante='" . $id . "'");
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
}
echo json_encode($arr_data);
?>
