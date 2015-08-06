<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];

$consulta = pg_query("select * from proveedores where tipo_documento = '$_GET[tipo_docu]' and identificacion_pro like '%$texto2%' and estado= 'Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[2],
        'id_proveedor' => $row[0],
        'empresa' => $row[3]
    );
}
echo $data = json_encode($data);
?>
