<?php

require('../dompdf/dompdf_config.inc.php');
session_start();
$codigo = '<html> 
    <head> 
   		<link rel="stylesheet" href="../../css/estilosReportes.css" type="text/css" /> 
	</head> 
	<body>
		<header>
			<img src="../../images/logo_empresa.jpg" />
            <div id="me">
                <h2 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['empresa'] . '</h2>
                <h4 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['slogan'] . '</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['propietario'] . '</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['direccion'] . '</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">Telf: ' . $_SESSION['telefono'] . ' Cel:  ' . $_SESSION['celular'] . ' ' . $_SESSION['pais_ciudad'] . '</h4>
            </div>    
		</header>        
		<hr>
		<div id="linea">
			<h3>FORMULARIO DE INGRESO DE EQUIPO</h3>
		</div>';
include '../../procesos/base.php';
conectarse();
$consulta = pg_query("select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_registro='$_GET[id]'");
while ($row = pg_fetch_row($consulta)) {
    $codigo.='<div id="cuerpo">		 
            <h2>Registro #</h2>                                    
            <h2>Fecha Salida</h2>                        
            <h2>Nro. Serie </h2>             
            <h2>Registrado por</h2>          
       		</div>
        	<div id="medio">
            <h2>';
    $codigo.=$row[0] . " ";
    $codigo.='</h2>                                    
            <h2>';
    $codigo.=$row[12] . " ";
    $codigo.='</h2>
            <h2>';
    $codigo.=$row[4] . "";
    $codigo.='</h2>             
            <h2 style="width:379px;height:13px;">';
    $codigo.=$row[36] . " " . $row[37];
    $codigo.='</h2>          
        	</div>
         	<div id="medio1">
            <h2>Cliente</h2>                                    
            <h2>Tipo Equipo</h2>                        
            <h2>Marca</h2>                        
        	</div>
        	<div id="medio2">
            <h2>';
    $codigo.=$row[24] . " ";
    $codigo.='</h2>                                    
            <h2>';
    $codigo.=$row[48] . " ";
    $codigo.='</h2>                        
            <h2>';
    $codigo.= $row[19] . " ";
    $codigo.='</h2>                                  
        	</div>
          	<div id="medio3">
            <h2>Fecha Entrada</h2>                                    
            <h2>Modelo</h2>                        
            <h2>Color</h2>    
            <h2>Celular</h2>                                 
        	</div>
        	<div id="medio4">
            <h2>';
    $codigo.=$row[9] . " ";
    $codigo.='</h2>                                    
            <h2>';
    $codigo.=$row[11] . " ";
    $codigo.='</h2>                        
            <h2>';
    $codigo.=$row[16] . " ";
    $codigo.='</h2>  
            <h2>';
    $codigo.=$row[40] . " ";
    $codigo.='</h2>                           
        	</div>
         	<div id="acce">
                <h2>Accesorios</h2>                                                                                         
                <h2>Observaciones</h2>         
                <h2 style="border:0px;">Nota</h2>         
        	</div>
         	<div id="acce1">            
                <textarea name="">';
    $codigo.=$row[6] . " ";
    $codigo.='</textarea>
                <textarea name="">';
    $codigo.=$row[5] . " ";
    $codigo.='</textarea>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;El diagnóstico del equipo tiene un precio mínimo de $10.00 (Diez Dólares)</h3>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;Toda máquina reparada y no retirada en tres meses será subastada</h3>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;Favor revisar que en su orden consten todos los componentes que usted deja. No se admitiran reclamos posteriores</h3>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;PyS Systems no se responsabiliza por la pérdida de la información</h3>
        	</div>
        	<div>
        	<hr>
        	</div>        
        	<div id="firma">
        	<hr>            
        	</div>    
            <div id="firma1">
            <hr>            
            </div>    
        	<div id="resp">
        	<h2>';
    $codigo.="Entrege conforme: " . $row[36] . " " . $row[37];
    $codigo.='</h2>                          
        	</div>   
            <div id="resp1">
            <h2>';
    $codigo.="Recibi conforme: " . $row[24];
    $codigo.='</h2>             
            </div>';
}

