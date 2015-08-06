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
        $consulta = pg_query("select max(id_cuentas_cobrar) from pagos_cobrar");
        while ($row = pg_fetch_row($consulta)) {
            $cont1 = $row[0];
        }
        $cont1++;
        ////////////////////////////////////////////
        ////////////guardar pagos////////
        pg_query("insert into pagos_cobrar values('$cont1','$_POST[id_cliente]','$_SESSION[id]','$cont1','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[forma_pago]','$_POST[tipo_pago]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','$arreglo6[$i]','$arreglo7[$i]','$_POST[observaciones]','Activo')");
        ////////////////////////////////////////
        //
        ////////////modificar pagos////////
        $consulta2 = pg_query("select * from c_cobrarexternas where id_c_cobrarexternas = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $saldo = $row[10];
        }
        //////////////////////////////////

        $cal = $saldo - $arreglo6[$i];
        $format_numero = number_format($cal, 2, '.', '');

        if ($format_numero == 0.00) {
            pg_query("Update c_cobrarexternas Set saldo='" . $format_numero . "', estado='Cancelado' where id_c_cobrarexternas='" . $arreglo1[$i] . "'");
        } else {
            pg_query("Update c_cobrarexternas Set saldo='" . $format_numero . "' where id_c_cobrarexternas='" . $arreglo1[$i] . "'");
            //////////////////////////////
        }
    }
    $data = 1;
} else {
    ///////////////////////////////////////////
    for ($i = 1; $i < $nelem; $i++) {
        
        /////////////////contador  pagos///////////
        $cont1 = 0;
        $cont2 = 0;
        $consulta = pg_query("select max(id_cuentas_cobrar) from pagos_cobrar");
        while ($row = pg_fetch_row($consulta)) {
            $cont1 = $row[0];
        }
        $cont1++;
        ////////////guardar pagos////////
        pg_query("insert into pagos_cobrar values('$cont1','$_POST[id_cliente]','$_SESSION[id]','$cont1','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[forma_pago]','$_POST[tipo_pago]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','$arreglo6[$i]','$arreglo7[$i]','$_POST[observaciones]','Activo')");
        ////////////////////////////////////////
        //
        ////////modificar los pagos///
        $consulta2 = pg_query("select * from pagos_venta where id_pagos_venta = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $saldo = $row[9];
        }

        $cal = $saldo - $arreglo6[$i];
        $format_numero = number_format($cal, 2, '.', '');

        if ($format_numero == 0) {
            pg_query("Update pagos_venta Set saldo='" . $format_numero . "', estado='Cancelado' where id_pagos_venta='" . $arreglo1[$i] . "'");
        } else {
            pg_query("Update pagos_venta Set saldo='" . $format_numero . "' where id_pagos_venta='" . $arreglo1[$i] . "'");
        }
        //////////////////////////////
        //
        ///////////modificar detalles pagos //////// 

        /////////////contador pagos////////////////     
        $consulta4 = pg_query("select max(id_detalles_pagos_interna) from detalles_pagos_internos");
        while ($row = pg_fetch_row($consulta4)) {
            $cont2 = $row[0];
        }
        $cont2++;
        //
        //
        //////procedimiento 1///////
        $consulta3 = pg_query("select * from detalle_pagos_venta where id_pagos_venta = '$arreglo1[$i]' and estado='Activo' order by id_detalle_pagos_venta desc");
        while ($row = pg_fetch_row($consulta3)) {
            $id = $row[0];
            $saldo2 = $row[4];
            $fecha_mes = $row[2];
        }

        $cal2 = $saldo2 - $arreglo6[$i];
        $format_numero2 = number_format($cal2, 2, '.', '');

        if ($cal2 <= 0) {
            pg_query("Update detalle_pagos_venta Set saldo='0.00', estado='Cancelado'  where id_detalle_pagos_venta = '" . $id . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
            pg_query("insert into detalles_pagos_internos values('$cont2','$cont1','$fecha_mes','$saldo2','0.00','Pasivo')");
            $cont2++;
        } else {
            pg_query("Update detalle_pagos_venta Set saldo='" . $format_numero2 . "' where id_detalle_pagos_venta = '" . $id . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
            pg_query("insert into detalles_pagos_internos values('$cont2','$cont1','$fecha_mes','" . abs(($saldo2 - $cal2)) . "','$cal2','Activo')");
            $cont2++;
        }
        ////////////////////////////////////////
        //
        //////procedimiento 2///////
        if ($cal2 < 0) {
            $consulta3 = pg_query("select * from detalle_pagos_venta where id_pagos_venta = '$arreglo1[$i]' and estado='Activo' order by id_detalle_pagos_venta desc");
            while ($row = pg_fetch_row($consulta3)) {
                $ids = $row[0];
                $saldo3 = $row[4];
                $fecha_mes2 = $row[2];
            }

            $cal3 = ($saldo3 - (abs($cal2)));
            $format_numero3 = number_format($cal3, 2, '.', '');

            if ($cal3 <= 0) {
                pg_query("Update detalle_pagos_venta Set saldo='0.00' , estado='Cancelado'  where id_detalle_pagos_venta = '" . $ids . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
                pg_query("insert into detalles_pagos_internos values('$cont2','$cont1','$fecha_mes2','$saldo3','0.00','Pasivo')");
                $cont2++;
            } else {
                pg_query("Update detalle_pagos_venta Set saldo='" . $format_numero3 . "' where id_detalle_pagos_venta = '" . $ids . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
                pg_query("insert into detalles_pagos_internos values('$cont2','$cont1','$fecha_mes2','" . abs($cal2) . "','$cal3','Activo')");
                $cont2++;
            }
        }
        ////////////////////////////////
        //
        //////procedimiento 3///////
        if ($cal3 < 0) {
            $consulta3 = pg_query("select * from detalle_pagos_venta where id_pagos_venta = '$arreglo1[$i]' and estado='Activo' order by id_detalle_pagos_venta desc");
            while ($row = pg_fetch_row($consulta3)) {
                $idss = $row[0];
                $saldo4 = $row[4];
                $fecha_mes3 = $row[2];
            }
            //////procedimiento///////
            $cal4 = ($saldo4 - (abs($cal3)));
            $format_numero4 = number_format($cal4, 2, '.', '');

            if ($cal4 <= 0.00) {

                pg_query("Update detalle_pagos_venta Set saldo='0.00' , estado='Cancelado'  where id_detalle_pagos_venta = '" . $idss . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
                pg_query("insert into detalles_pagos_internos values('$cont2','$cont1','$fecha_mes3','$saldo4','0.00','Pasivo')");
                $cont2++;
            } else {
                pg_query("Update detalle_pagos_venta Set saldo='" . $format_numero4 . "' where id_detalle_pagos_venta = '" . $idss . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
                pg_query("insert into detalles_pagos_internos values('$cont2','$cont1','$fecha_mes3','" . abs($cal3) . "','$cal4','Activo')");
                $cont2++;
            }
        }
    }
    $data = 1;
}
echo $data;
?>