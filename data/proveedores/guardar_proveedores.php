<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

$cont = 0;
$consulta = pg_query("select max(id_proveedor) from proveedores");
while ($row = pg_fetch_row($consulta)) {
    $cont = $row[0];
}
$cont++;

pg_query("insert into proveedores values('$cont','$_POST[tipo_docu]','$_POST[ruc_ci]','".strtoupper($_POST[empresa_pro])."','".strtoupper($_POST[representante_legal])."','".strtoupper($_POST[visitador])."','$_POST[direccion_pro]','$_POST[nro_telefono]','$_POST[nro_celular]','$_POST[fax]','".strtoupper($_POST[pais_pro])."','".strtoupper($_POST[ciudad_pro])."','$_POST[forma_pago]','$_POST[correo]','$_POST[principal_pro]','$_POST[tipo_pro]','$_POST[cupo_credito]','$_POST[observaciones_pro]','Activo','1')");
$data = 1;
echo $data;
?>
