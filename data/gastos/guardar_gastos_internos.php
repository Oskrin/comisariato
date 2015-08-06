<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////////////////contador cuentas x cobrar externas/////////////
$cont1 = 0;
$consulta = pg_query("select max(id_gastos) from gastos_internos");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;
//////////////////////////  
//
//guardar detalle_factura/////
$total = $_POST['total'];
$format_numero = number_format($total, 2, '.', '');
pg_query("insert into gastos_internos values('$cont1', '$_SESSION[id]', '$_POST[id_proveedor]' ,'$_POST[comprobante]' ,'$_POST[fecha_actual]' ,'$_POST[hora_actual]' ,'$_POST[num_factura]','$_POST[descripcion]','$format_numero','Activo')");
////////////////////////////////

$data = 1;
echo $data;
?>
