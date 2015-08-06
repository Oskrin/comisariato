<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto = $_GET['term'];
$consulta = pg_query("select * from clientes where identificacion like '%$texto%' and estado='Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[2],
        'id_cliente' => $row[0],
        'nombre_cliente' => $row[3],
        'direccion_cliente' => $row[5],
        'telefono_cliente' => $row[7],
        'correo' => $row[10]
    );
}

echo $data = json_encode($data);
?>
