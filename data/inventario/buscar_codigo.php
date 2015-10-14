<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];

$consulta = pg_query("select * from productos where codigo like '%$texto2%' and estado= 'Activo' ");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'codigo_barras' => $row[2],
        'producto' => $row[3],
        'precio' => $row[6],
        'stock' => $row[13],
        'p_venta' => $row[9],
        'existencia' => $row[22],
        'diferencia' => $row[23],
        'cod_producto' => $row[0]
    );
}

echo $data = json_encode($data);   
?>
