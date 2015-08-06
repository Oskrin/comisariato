<?php

include 'base.php';
conectarse();
$cont = 1;
if ($_POST['oper'] == "add") {
    $consulta = pg_query("select * from clientes");
    while ($row = pg_fetch_row($consulta)) {
        $cont++;
    }
    pg_query("insert into clientes values('$cont','$_POST[ci_cliente]','$_POST[direccion_cliente]','$_POST[telefono_cliente]','$_POST[celular_cliente]','$_POST[nombres_cliente]','$_POST[apellidos_cliente]','$_POST[email_cliente]')");
}
if ($_POST['oper'] == "edit") {
    pg_query("update clientes set id_cliente='$_POST[id_cliente]',ci_cliente='$_POST[ci_cliente]',direccion_cliente='$_POST[direccion_cliente]',telefono_cliente='$_POST[telefono_cliente]',celular_cliente='$_POST[celular_cliente]',nombres_cliente='$_POST[nombres_cliente]',apellidos_cliente='$_POST[apellidos_cliente]',email_cliente='$_POST[email_cliente]' where id_cliente='$_POST[id_cliente]'");
}
?>