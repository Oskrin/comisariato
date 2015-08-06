<?php

session_start();
include 'base.php';
conectarse();

$consulta = pg_query("select D.fecha_pago, D.cuota, D.saldo from pagos_venta P, detalle_pagos_venta D  where P.id_pagos_venta= D.id_pagos_venta  and P.id_pagos_venta= '$_POST[id]' and D.estado = 'Activo' order by D.id_detalle_pagos_venta asc ");
while ($row = pg_fetch_row($consulta)) {
    $lista[] = $row[0];
    $lista[] = $row[1];
    $lista[] = $row[2];
}

echo $lista = json_encode($lista);
?>
