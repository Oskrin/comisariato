<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

if(pg_query("Update proveedores Set tipo_documento='$_POST[tipo_docu]', identificacion_pro='$_POST[ruc_ci]',empresa_pro='".strtoupper($_POST['empresa_pro'])."',representante_legal='".strtoupper($_POST['representante_legal'])."', visitador='".strtoupper($_POST['visitador'])."', direccion_pro='$_POST[direccion_pro]', telefono='$_POST[nro_telefono]', celular='$_POST[nro_celular]', fax='$_POST[fax]', pais='".strtoupper($_POST['pais_pro'])."', ciudad='".strtoupper($_POST['ciudad_pro'])."', forma_pago='$_POST[forma_pago]', correo='$_POST[correo]', principal='$_POST[principal_pro]', tipo_proveedor='$_POST[tipo_pro]', credito_cupo='$_POST[cupo_credito]', observaciones='$_POST[observaciones_pro]', estado='Activo' where id_proveedor='$_POST[id_proveedor]'")){
   $data = 1;
}

echo $data;
?>
