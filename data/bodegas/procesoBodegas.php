<?php
session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from bodegas where nombre_bodega='" . strtoupper($_POST['nombre_bodega']) . "'");
while ($row = pg_fetch_row($consulta)) {
   $repe++;
}
//////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_bodega) from bodegas");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into bodegas values('$cont','" . strtoupper($_POST['nombre_bodega']) . "','" . strtoupper($_POST['ubicacion_bodega']) . "','$_POST[telefono_bodega]','Activo')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        pg_query("update bodegas set nombre_bodega='" . strtoupper($_POST['nombre_bodega']) . "', ubicacion_bodega='" . strtoupper($_POST['ubicacion_bodega']) . "', telefono_bodega='$_POST[telefono_bodega]' where id_bodega='$_POST[id_bodega]'");
        
    }
}
?>