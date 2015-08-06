<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////datos detalle devolucion compra/////
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
$campo3 = $_POST['campo3'];
$campo4 = $_POST['campo4'];
$campo5 = $_POST['campo5'];
///////////////////////////////
//
/////////////////contador devolucion factura compra///////////
$cont1 = 0;
$consulta = pg_query("select max(id_devolucion_compra) from devolucion_compra");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;

////////////guardar devolucion compra////////
pg_query("insert into devolucion_compra values('$cont1','1','$_POST[id_proveedor]','$_SESSION[id]','$cont1','$_POST[fecha_actual]','$_POST[hora_actual]'
    ,'$_POST[tipo_comprobante]','$_POST[serie]','$_POST[autorizacion]'
    ,'$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','$_POST[observaciones]','Activo')");

////////////////////////////////////////
//
////////////agregar detalle_dev_compra////////
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$arreglo3 = explode('|', $campo3);
$arreglo4 = explode('|', $campo4);
$arreglo5 = explode('|', $campo5);
$nelem = count($arreglo1);


for ($i = 0; $i <= $nelem; $i++) {
    
    /////////////////contador detalle devolucion/////////////
    $cont2 = 0;
    $consulta = pg_query("select max(id_detalle_devcompra) from detalle_devolucion_compra");
    while ($row = pg_fetch_row($consulta)) {
        $cont2 = $row[0];
    }
    $cont2++;

    //////////////guardar detalle devolucion////////
    pg_query("insert into detalle_devolucion_compra values('$cont2','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo')");
    ////////////////////////////////////////////
    //
    //////////////modificar productos///////////
    $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
    while ($row = pg_fetch_row($consulta2)) {
        $stock = $row[13];
    }
    $cal = $stock - $arreglo2[$i];

    pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
    ////////////////////////////////////////
    //
    ///////cambiar estados series/////////////
    $consulta3 = pg_query("select * from series_compra where cod_productos = '$arreglo1[$i]' and id_factura_compra ='$_POST[id_factura_compra]'");
    while ($row = pg_fetch_row($consulta3)) {
        pg_query("delete from series_compra  where cod_productos='$arreglo1[$i]' and id_factura_compra='$_POST[id_factura_compra]' and estado='Pasivo'");
    }
}

$data = 1;
echo $data;
?>
