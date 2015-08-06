<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$data = 0;
$cont = 0;

////////////////////contadores///////////////
$consulta = pg_query("select * from clientes C, factura_venta F where C.id_cliente = F.id_cliente and F.id_cliente = '$_POST[id_cliente]'");
while ($row = pg_fetch_row($consulta)) {
    $cont++;
}

$consulta2 = pg_query("select * from clientes C, c_cobrarexternas CC where C.id_cliente = CC.id_cliente and CC.id_cliente = '$_POST[id_cliente]'");
while ($row = pg_fetch_row($consulta2)) {
    $cont++;
}

if ($cont == 0) {
    pg_query("Update clientes Set estado='Pasivo' where id_cliente='$_POST[id_cliente]'");
    $data = 0;
} else {
    $data = 1;
}

echo $data;
?>