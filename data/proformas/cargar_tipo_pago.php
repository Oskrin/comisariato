<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

//////////////////consulta 1/////////////////
$consulta = pg_query("select * from factura_venta F, pagos_venta P where F.forma_pago='Credito' and F.id_cliente='$_GET[cod]' and F.id_factura_venta = P.id_factura_venta and P.estado='Activo'");
if (pg_num_rows($consulta) > 0) {
    echo "<option id=INTERNA value=INTERNA >INTERNA</option>";
}
//////////////////////////////////////////
//
//////////////////consulta 2/////////////////
$consulta2 = pg_query("select * from c_cobrarexternas where id_cliente='$_GET[cod]' and estado='Activo'");
if (pg_num_rows($consulta2) > 0) {
    echo "<option id=EXTERNA value=EXTERNA >EXTERNA</option>";
}
//////////////////////////////////////////
?>