<?php
include 'base.php';
conectarse();
$consulta = pg_query("select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.estado='2' and clientes.id_cliente='$_GET[cod]'"); 	
    
    while ($row = pg_fetch_row($consulta)) {
    echo "<option id=$row[0] value=$row[0]>$row[39] $row[11] $row[12] </option>";
   
}
?>