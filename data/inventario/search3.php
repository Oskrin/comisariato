<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$codigo_barras = $_GET["codigo_barras"];
$arr_data = array();

if ($codigo_barras != "") {
    $consulta = pg_query("select * from productos where cod_barras = '$codigo_barras' and estado = 'Activo'");
    while ($row = pg_fetch_row($consulta)) {
        $arr_data[] = $row[1];
        $arr_data[] = $row[3];
        $arr_data[] = $row[6];
        $arr_data[] = $row[13];
        $arr_data[] = $row[9];
        $arr_data[] = $row[22];
        $arr_data[] = $row[23];
        $arr_data[] = $row[0];
    }
}
echo json_encode($arr_data);
?>