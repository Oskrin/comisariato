<?php
include 'base.php';
conectarse();
//error_reporting(0);
$nuevo=$_POST['existencia'];
$stock=0;
$diferencia=0;
$consulta=pg_query("select stock from productos where cod_productos='$_POST[id]'");
while($row=pg_fetch_row($consulta)){
	$stock=$row[0];
}
$diferencia=$nuevo-$stock;

pg_query("update productos set stock='$nuevo', existencia='$nuevo', diferencia='$diferencia' where cod_productos='$_POST[id]'");
$data = 1;
echo $data;
?>
