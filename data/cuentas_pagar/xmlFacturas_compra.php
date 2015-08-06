<?php

include '../../procesos/base.php';
error_reporting(0);
$page = $_GET['page'];
$limit = $_GET['rows'];

if ($_GET['tipo'] == "EXTERNA") {
    $result = pg_query("SELECT COUNT(*) AS count FROM c_pagarexternas");
} else {
    if ($_GET['tipo'] == "INTERNA") {
        $result = pg_query("SELECT COUNT(*) AS count FROM pagos_compra");
    }
}

$row = pg_fetch_row($result);
$count = $row[0];
if ($count > 0 && $limit > 0) {
    $total_pages = ceil($count / $limit);
} else {
    $total_pages = 0;
}
if ($page > $total_pages)
    $page = $total_pages;
$start = $limit * $page - $limit;
if ($start < 0)
    $start = 0;
if ($_GET['tipo'] == "EXTERNA") {
    $SQL = "select CE.id_c_pagarexternas, num_factura, CE.tipo_documento, CE.fecha_actual, CE.total, CE.saldo  from c_pagarexternas CE where CE.id_proveedor='$_GET[id_proveedor]' and CE.estado='Activo' offset $start limit $limit";
    $result = pg_query($SQL);
    header("Content-type: text/xml;charset=utf-8");
    $s = "<?xml version='1.0' encoding='utf-8'?>";
    $s .= "<rows>";
    $s .= "<page>" . $page . "</page>";
    $s .= "<total>" . $total_pages . "</total>";
    $s .= "<records>" . $count . "</records>";
    while ($row = pg_fetch_row($result)) {
        $s .= "<row id='" . $row[0] . "'>";
        $s .= "<cell>" . $row[0] . "</cell>";
        $s .= "<cell>" . $row[1] . "</cell>";
        $s .= "<cell>" . $row[2] . "</cell>";
        $s .= "<cell>" . $row[3] . "</cell>";
        $s .= "<cell>" . $row[4] . "</cell>";
        $s .= "<cell></cell>";
        $s .= "<cell>" . $row[5] . "</cell>";
        $s .= "</row>";
    }
    $s .= "</rows>";
} else {
    if ($_GET['tipo'] == "INTERNA") {
        $SQL = "select  P.id_pagos_compra, F.num_serie, P.tipo_documento, F.fecha_actual, P.monto_credito, P.saldo  from pagos_compra P, factura_compra F where P.id_factura_compra = F.id_factura_compra and F.forma_pago='Credito' and P.id_proveedor='$_GET[id_proveedor]' and P.estado = 'Activo' offset $start limit $limit";
        $result = pg_query($SQL);
        header("Content-type: text/xml;charset=utf-8");
        $s = "<?xml version='1.0' encoding='utf-8'?>";
        $s .= "<rows>";
        $s .= "<page>" . $page . "</page>";
        $s .= "<total>" . $total_pages . "</total>";
        $s .= "<records>" . $count . "</records>";
        while ($row = pg_fetch_row($result)) {
            $s .= "<row id='" . $row[0] . "'>";
            $s .= "<cell>" . $row[0] . "</cell>";
            $s .= "<cell>" . $row[1] . "</cell>";
            $s .= "<cell>" . $row[2] . "</cell>";
            $s .= "<cell>" . $row[3] . "</cell>";
            $s .= "<cell>" . $row[4] . "</cell>";
            $s .= "<cell></cell>";
            $s .= "<cell>" . $row[5] . "</cell>";
            $s .= "</row>";
        }
        $s .= "</rows>";
    }
}
echo $s;
?>
