<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

//////////////eliminar series///////////
pg_query("delete from series_compra  where cod_productos='$_POST[codigo]' and id_factura_compra='$_POST[comprobante]'");
$data = 1;
echo $data;
/////////////////////////////////
?>
