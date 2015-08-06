<?php

include 'base.php';
conectarse();
session_start();
$data = 0;

pg_query("update usuario set nombre_usuario='$_POST[userNombre]',apellido_usuario='$_POST[userApellido]',ci_usuario='$_POST[userCi]',telefono_usuario='$_POST[userTelefono]',celular_usuario='$_POST[userCelular]',clave='$_POST[userPass]',email_usuario='$_POST[userEmail]',direccion_usuario='$_POST[userDirección]',usuario='$_POST[userNick]' where id_usuario='$_SESSION[id]'");
echo $data;
?>
