<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////////////////contador cuentas x cobrar externas/////////////
$cont = 0;
$consulta = pg_query("select max(id_c_pagarexternas) from c_pagarexternas");
while ($row = pg_fetch_row($consulta)) {
    $cont = $row[0];
}
$cont++;
///////////////////////////////////////////////////////////////

//////guardar cuentas externas/////
$total = $_POST['total'];
$format_numero = number_format($total, 2, '.', '');
pg_query("insert into c_pagarexternas values('$cont', '$_POST[id_proveedor]', '1', '$_SESSION[id]' ,'$_POST[comprobante]' ,'$_POST[fecha_actual]' ,'$_POST[hora_actual]' ,'$_POST[num_factura]','$_POST[tipo_documento]','$format_numero','$format_numero','Activo')");
////////////////////////////////

$data = 1;
echo $data;
?>
