<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$data = 0;
$cont = 0;

$consulta = pg_query("select * from factura_venta where num_factura ='$_POST[num_fac]'");
while ($row = pg_fetch_row($consulta)) {
    $cont++;
}


if ($cont == 0) {
    $data = 0;
} else {
    $consulta = pg_query("select max(num_factura) from factura_venta");
	while ($row = pg_fetch_row($consulta)) {
	    $data = $row[0];

	}
}
echo $data;
?>