$codigo.='<div id="m"><div id="copia1">
            <img src="../../images/logo_empresa.jpg" />
            <div id="meC">
            <h2 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['empresa'] . '</h2>
                <h4 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['slogan'] . '</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['propietario'] . '</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">' . $_SESSION['direccion'] . '</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">Telf: ' . $_SESSION['telefono'] . ' Cel:  ' . $_SESSION['celular'] . ' ' . $_SESSION['pais_ciudad'] . '</h4>
            </div>                 
        </div>
        <hr>
        <div id="linea">
            <h3>FORMULARIO DE INGRESO DE EQUIPO</h3>
        </div>';
$consulta2 = pg_query("select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_registro='$_GET[id]'");
while ($row = pg_fetch_row($consulta2)) {
    $codigo.='<div id="cuerpo">      
            <h2>Registro #</h2>                                    
            <h2>Fecha Salida</h2>                        
            <h2>Nro. Serie </h2>             
            <h2>Registrado por</h2>          
            </div>
            <div id="medioC">
            <h2>';
    $codigo.=$row[0] . " ";
    $codigo.='</h2>                                    
            <h2>';
    $codigo.=$row[12] . " ";
    $codigo.='</h2>
            <h2>';
    $codigo.=$row[4] . "";
    $codigo.='</h2>             
            <h2 style="width:379px;height:13px;">';
    $codigo.=$row[36] . " " . $row[37];
    $codigo.='</h2>                
            </div>
            <div id="medio1C">
            <h2>Cliente</h2>                                    
            <h2>Tipo Equipo</h2>                        
            <h2>Marca</h2>                        
            </div>
            <div id="medio2C">
            <h2>';
    $codigo.=$row[24] . " ";
    $codigo.='</h2>                                    
            <h2>';
    $codigo.=$row[48] . " ";
    $codigo.='</h2>                        
            <h2>';
    $codigo.= $row[19] . " ";
    $codigo.='</h2>                                  
            </div>
            <div id="medio3C">
            <h2>Fecha Entrada</h2>                                    
            <h2>Modelo</h2>                        
            <h2>Color</h2>       
            <h2>Celular</h2>                                       
            </div>
            <div id="medio4C">
            <h2>';
    $codigo.=$row[9] . " ";
    $codigo.='</h2>                                    
            <h2>';
    $codigo.=$row[11] . " ";
    $codigo.='</h2>                        
            <h2>';
    $codigo.=$row[16] . " ";
    $codigo.='</h2>  
             <h2>';
    $codigo.=$row[40] . " ";
    $codigo.='</h2>                             
            </div>
            <div id="acceC">
                <h2>Accesorios</h2>                                                                                         
                <h2>Observaciones</h2>     
                 <h2 style="border:0px;">Nota</h2>         
            </div>
            <div id="acce1C">            
                <textarea name="">';
    $codigo.=$row[6] . " ";
    $codigo.='</textarea>
                <textarea name="">';
    $codigo.=$row[5] . " ";
    $codigo.='</textarea>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;El diagnóstico del equipo tiene un precio mínimo de $10.00 (Diez Dólares)</h3>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;Toda máquina reparada y no retirada en tres meses será subastada</h3>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;Favor revisar que en su orden consten todos los componentes que usted deja. No se admitiran reclamos posteriores</h3>';
    $codigo.='<h3 style="width:800px;margin:0px;padding:0px;font-size:11px;font-weight:normal;">&nbsp;&nbsp;PyS Systems no se responsabiliza por la pérdida de la información</h3>
            </div>
            <div>
            <hr>
            </div>        
            <div id="firmaC">
            <hr>            
            </div>    
            <div id="firma1C">
            <hr>            
            </div>    
            <div id="respC">
            <h2>';
    $codigo.="Entrege conforme: " . $row[36] . " " . $row[37];
    $codigo.='</h2>                          
            </div>   
            <div id="resp1C">
            <h2>';
    $codigo.="Recibi conforme: " . $row[24];
    $codigo.='</h2>             
            </div></div></body>';
}

$codigo = utf8_decode($codigo);
$dompdf = new DOMPDF();
$dompdf->load_html($codigo);
ini_set("memory_limit", "32M");
$dompdf->set_paper("A4", "portrait");
$dompdf->render();
$dompdf->stream('reporteRegistro.pdf', array('Attachment' => 0));
?>