<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$data = 0;
$cont = 0;


$consulta = pg_query("select * from proveedores P, factura_compra F where F.id_proveedor = P.id_proveedor and F.id_proveedor = '$_POST[id_proveedor]'");
while ($row = pg_fetch_row($consulta)) {
    $cont++;
}

$consulta2 = pg_query("select * from proveedores P, c_pagarexternas CP where P.id_proveedor = CP.id_proveedor and CP.id_proveedor = '$_POST[id_proveedor]'");
while ($row = pg_fetch_row($consulta2)) {
    $cont++;
}

if ($cont == 0) {
    pg_query("Update proveedores Set estado='Pasivo' where id_proveedor='$_POST[id_proveedor]'");
    $data = 0;
} else {
    $data = 1;
}

echo $data;
?>