<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select F.id_factura_compra, F.num_serie, F.num_autorizacion from factura_compra F, proveedores P where P.id_proveedor = F.id_proveedor and F.id_proveedor = '$_GET[id]' and F.num_serie like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'autorizacion' => $row[2],
        'id_factura_compra' => $row[0]
    );
}
echo $data = json_encode($data);
?>
