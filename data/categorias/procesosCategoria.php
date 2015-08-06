<?php

session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from categoria where nombre_categoria='" . strtoupper($_POST['nombre_categoria']) . "'");
while ($row = pg_fetch_row($consulta)) {
    $repe++;
}
///////////////////////////////////////////////

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_categoria) from categoria");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into categoria values('$cont','" . strtoupper($_POST['nombre_categoria']) . "','Activo')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        if ($repe == 0) {
            pg_query("update categoria set nombre_categoria='" . strtoupper($_POST['nombre_categoria']) . "' where id_categoria='$_POST[id_categoria]'");
        }
    }
}
?>
