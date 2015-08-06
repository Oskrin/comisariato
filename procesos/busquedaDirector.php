<?php

session_start();
include 'base.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select id_director, identificacion_dire ,nombres from directores where identificacion_dire like '%$texto%' or nombres like '%$texto%'");

while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[0],
        'label' => $row[2]
    );
}
echo $data = json_encode($data);
?>

