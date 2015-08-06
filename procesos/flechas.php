<?php

include 'base.php';
conectarse();
error_reporting(0);
session_start();

if ($_POST['tipo'] == 1) {
    echo atras();
} else {
    if ($_POST['tipo'] == 2) {
        echo adelante();
    }
}

function atras() {
    $resp = "";
    $contador = 0;
    $sql = pg_query("select max(" . $_POST['id_tabla'] . ") + 1 from  " . $_POST['tabla'] . "");
    while ($row = pg_fetch_row($sql)) {
        $contador = $row[0];
    }
    
    $sql = pg_query("select " . $_POST['id_tabla'] . " from " . $_POST['tabla'] . " where " . $_POST['id_tabla'] . " not BETWEEN " . $_POST['comprobante'] . " and " . $contador . " order by " . $_POST['id_tabla'] . " desc  limit 1;");
    while ($row = pg_fetch_row($sql)) {
        $resp = $row[0];
    }
    return $resp;
}

function adelante() {
    $resp = "";
    $contador = 0;

    $sql = pg_query("select min(" . $_POST['id_tabla'] . ") from  " . $_POST['tabla'] . "");
    while ($row = pg_fetch_row($sql)) {
        $contador = $row[0];
    }
    
    $sql = pg_query("select " . $_POST['id_tabla'] . " from " . $_POST['tabla'] . " where " . $_POST['id_tabla'] . " not BETWEEN " . $contador . " and " . $_POST['comprobante'] . " order by " . $_POST['id_tabla'] . " asc  limit 1;");
    while ($row = pg_fetch_row($sql)) {
        $resp = $row[0];
    }
    return $resp;
}
?>
