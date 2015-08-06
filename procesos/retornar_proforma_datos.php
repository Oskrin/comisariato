<?php

session_start();
include 'base.php';
conectarse();
error_reporting(0);
$id = $_GET['id2'];
$arr_data = array();

$consulta = pg_query("select tarifa0, tarifa12,iva_proforma, descuento_proforma, total_proforma from proforma where estado='Activo' and id_proforma='" . $id . "'");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[0];
    $arr_data[] = $row[1];
    $arr_data[] = $row[2];
    $arr_data[] = $row[3];
    $arr_data[] = $row[4];
}
echo json_encode($arr_data);
?>
