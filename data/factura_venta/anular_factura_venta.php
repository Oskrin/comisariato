<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

if ($_POST["tipo_venta"] == "FACTURA") {
    // datos detalle factura
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];

    // modificar estado factura venta
    pg_query("Update factura_venta Set estado = 'Pasivo', fecha_anulacion='$_POST[fecha_anulacion]' where id_factura_venta = '$_POST[comprobante]'");
    
    //
    ////////////modificar cantidades////////
    $arreglo1 = explode('|', $campo1);
    $arreglo2 = explode('|', $campo2);
    $nelem = count($arreglo1);

    for ($i = 0; $i <= $nelem; $i++) {
        // consulta productos
        $consulta = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta)) {
            $stock = $row[13];
        }

        // modificar productos
        $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $stock = $row[13];
        }
        $cal = $stock + $arreglo2[$i];

        pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
        // fin
    }
} else {
    if ($_POST["tipo_venta"] == "NOTA") {
        // datos detalle factura
        $campo1 = $_POST['campo1'];
        $campo2 = $_POST['campo2'];

        // modificar estado factura venta
        pg_query("Update facturas_novalidas Set estado = 'Pasivo', fecha_anulacion='$_POST[fecha_anulacion]' where id_facturas_novalidas = '$_POST[comprobante]'");
        
        // modificar cantidades
        $arreglo1 = explode('|', $campo1);
        $arreglo2 = explode('|', $campo2);
        $nelem = count($arreglo1);

        for ($i = 0; $i <= $nelem; $i++) {
            // consulta productos
            $consulta = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
            while ($row = pg_fetch_row($consulta)) {
                $stock = $row[13];
            }

            // modificar productos
            $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
            while ($row = pg_fetch_row($consulta2)) {
                $stock = $row[13];
            }
            $cal = $stock + $arreglo2[$i];

            pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
            // fin
        }


    }
}

$data = 1;
echo $data;
?>
