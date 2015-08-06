<?php

session_start();
include 'base.php';
conectarse();
$texto2 = $_GET['term'];

$consulta = pg_query("select * from ordenes_produccion where comprobante like '%$texto2%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_ordenes' => $row[1],
    );
}
echo $data = json_encode($data);
?>
