<?php
include 'base.php';
conectarse();
session_start();
$lista;
$data;
$consulta = pg_query("select * from usuario where id_usuario='$_SESSION[id]'");   
while ($row = pg_fetch_row($consulta)) {
		$lista[]=$row[0];
		$lista[]=$row[1];
		$lista[]=$row[2];	
		$lista[]=$row[3];			
		$lista[]=$row[4];			
		$lista[]=$row[5];			
		$lista[]=$row[7];			
		$lista[]=$row[8];			
		$lista[]=$row[9];			
		$lista[]=$row[10];			

}
echo $data=json_encode($lista);  
?>