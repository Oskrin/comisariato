<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['id2'];
$arr_data = array();

$consulta = pg_query("select P.cod_productos, P.codigo, P.articulo, P.stock, D.cantidad, D.precio_venta, D.descuento_venta, D.total_venta, P.iva, P.incluye_iva from productos P, detalle_proforma D, proforma PR where P.cod_productos = D.cod_productos and PR.id_proforma = D.id_proforma and PR.estado ='Activo'  and D.estado= 'Activo' and D.id_proforma='" . $id . "'");
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
