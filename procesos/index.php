<?php

session_start();
include 'base.php';
conectarse();
$data = "";
$cont = 0;

$contrasena = md5($_POST['clave']);

$consulta = pg_query("select * from usuario where usuario='$_POST[usuario]' and clave='$contrasena'");
while ($row = pg_fetch_row($consulta)) {
    $cont = 1;
    $_SESSION['id'] = $row[0];
    $_SESSION['nombres'] = $row[1] . " " . $row[2];
    $_SESSION['cargo'] = $row[6];
    $_SESSION['user'] = $row[10];
    $consulta2 = pg_query("select * from empresa");
    while ($row = pg_fetch_row($consulta2)) {
        $_SESSION['empresa'] = $row[1];
        $_SESSION['slogan'] = $row[11];
        $_SESSION['propietario'] = $row[12];
        $_SESSION['direccion'] = $row[3];
        $_SESSION['telefono'] = "";
        $_SESSION['celular'] = $row[5];
        $_SESSION['pais_ciudad'] = $row[6] . " - ".  $row[7];
    }
}

if ($cont == 1) {
    $data = 1;
} else {
    $data = 0;
}

echo $data;
?>
