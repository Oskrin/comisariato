<?php

function conectarse() {
    if (!($conexion = pg_pconnect("host=localhost port=5432 dbname=comisariato_nuevo user=postgres password=sisweb"))) {
        exit();
    } else {
        
    }
    return $conexion;
}

conectarse();
?>
