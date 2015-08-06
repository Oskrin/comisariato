<?php

session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_color) from color");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    $consulta2 = pg_query("select * from color where nombre_color='". strtoupper($_POST['nombre_Color']) ."'");
    while ($row = pg_fetch_row($consulta2)) {
        $repe++;
    }
    if ($repe == 0) {
        pg_query("insert into color values('$cont','$_POST[nombre_Color]','Activo')");
    }
}
if ($_POST['oper'] == "edit") {
    pg_query("update color set nombre_color='". strtoupper($_POST['nombre_Color']) ."' where id_color='$_POST[id_color]'");
}
?>
