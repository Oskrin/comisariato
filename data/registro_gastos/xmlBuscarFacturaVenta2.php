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
$result = pg_query("SELECT COUNT(*) AS count from factura_venta, clientes, usuario, empresa where factura_venta.id_cliente = clientes.id_cliente and factura_venta.id_usuario = usuario.id_usuario and factura_venta.id_empresa = empresa.id_empresa");
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
    $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa ORDER BY $sidx $sord offset $start limit $limit";
} else {
    if ($_GET['searchOper'] == 'eq') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] = '$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ne') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] != '$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'bw') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] like '$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'bn') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] not like '$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ew') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] like '%$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'en') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] not like '%$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'cn') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'nc') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] not like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'in') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ni') {
        $SQL = "select id_factura_venta,identificacion,nombres_cli,num_factura,total_venta,fecha_actual from factura_venta,clientes,usuario,empresa where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_empresa=empresa.id_empresa and $_GET[searchField] not like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    //echo $SQL;
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
    $s .= "<cell>" . $row[5] . "</cell>";
    $s .= "<cell>" . $row[4] . "</cell>";
    $SQL2 = pg_query("select saldo from gastos  where id_factura_venta='$row[0]' order by id_gastos desc limit 1");
    if(pg_num_rows($SQL2)){
         while ($row1 = pg_fetch_row($SQL2)) {
            $s .= "<cell>" . $row1[0] . "</cell>"; 
         }
    }
    else{
        $s .= "<cell>".$row[4]."</cell>";
    }  
            
        
    
    $s .= "</row>";
}
$s .= "</rows>";
echo $s;
?>
