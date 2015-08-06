<?php

session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;


if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_bancos) from bancos");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    pg_query("insert into bancos values('$cont','$_POST[numero_cuenta]','$_POST[descripcion]','$_POST[sucursal]','$_POST[tipo_cuenta]','Activo')");
} else {
    if ($_POST['oper'] == "edit") {
        pg_query("update bancos set numero_cuenta='$_POST[numero_cuenta]', descripcion='$_POST[descripcion]', sucursal='$_POST[sucursal]', tipo_cuenta='$_POST[tipo_cuenta]' where id_bancos='$_POST[id_bancos]'");
    } else {
        if ($_POST['oper'] == "del") {
            pg_query("update bancos set estado='Pasivo' where id_bancos='$_POST[id]'");
        }
    }
}
?>
