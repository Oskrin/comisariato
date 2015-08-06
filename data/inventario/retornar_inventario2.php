<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select D.cod_productos, P.codigo, P.articulo, D.p_costo, D.p_venta, D.disponibles, D.existencia, D.diferencia from inventario I, detalle_inventario D, productos P where D.cod_productos = P.cod_productos and I.id_inventario = D.id_inventario and D.id_inventario = '" . $id . "'");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[0];
    $arr_data[] = $row[1];
    $arr_data[] = $row[2];
    $arr_data[] = $row[3];
    $arr_data[] = $row[4];
    $arr_data[] = $row[5];
    $arr_data[] = $row[6];
    $arr_data[] = $row[7];
}
echo json_encode($arr_data);
?>
