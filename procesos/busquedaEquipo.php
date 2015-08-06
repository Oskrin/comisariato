<?php
include 'base.php';
conectarse();
$data = array();
//$texto=ucwords($_GET['term']);
$texto=$_GET['term'];
$consulta = pg_query("select * from categoria where nombre_categoria like '%$texto%'");   
while ($row = pg_fetch_row($consulta)) {	
	$data[] = array(		
		'value' => $row[1],
		'label' => $row[0]
	);
}
echo $data=json_encode($data);  
?>



	