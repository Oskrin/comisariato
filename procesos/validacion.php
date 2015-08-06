<?php

include 'base.php';
conectarse();
error_reporting(0);

if ($_POST['tipo'] == 1) {
    echo comproban();
}

function comproban() {
    $resp = "";

    $sql = pg_query("select " . $_POST['id_tabla'] . " from " . $_POST['tabla'] . " where " . $_POST['id_tabla'] . " = " . $_POST['comprobante'] . " order by " . $_POST['id_tabla'] . " limit 1;");
    while ($row = pg_fetch_row($sql)) {
        $resp = $row[0];
    }
    return $resp;
}

