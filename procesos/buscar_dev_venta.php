<?php

session_start();
include 'base.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select id_devolucion_venta, num_serie from devolucion_venta where num_serie like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_devolucion_venta' => $row[0],
    );
}
echo $data = json_encode($data);
?>