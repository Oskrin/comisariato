<?php

session_start();
include '../../procesos/base.php';
conectarse();

$consulta = pg_query("select F.id_factura_venta, F.num_factura, F.fecha_actual, F.total_venta, C.nombres_cli, G.descripcion, G.valor, G.saldo, G.acumulado from gastos G, clientes C , factura_venta F where F.id_cliente = C.id_cliente and G.id_factura_venta = F.id_factura_venta and F.id_factura_venta= '$_POST[id]'");
while ($row = pg_fetch_row($consulta)) {
    $lista[] = $row[0];
    $lista[] = $row[1];
    $lista[] = $row[2];
    $lista[] = $row[3];
    $lista[] = $row[4];
    $lista[] = $row[5];
    $lista[] = $row[6];
    $lista[] = $row[7];
    $lista[] = $row[8];
}
echo $lista = json_encode($lista);
?>
