<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];
$tipo = $_GET['tipo_precio'];
$consulta = pg_query("select * from productos where articulo like '%$texto2%' and estado= 'Activo'");

while ($row = pg_fetch_row($consulta)) {
    if ($tipo == "MINORISTA") {
        $data[] = array(
            'value' => $row[3],
            'codigo_barras' => $row[2],
            'codigo' => $row[1],
            'p_venta' => $row[9],
            'descuento' => $row[19],
            'des' => $row[19],
            'iva_producto' => $row[4],
            'cod_producto' => $row[0],
            'incluye' => $row[26]
        );
    } else {
        if ($tipo == "MAYORISTA") {
            $data[] = array(
                'value' => $row[3],
                'codigo_barras' => $row[2],
                'codigo' => $row[1],
                'p_venta' => $row[10],
                'descuento' => $row[19],
                'des' => $row[19],
                'iva_producto' => $row[4],
                'cod_producto' => $row[0],
                'incluye' => $row[26]
            );
        }
    }
}

echo $data = json_encode($data);
?>
