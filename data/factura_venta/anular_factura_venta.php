<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
//
/////datos detalle factura/////
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
//////////////////////////////

////////////modificar estado factura venta////////
pg_query("Update factura_venta Set estado = 'Pasivo', fecha_anulacion='$_POST[fecha_anulacion]' where id_factura_venta = '$_POST[comprobante]'");
////////////////////////////////////////
//
////////////modificar cantidades////////
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$nelem = count($arreglo1);

for ($i = 0; $i <= $nelem; $i++) {

    ///////////////modificar las series//////////////////
    $consulta = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
    while ($row = pg_fetch_row($consulta)) {
        $stock = $row[13];
    }

    //////////////modificar productos///////////
    $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
    while ($row = pg_fetch_row($consulta2)) {
        $stock = $row[13];
    }
    $cal = $stock + $arreglo2[$i];

    pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
    ///////////////////////////////////////////
    //
    ///////cambiar estados series/////////////
//    $consulta4 = pg_query("select * from serie_venta where cod_productos = '" . $arreglo1[$i] . "' and id_factura_venta = '$_POST[comprobante]'");
//    while ($row = pg_fetch_row($consulta4)) {
//        $series2 = $row[3];
//        pg_query("Update series_compra Set estado='Activo'  where cod_productos='" . $arreglo1[$i] . "' and serie = '$series2'");
//        pg_query("delete from serie_venta  where cod_productos='" . $arreglo1[$i] . "' and id_factura_venta='$_POST[comprobante]'");
//    }
}

$data = 1;
echo $data;
?>
