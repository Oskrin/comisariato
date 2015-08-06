<?php
session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from unidades_medida where descripcion='" . strtoupper($_POST['descripcion']) . "'");
while ($row = pg_fetch_row($consulta)) {
   $repe++;
}
//////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_unidades) from unidades_medida");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into unidades_medida values('$cont','" . strtoupper($_POST['descripcion']) . "','" . strtoupper($_POST['abreviatura']) . "','$_POST[cantidad]','Activo')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        pg_query("update unidades_medida set descripcion='" . strtoupper($_POST['descripcion']) . "', abreviatura='" . strtoupper($_POST['abreviatura']) . "', cantidad = '$_POST[cantidad]', Estado = 'Activo' where id_unidades='$_POST[id_unidades]'");
        
    }
}
?>
