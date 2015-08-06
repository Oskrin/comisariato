<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////////////////modificar clientes////////////////////
if (pg_query("Update clientes Set tipo_documento='$_POST[tipo_docu]', identificacion='$_POST[ruc_ci]', nombres_cli='".strtoupper($_POST['nombres_cli'])."', tipo_cliente='$_POST[tipo_cli]', direccion_cli='$_POST[direccion_cli]', telefono='$_POST[nro_telefono]', celular='$_POST[nro_celular]', pais='".strtoupper($_POST['pais_cli'])."', ciudad='".strtoupper($_POST['ciudad_cli'])."' ,correo='$_POST[email]', credito_cupo='$_POST[cupo_credito]', notas='$_POST[notas_cli]', estado='Activo' where id_cliente='$_POST[id_cliente]'")){
$data = 1;	
}
//////////////////////////////////////////////////////

echo $data;
?>
