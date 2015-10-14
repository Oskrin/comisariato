<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

// datos detalle factura
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
$campo3 = $_POST['campo3'];
$campo4 = $_POST['campo4'];
$campo5 = $_POST['campo5'];
$campo6 = $_POST['campo6'];
// fin

// contador inventario
$cont1 = 0;
$consulta = pg_query("select max(id_inventario) from inventario");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;
// fin

// guardar factura compra
pg_query("insert into inventario values('$cont1','$_SESSION[id]','1','$_POST[comprobante]','$_POST[fecha_actual]','$_POST[hora_actual]','Activo')");
// fin

// agregar detalle inventario
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$arreglo3 = explode('|', $campo3);
$arreglo4 = explode('|', $campo4);
$arreglo5 = explode('|', $campo5);
$arreglo6 = explode('|', $campo6);
$nelem = count($arreglo1);
// fin

for ($i = 0; $i <= $nelem; $i++) {

    // contador detalle inventario
    $cont2 = 0;
    $consulta = pg_query("select max(id_detalle_inventario) from detalle_inventario");
    while ($row = pg_fetch_row($consulta)) {
        $cont2 = $row[0];
    }
    $cont2++;
    // fin 

    // guardar detalle_factura
    pg_query("insert into detalle_inventario values('$cont2','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','$arreglo6[$i]','Activo')");
    pg_query("Update productos Set stock='" .$arreglo4[$i]. "' ,existencia='" . $arreglo4[$i] . "', diferencia='" . $arreglo6[$i] . "' where cod_productos='" . $arreglo1[$i] . "'");
    // fin

    // contador kardex
    $cont_k = 0;
    $consulta_k = pg_query("select max(id_kardex) from kardex");
    while ($row = pg_fetch_row($consulta_k)) {
        $cont_k = $row[0];
    }
    $cont_k++;
    // fin

    // guardar kardex
    pg_query("insert into kardex values('$cont_k','$_POST[fecha_actual]', 'INV.', '" .$arreglo4[$i]. "','','','".$arreglo1[$i]."','" .$arreglo4[$i]. "','6','','')");
    // fin
}
$data = 1;
echo $data;
?>
