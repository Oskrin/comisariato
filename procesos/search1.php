<?php

session_start();
include 'base.php';
conectarse();
error_reporting(0);
$codigo_barras = $_GET["codigo_barras"];
$precio = $_GET["precio"];
$arr_data = array();

if ($codigo_barras != "") {
    $consulta = pg_query("select * from productos where cod_barras = '$codigo_barras' and estado = 'Activo'");
    while ($row = pg_fetch_row($consulta)) {
        if ($precio == "MINORISTA") {
            $arr_data[] = $row[1];
            $arr_data[] = $row[3];
            $arr_data[] = $row[9];
            $arr_data[] = $row[19];
            $arr_data[] = $row[4];
            $arr_data[] = $row[0];
        } else {
            if ($precio == "MAYORISTA") {
                $arr_data[] = $row[1];
                $arr_data[] = $row[3];
                $arr_data[] = $row[10];
                $arr_data[] = $row[19];
                $arr_data[] = $row[4];
                $arr_data[] = $row[0];
            }
        }
    }
}
echo json_encode($arr_data);
?>