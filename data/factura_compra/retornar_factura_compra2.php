<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select D.cod_productos, P.codigo, P.articulo, D.cantidad, D.precio_compra, D.descuento_producto, D.total_compra, P.iva, P.incluye_iva, P.incluye_iva from factura_compra F, detalle_factura_compra D, productos P where D.cod_productos = P.cod_productos and F.id_factura_compra = D.id_factura_compra and D.id_factura_compra='" . $id . "'");
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
