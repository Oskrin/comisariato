<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];
$tipo = $_GET['tipo_precio'];
$consulta = pg_query("select * from productos where codigo like '%$texto2%' and estado= 'Activo'");

while ($row = pg_fetch_row($consulta)) {
    if ($tipo == "MINORISTA") {
        $data[] = array(
            'value' => $row[1],
            'codigo_barras' => $row[2],
            'producto' => $row[3],
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
                'value' => $row[1],
                'codigo_barras' => $row[2],
                'producto' => $row[3],
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

//$consulta2 = pg_query("select * from productos where cod_barras like '%$texto2%' and estado= 'Activo'");
//while ($row = pg_fetch_row($consulta2)) {
//    if ($tipo == "MINORISTA") {
//        $data[] = array(
//            'value' => $row[2],
//            'producto' => $row[3],
//            'p_venta' => $row[9],
//            'iva_producto' => $row[4],
//            'cod_producto' => $row[0]
//        );
//    } else {
//        if ($tipo == "MAYORISTA") {
//            $data[] = array(
//                'value' => $row[2],
//                'producto' => $row[3],
//                'p_venta' => $row[10],
//                'iva_producto' => $row[4],
//                'cod_producto' => $row[0]
//            );
//        }
//    }
//}

echo $data = json_encode($data);
?>
