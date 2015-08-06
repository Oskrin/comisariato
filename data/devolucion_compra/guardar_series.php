<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

//////datos series////////////
$campo1 = $_POST['campo1'];
$arreglo1 = explode('|', $campo1);
$nelem = count($arreglo1);

///////////////////////////////////////////
for ($i = 1; $i < $nelem; $i++) {
    ///////////////////modificar series////////
    pg_query("Update series_compra Set estado='Pasivo' where serie = '" . $arreglo1[$i] . "' and cod_productos = '" . $_POST[cod_producto] . "'");
    ////////////////////////////////////////////
}
$data = 1;
echo $data;
?>
