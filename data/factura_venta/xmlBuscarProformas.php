<?php

session_start();
include '../../procesos/base.php';
$page = $_GET['page'];
$limit = $_GET['rows'];
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];
$search = $_GET['_search'];

if (!$sidx)
    $sidx = 1;
$result = pg_query("SELECT COUNT(*) AS count from proforma P , clientes C, usuario U where P.id_cliente=C.id_cliente and P.id_usuario=U.id_usuario");
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
if ($search == 'false') {
    $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' ORDER BY $sidx $sord offset $start limit $limit";
} else {
    if ($_GET['searchOper'] == 'eq') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] = '$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ne') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] != '$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'bw') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] like '$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'bn') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] not like '$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ew') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] like '%$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'en') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] not like '%$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'cn') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'nc') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] not like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'in') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ni') {
        $SQL = "select P.id_proforma, C.identificacion, C.nombres_cli, P.total_proforma, P.fecha_actual from proforma P, clientes C, usuario U where P.id_cliente = C.id_cliente and P.id_usuario=U.id_usuario and P.estado='Activo' and $_GET[searchField] not like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
}

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
    $s .= "</row>";
}
$s .= "</rows>";
echo $s;
?>
