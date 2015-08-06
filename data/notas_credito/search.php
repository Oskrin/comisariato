<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$codigo_barras = $_GET["codigo_barras"];
$arr_data = array();

if ($codigo_barras != "") {
    $consulta = pg_query("select P.cod_productos, P.codigo, P.cod_barras, P.articulo, D.precio_venta, D.cantidad, D.descuento_producto, P.iva, P.series, D.estado, P.incluye_iva from factura_venta F, detalle_factura_venta D, productos P where D.cod_productos = P.cod_productos and D.id_factura_venta = F.id_factura_venta and F.id_factura_venta='$_GET[ids]' and P.cod_barras='$codigo_barras' and P. estado='Activo'");
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
}
echo json_encode($arr_data);
?>