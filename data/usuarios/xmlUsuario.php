<?php

include '../../procesos/base.php';
$page = $_GET['page'];
$limit = $_GET['rows'];
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];
$search = $_GET['_search'];


if (!$sidx)
    $sidx = 1;
$result = pg_query("SELECT COUNT(*) AS count FROM usuario");
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
    $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' ORDER BY  $sidx $sord offset $start limit $limit";
} else {
    $campo = $_GET['searchField'];
  
    if ($_GET['searchOper'] == 'eq') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo = '$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ne') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo != '$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'bw') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo like '$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'bn') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo not like '$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ew') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo like '%$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'en') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo not like '%$_GET[searchString]' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'cn') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'nc') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo not like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'in') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
    }
    if ($_GET['searchOper'] == 'ni') {
        $SQL = "select U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.ci_usuario, U.telefono_usuario, U.celular_usuario, U.clave, U.email_usuario, U.direccion_usuario, U.usuario, U.cargo_usuario from usuario U where U.estado='Activo' and $campo not like '%$_GET[searchString]%' ORDER BY $sidx $sord offset $start limit $limit";
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
    $s .= "<cell>" . $row[3] . "</cell>";
    $s .= "<cell>" . $row[1] . "</cell>";
    $s .= "<cell>" . $row[2] . "</cell>";
    $s .= "<cell>" . $row[8] . "</cell>";
    $s .= "<cell>" . $row[4] . "</cell>";
    $s .= "<cell>" . $row[5] . "</cell>";
    $s .= "<cell>" . $row[7] . "</cell>";
    $s .= "<cell>" . $row[9] . "</cell>";
    $s .= "<cell>" . $row[6] . "</cell>";
    if ($row[10] == '1') {
        $row[10] = 'Administrador';
    } else {
        if ($row[10] == '2') {
            $row[10] = 'Vendedor';
        }
    }
    $s .= "<cell>" . $row[10] . "</cell>";
    $s .= "</row>";
}
$s .= "</rows>";
echo $s;
?>
