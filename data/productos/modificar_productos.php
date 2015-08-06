<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

///////////////valores imagen//////////
$extension = explode(".", $_FILES["archivo"]["name"]);

$extension = end($extension);
$type = $_FILES["archivo"]["type"];
$tmp_name = $_FILES["archivo"]["tmp_name"];
$size = $_FILES["archivo"]["size"];
$nombre = basename($_FILES["archivo"]["name"], "." . $extension);
//////////////////////////
//
///////////////////modificar productos//////////////////
if ($nombre == "") {
    $valor = number_format($_POST['precio_compra'], 2, '.', '');
    $valor1 = number_format($_POST['precio_minorista'], 2, '.', '');
    $valor2 = number_format($_POST['precio_mayorista'], 2, '.', '');
    pg_query("Update productos Set codigo='$_POST[cod_prod]', cod_barras='$_POST[cod_barras]', articulo='" . strtoupper($_POST['nombre_art']) . "', iva='$_POST[iva]', series='$_POST[series]', precio_compra='$valor', utilidad_minorista='$_POST[utilidad_minorista]', utilidad_mayorista='$_POST[utilidad_mayorista]', iva_minorista='$valor1', iva_mayorista='$valor2',categoria='$_POST[categoria]', marca='$_POST[marca]', stock='$_POST[stock]', stock_minimo='$_POST[minimo]', stock_maximo='$_POST[maximo]', fecha_creacion='$_POST[fecha_creacion]', caracteristicas='$_POST[modelo]', observaciones='$_POST[aplicacion]', descuento='$_POST[descuento]', estado='Activo', inventariable='$_POST[inventario]', id_bodega='$_POST[bodegas]', incluye_iva='$_POST[incluye]' where cod_productos='$_POST[cod_productos]'");
} else {
    $foto = $_POST['cod_productos'] . '.' . $extension;
    move_uploaded_file($_FILES["archivo"]["tmp_name"], "fotos_productos/" . $foto);
    $valor = number_format($_POST['precio_compra'], 2, '.', '');
    $valor1 = number_format($_POST['precio_minorista'], 2, '.', '');
    $valor2 = number_format($_POST['precio_mayorista'], 2, '.', '');
    pg_query("Update productos Set codigo='$_POST[cod_prod]', cod_barras='$_POST[cod_barras]', articulo='" . strtoupper($_POST['nombre_art']) . "', iva='$_POST[iva]', series='$_POST[series]', precio_compra='$valor', utilidad_minorista='$_POST[utilidad_minorista]', utilidad_mayorista='$_POST[utilidad_mayorista]', iva_minorista='$valor1', iva_mayorista='$valor2',categoria='$_POST[categoria]', marca='$_POST[marca]', stock='$_POST[stock]', stock_minimo='$_POST[minimo]', stock_maximo='$_POST[maximo]', fecha_creacion='$_POST[fecha_creacion]', caracteristicas='$_POST[modelo]', observaciones='$_POST[aplicacion]', descuento='$_POST[descuento]', estado='Activo', inventariable='$_POST[inventario]', imagen='$foto', id_bodega='$_POST[bodegas]', incluye_iva='$_POST[incluye]' where cod_productos='$_POST[cod_productos]'");
}
///////////////////////////////////////////////////////

$data = 1;
echo $data;
?>
