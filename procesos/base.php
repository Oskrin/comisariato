<?php

function conectarse() {
    if (!($conexion = pg_pconnect("host=localhost port=5432 dbname=comisariato user=postgres password=sisweb"))) {
        exit();
    } else {
        
    }
    return $conexion;
}

conectarse();
?>
