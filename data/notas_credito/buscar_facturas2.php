<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select F.id_factura_venta, F.num_factura  from factura_venta F, clientes C where C.id_cliente = F.id_cliente and F.id_cliente = '$_GET[id]' and F.num_factura like '%$texto%' and F.estado='Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_factura_venta' => $row[0]
    );
}
echo $data = json_encode($data);
?>
