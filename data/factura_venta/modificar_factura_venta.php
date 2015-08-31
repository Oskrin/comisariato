<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

//////////////////compaprar tipo venta///////////
if ($_POST["tipo_venta"] == "FACTURA") {
//////////////contador clientes///////////////////
    $contt = 0;
    $consulta_cli = pg_query("select max(id_cliente) from clientes");
    while ($row = pg_fetch_row($consulta_cli)) {
        $contt = $row[0];
    }
    $contt++;
///////////////////////////////////

    if ($_POST['id_cliente'] == "") {

        $tipo = $_POST['ruc_ci'];
        if (strlen($tipo) == 10) {
            //////////////////guardar clientes/////////////    
            pg_query("insert into clientes values('$contt','Cedula','$_POST[ruc_ci]','$_POST[nombre_cliente]','natural','$_POST[direccion_cliente]','$_POST[telefono_cliente]','','','','$_POST[correo]','','','Activo','1')");
            ////////////////////////////////////////////
            //
            ////////////guardar factura venta////////
            pg_query("insert into factura_venta values('$cont1','1','$contt','$_SESSION[id]','$cont1','$_POST[num_factura]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[cancelacion]','$_POST[tipo_precio]','$_POST[formas]','$_POST[autorizacion]','$_POST[fecha_auto]','$_POST[fecha_caducidad]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo','')");
                ////////////////////////////////////////
        } else {
            if (strlen($tipo) == 13) {
                //////////////////guardar clientes/////////////    
                pg_query("insert into clientes values('$contt','Ruc','$_POST[ruc_ci]','$_POST[nombre_cliente]','natural','$_POST[direccion_cliente]','$_POST[telefono_cliente]','','','','$_POST[correo]','','','Activo','1')");
                ////////////////////////////////////////////
                //
                ////////////guardar factura venta////////
                pg_query("insert into factura_venta values('$cont1','1','$contt','$_SESSION[id]','$cont1','$_POST[num_factura]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[cancelacion]','$_POST[tipo_precio]','$_POST[formas]','$_POST[autorizacion]','$_POST[fecha_auto]','$_POST[fecha_caducidad]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo','')");
                ////////////////////////////////////////    
            }
        }
    } else {
        ////////////modificar factura venta////////
        // pg_query("insert into factura_venta values('$cont1','1','$_POST[id_cliente]','$_SESSION[id]','$cont1','$_POST[num_factura]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[cancelacion]','$_POST[tipo_precio]','$_POST[formas]','$_POST[autorizacion]','$_POST[fecha_auto]','$_POST[fecha_caducidad]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo','')");
        pg_query("Update factura_venta Set id_cliente = '$_POST[id_cliente]', id_usuario = '$_SESSION[id]', fecha_actual = '$_POST[fecha_actual]', hora_actual = '$_POST[hora_actual]', fecha_cancelacion = '$_POST[cancelacion]', tipo_precio = '$_POST[tipo_precio]', num_autorizacion = '$_POST[autorizacion]', fecha_autorizacion = '$_POST[fecha_auto]', fecha_caducidad = '$_POST[fecha_caducidad]', tarifa0 = '$_POST[tarifa0]', tarifa12 = '$_POST[tarifa12]', iva_venta = '$_POST[iva]', descuento_venta = '$_POST[desc]', total_venta = '$_POST[tot]' where id_factura_venta = '$_POST[id_factura_venta]'");
    ////////////////////////////////////////
    }

    // sumar stock productos
    $consulta = pg_query("select * from detalle_factura_venta where id_factura_venta = '$_POST[id_factura_venta]'");
    while ($row = pg_fetch_row($consulta)) {
           $canti1 = $row[3];
           $id = $row[2];
           $consulta2 = pg_query("select * from productos where cod_productos = '".$id."'"); 
           while ($row = pg_fetch_row($consulta2)) {
                  $canti2 = $row[13];
           }
           
           $cal1 = $canti2 + $canti1;
           pg_query("Update productos Set stock='".$cal1."' where cod_productos='".$id."'");
        }
    // fin suma
    
    // eliminar detalle productos
    pg_query("DELETE FROM  detalle_factura_venta where id_factura_venta = '$_POST[id_factura_venta]'");
    // fin  

    // datos detalle factura
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];
    $campo3 = $_POST['campo3'];
    $campo4 = $_POST['campo4'];
    $campo5 = $_POST['campo5'];
    $campo6 = $_POST['campo6'];
    // fin 

    // agregar detalle_factura_venta
    $arreglo1 = explode('|', $campo1);
    $arreglo2 = explode('|', $campo2);
    $arreglo3 = explode('|', $campo3);
    $arreglo4 = explode('|', $campo4);
    $arreglo5 = explode('|', $campo5);
    $arreglo6 = explode('|', $campo6);
    $nelem = count($arreglo1);
    /// fin

    for ($i = 0; $i <= $nelem; $i++) {

        /////////////////contador detalle factura venta/////////////
        $cont6 = 0;
        $consulta = pg_query("select  max(id_detalle_venta) from detalle_factura_venta");
        while ($row = pg_fetch_row($consulta)) {
            $cont6 = $row[0];
        }
        $cont6++;
        //////////////////////////  
        //
    //////////////guardar detalle_venta////////
        pg_query("insert into detalle_factura_venta values('$cont6','$_POST[id_factura_venta]','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo','$arreglo6[$i]')");
        ////////////////////////////////////////////
        //
    //////////////modificar productos///////////
        $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $stock = $row[13];
        }
        $cal = $stock - $arreglo2[$i];

        pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
        ///////////////////////////////////////////
    }
    $data = $_POST['id_factura_venta'];
    ///////////////////cambio nota venta///////////////////
} else {
    if ($_POST["tipo_venta"] == "NOTA") {
       
        /////////////////contador factura venta no valida///////////
        $cont1 = 0;
        $consulta = pg_query("select max(id_facturas_novalidas) from facturas_novalidas");
        while ($row = pg_fetch_row($consulta)) {
            $cont1 = $row[0];
        }
        $cont1++;
//////////////////////////////////////////////////
//
//////////////contador clientes///////////////////
        $contt = 0;
        $consulta_cli = pg_query("select max(id_cliente) from clientes");
        while ($row = pg_fetch_row($consulta_cli)) {
            $contt = $row[0];
        }
        $contt++;
///////////////////////////////////

        if ($_POST['id_cliente'] === "") {

            $tipo = $_POST['ruc_ci'];
            if (strlen($tipo) == 10) {
//////////////////guardar clientes/////////////    
                pg_query("insert into clientes values('$contt','Cedula','$_POST[ruc_ci]','$_POST[nombre_cliente]','natural','$_POST[direccion_cliente]','$_POST[telefono_cliente]','','','','$_POST[correo]','','','Activo')");
////////////////////////////////////////////
//
////////////guardar facturas_novalidas////////
                pg_query("insert into facturas_novalidas values('$cont1','$_POST[id_cliente]','$_SESSION[id]','$cont1','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[tipo_precio]','$_POST[formas]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo')");
////////////////////////////////////////
            } else {
                if (strlen($tipo) == 13) {
                    //////////////////guardar clientes/////////////    
                    pg_query("insert into clientes values('$contt','Ruc','$_POST[ruc_ci]','$_POST[nombre_cliente]','natural','$_POST[direccion_cliente]','$_POST[telefono_cliente]','','','','$_POST[correo]','','','Activo')");
////////////////////////////////////////////
//
////////////guardar facturas_novalidas////////
                    pg_query("insert into facturas_novalidas values('$cont1','$_POST[id_cliente]','$_SESSION[id]','$cont1','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[tipo_precio]','$_POST[formas]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo')");
////////////////////////////////////////    
                }
            }
        } else {
            ////////////guardar facturas_novalidas////////
            pg_query("insert into facturas_novalidas values('$cont1','$_POST[id_cliente]','$_SESSION[id]','$cont1','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[tipo_precio]','$_POST[formas]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo')");
////////////////////////////////////////
        }

        /////datos detalle factura/////
        $campo1 = $_POST['campo1'];
        $campo2 = $_POST['campo2'];
        $campo3 = $_POST['campo3'];
        $campo4 = $_POST['campo4'];
        $campo5 = $_POST['campo5'];
        $campo6 = $_POST['campo6'];
        /////////////////////////////
        //
        ////////////agregar detalle_factura_venta////////
        $arreglo1 = explode('|', $campo1);
        $arreglo2 = explode('|', $campo2);
        $arreglo3 = explode('|', $campo3);
        $arreglo4 = explode('|', $campo4);
        $arreglo5 = explode('|', $campo5);
        $arreglo6 = explode('|', $campo6);
        $nelem = count($arreglo1);
        $forma = $_POST['formas'];
///////////////////////////////////////////

        if ($forma === "Credito") {
            //variables pagos////
            $adelanto = $_POST['adelanto'];
            $meses = $_POST['meses'];
            $total = $_POST['tot'];
            ///////////////
            //
    ///////contador pagos venta//////
            $cont2 = 0;
            $consulta = pg_query("select max(id_pagos_venta) from pagos_venta");
            while ($row = pg_fetch_row($consulta)) {
                $cont2 = $row[0];
            }
            $cont2++;
            /////////////////////////////////
            //
    //////////////guardar pagos venta//////////
            if ($adelanto === "") {
                $monto = $total;
                $format = number_format($monto, 2, '.', '');
                $adelanto = 0.00;
            } else {
                $monto = $total - $adelanto;
                $format = number_format($monto, 2, '.', '');
            }
            ////////////////////////////////////////////////////

            pg_query("insert into pagos_venta values('$cont2','$_POST[id_cliente]','$cont1','$_SESSION[id]','$_POST[fecha_actual]','$adelanto','$meses','Factura','$format','$format','Activo')");
            /////////////////////////////////////////////////////////
            //
    ////////////////Guardar meses///////////////////////////
            if ($meses > 1) {
                for ($i = 1; $i <= $meses - 1; $i++) {
                    /////////////contador detalle pagos compra/////
                    $cont3 = 0;
                    $consulta8 = pg_query("select max(id_detalle_pagos_venta) from detalle_pagos_venta");
                    while ($row = pg_fetch_row($consulta8)) {
                        $cont3 = $row[0];
                    }
                    $cont3++;
                    //////////////////////////////

                    $calcu = $monto / ($meses);
                    $nuevaFecha = date('Y-m-d', strtotime(" + $i month"));
                    $format_numero = number_format(floor($calcu), 2, '.', '');
                    pg_query("insert into detalle_pagos_venta values('$cont3','$cont2','$nuevaFecha','$format_numero','$format_numero','Activo')");
                }
                $cont3++;
                $calcu1 = floor($calcu) * ($meses - 1);
                $ultimaFecha = date('Y-m-d', strtotime(" + $i month"));
                $sal = $monto - $calcu1;
                $format_numero2 = number_format($sal, 2, '.', '');
                pg_query("insert into detalle_pagos_venta values('$cont3','$cont2','$ultimaFecha','$format_numero2','$format_numero2','Activo')");
            } else {
                $cont3 = 0;
                $consulta8 = pg_query("select max(id_detalle_pagos_venta) from detalle_pagos_venta");
                while ($row = pg_fetch_row($consulta8)) {
                    $cont3 = $row[0];
                }
                $cont3++;
                ////////////////////////////

                $k = 1;
                $format2 = number_format($monto, 2, '.', '');
                $Fecha = date('Y-m-d', strtotime(" + $k month"));
                pg_query("insert into detalle_pagos_venta values('$cont3','$cont2','$Fecha','$format2','$format2','Activo')");
            }
            //////////////////////////////////////////////////////  
            //
    ////////////////guardar detalle_factura_novalidas/////
            for ($i = 0; $i <= $nelem; $i++) {
                /////////////////contador detalle_factura_novalidas/////////////
                $cont4 = 0;
                $consulta = pg_query("select max(id_detalle_facturas_novalidas) from detalle_facturas_novalidas");
                while ($row = pg_fetch_row($consulta)) {
                    $cont4 = $row[0];
                }
                $cont4++;
                //////////////////////////  
                //
            ///guardar detalle_factura_novalidas/////
                pg_query("insert into detalle_facturas_novalidas values('$cont4','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo','$arreglo6[$i]')");
                ////////////////////////////////
                //
            //////////////modificar productos///////////
                $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
                while ($row = pg_fetch_row($consulta2)) {
                    $stock = $row[13];
                }
                $cal = $stock - $arreglo2[$i];

                pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
                ///////////////////////////////////////////
            }
        } else {
            if ($forma === "Contado") {
                for ($i = 0; $i <= $nelem; $i++) {

                    /////////////////contador detalle_factura_novalidas/////////////
                    $cont6 = 0;
                    $consulta = pg_query("select  max(id_detalle_facturas_novalidas) from detalle_facturas_novalidas");
                    while ($row = pg_fetch_row($consulta)) {
                        $cont6 = $row[0];
                    }
                    $cont6++;
                    //////////////////////////  
                    //
                //////////////guardar detalle_factura_novalidas////////
                    pg_query("insert into detalle_facturas_novalidas values('$cont6','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo','$arreglo6[$i]')");
                    ////////////////////////////////////////////
                    //
                //////////////modificar productos///////////
                    $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
                    while ($row = pg_fetch_row($consulta2)) {
                        $stock = $row[13];
                    }
                    $cal = $stock - $arreglo2[$i];

                    pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
                    ///////////////////////////////////////////
                }
            }
        }
        $data = $cont1;
    }
}

echo $data;
?>
