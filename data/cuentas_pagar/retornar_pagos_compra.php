<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select  P.fecha_actual, P.hora_actual, U.nombre_usuario, U.apellido_usuario, PR.id_proveedor, PR.tipo_documento, PR.identificacion_pro, PR.empresa_pro, P.forma_pago, P.tipo_pago from pagos_pagar P, proveedores PR, usuario U where P.id_proveedor = PR.id_proveedor and P.id_usuario=U.id_usuario and P.comprobante='" . $id . "'");
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
