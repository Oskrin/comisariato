<?php

session_start();
include 'base.php';
conectarse();
$texto = $_GET['term'];
$consulta = pg_query("select id_factura_venta, num_factura from factura_venta where num_factura like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_factura_venta' => $row[0],
    );
}
echo $data = json_encode($data);
?>