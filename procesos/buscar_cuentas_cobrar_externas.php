<?php

session_start();
include 'base.php';
conectarse();
$consulta = pg_query("select CE.id_c_cobrarexternas, CE.num_factura, CE.tipo_documento, CE.fecha_actual, CE.total, CE.saldo  from c_cobrarexternas CE where CE.num_factura like '%$_GET[term]%' and id_cliente='$_GET[id]'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'tipo_factura' => $row[2],
        'fecha_factura' => $row[3],
        'totalcxc' => $row[4],
        'saldo' => $row[5],
        'ids' => $row[0]
    );
}
echo $data = json_encode($data);
?>