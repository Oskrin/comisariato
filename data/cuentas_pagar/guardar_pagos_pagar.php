<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////datos detalle factura/////
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
$campo3 = $_POST['campo3'];
$campo4 = $_POST['campo4'];
$campo5 = $_POST['campo5'];
$campo6 = $_POST['campo6'];
$campo7 = $_POST['campo7'];
///////////////////////////////
//
////////////agregar pagos////////
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$arreglo3 = explode('|', $campo3);
$arreglo4 = explode('|', $campo4);
$arreglo5 = explode('|', $campo5);
$arreglo6 = explode('|', $campo6);
$arreglo7 = explode('|', $campo7);
$nelem = count($arreglo1);

if ($_POST['tipo_pago'] == "EXTERNA") {
///////////////////////////////////////////
    for ($i = 1; $i < $nelem; $i++) {
        /////////////////contador  pagos///////////
        $cont1 = 0;
        $consulta = pg_query("select max(id_cuentas_pagar) from pagos_pagar");
        while ($row = pg_fetch_row($consulta)) {
            $cont1 = $row[0];
        }
        $cont1++;
        ////////////guardar pagos////////
        pg_query("insert into pagos_pagar values('$cont1','$_POST[id_proveedor]','$_SESSION[id]','$_POST[comprobante]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[forma_pago]','$_POST[tipo_pago]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','$arreglo6[$i]','$arreglo7[$i]','$_POST[observaciones]','Activo')");
        ////////////////////////////////////////
        //
        ////////////modificar pagos////////
        $consulta2 = pg_query("select * from c_pagarexternas where id_c_pagarexternas = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $saldo = $row[10];
        }

        $cal = $saldo - $arreglo6[$i];
        $format_numero = number_format($cal, 2, '.', '');
        if ($format_numero == 0.00) {
            pg_query("Update c_pagarexternas Set saldo='" . $format_numero . "', estado='Cancelado' where id_c_pagarexternas='" . $arreglo1[$i] . "'");
        } else {
            pg_query("Update c_pagarexternas Set saldo='" . $format_numero . "' where id_c_pagarexternas='" . $arreglo1[$i] . "'");
            //////////////////////////////
        }
    }
    $data = 1;
} else {
    ///////////////////////////////////////////
    for ($i = 1; $i < $nelem; $i++) {
        /////////////////contador  pagos///////////
        $cont1 = 0;
        $consulta = pg_query("select max(id_cuentas_pagar) from pagos_pagar");
        while ($row = pg_fetch_row($consulta)) {
            $cont1 = $row[0];
        }

        $cont1++;
        ////////////guardar pagos////////
        pg_query("insert into pagos_pagar values('$cont1','$_POST[id_proveedor]','$_SESSION[id]','$_POST[comprobante]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[forma_pago]','$_POST[tipo_pago]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','$arreglo6[$i]','$arreglo7[$i]','$_POST[observaciones]','Activo')");
        ////////////////////////////////////////
        //
        ////////modificar los pagos///
        $consulta2 = pg_query("select * from pagos_compra where id_pagos_compra = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $saldo = $row[9];
        }

        $cal = $saldo - $arreglo6[$i];
        $format_numero = number_format($cal, 2, '.', '');

        if ($format_numero == 0.00) {
            pg_query("Update pagos_compra Set saldo='" . $format_numero . "', estado='Cancelado' where id_pagos_compra='" . $arreglo1[$i] . "'");
        } else {
            pg_query("Update pagos_compra Set saldo='" . $format_numero . "' where id_pagos_compra='" . $arreglo1[$i] . "'");
        }
    }
    $data = 1;
}
echo $data;
?>