<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////datos series/////
$campo1 = $_POST['campo1'];
$arreglo1 = explode('|', $campo1);
$nelem = count($arreglo1);

///////////////////////////////////////////
for ($i = 1; $i < $nelem; $i++) {

    /////////////////contador serie venta/////////////
    $cont1 = 0;
    $consulta = pg_query("select max(id_serie_venta) from serie_venta");
    while ($row = pg_fetch_row($consulta)) {
        $cont1 = $row[0];
    }
    $cont1++;
    //////////////////////////  
    //
    ///guardar series/////
    pg_query("insert into serie_venta values('$cont1','$_POST[cod_producto]','$_POST[comprobante]','$arreglo1[$i]','','Activo')");
    ////////////////////////////////
    //
    ///////////////////modificar series////////
    pg_query("Update series_compra Set estado='Pasivo' where serie = '" . $arreglo1[$i] . "' and cod_productos = '" . $_POST[cod_producto] . "'");
    ////////////////////////////////////////////
}
$data = 1;
echo $data;
?>
