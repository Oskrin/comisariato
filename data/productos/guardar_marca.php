<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from marcas where nombre_marca='" . strtoupper($_POST[nombre_marca]) . "'");
while ($row = pg_fetch_row($consulta)) {
    $repe++;
}
/////////////////////////////////////////////////// 

if ($repe == 0) {
///////////////////contador marca//////////////
    $consulta = pg_query("select max(id_marca) from marcas");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;
////////////////////////////////////////

    pg_query("insert into marcas values('$cont','" . strtoupper($_POST[nombre_marca]) . "','Activo')");
    $data = 1;
} else {
    $data = 0;
}
echo $data;
?>
