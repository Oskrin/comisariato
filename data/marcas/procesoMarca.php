<?php

session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

    //////////////////validar repetidos//////////////////
    $consulta = pg_query("select * from marcas where nombre_marca='" . strtoupper($_POST['nombre_marca']) . "'");
    while ($row = pg_fetch_row($consulta)) {
        $repe++;
    }
    ///////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_marca) from marcas");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into marcas values('$cont','" . strtoupper($_POST['nombre_marca']) . "','Activo')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        if ($repe == 0) {
            pg_query("update marcas set id_marca='$_POST[id_marca]', nombre_marca='" . strtoupper($_POST['nombre_marca']) . "' where id_marca='$_POST[id_marca]'");
        }
    }
}
?>
