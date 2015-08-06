<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];

$consulta = pg_query("select * from productos where articulo like '%$texto2%' and estado = 'Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[3],
        'codigo' => $row[1],
        'codigo_barras' => $row[2],
        'precio' => $row[6],
        'iva_producto' => $row[4],
        'carga_series' => $row[5],
        'cod_producto' => $row[0],
        'incluye' => $row[26]
    );
}

echo $data = json_encode($data);
?>
