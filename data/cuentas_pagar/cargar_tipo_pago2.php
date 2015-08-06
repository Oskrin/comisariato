<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

//////////////////consulta 1/////////////////
$consulta = pg_query("select * from factura_compra F, pagos_compra P where F.forma_pago='Credito' and F.id_proveedor='$_GET[cod]' and F.id_factura_compra = P.id_factura_compra and P.estado='Activo'");
if (pg_num_rows($consulta) > 0) {
    echo "<option id=INTERNA value=INTERNA >INTERNA</option>";
}
//////////////////////////////////////////
//////////////////consulta 2/////////////////
$consulta2 = pg_query("select * from c_pagarexternas where id_proveedor = '$_GET[cod]' and estado='Activo'");
if (pg_num_rows($consulta2) > 0) {
    echo "<option id=EXTERNA value=EXTERNA >EXTERNA</option>";
}
//////////////////////////////////////////
?>