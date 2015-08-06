<?php
require('../dompdf/dompdf_config.inc.php');
session_start();
	$codigo='<html> 
    <head> 
   		<link rel="stylesheet" href="../../css/estilosFactura.css" type="text/css" /> 
	</head> 
	<body>
		<header>
			<img src="../../images/logo_empresa.jpg" />
            <div id="me">
                <h2 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['empresa'].'</h2>
                <h4 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['slogan'].'</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['propietario'].'</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['direccion'].'</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">Telf: '.$_SESSION['telefono'].' Cel:  '.$_SESSION['celular'].' '.$_SESSION['pais_ciudad'].'</h4>
            </div>    
		</header>
		<hr>
		<div id="linea">
			<h3>TÉCNICOS DE COMPULINK</h3>
		</div>';
		include '../../procesos/base.php';
		conectarse();        
		$consulta = pg_query("select * from trabajo_tecnico, registro_equipo,color,marcas,categoria,clientes,usuario where trabajo_tecnico.id_registro=registro_equipo.id_registro and registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_cliente=clientes.id_cliente and trabajo_tecnico.id_tecnico=usuario.id_usuario and usuario.id_usuario='$_GET[id]'");   
         $codigo.='<div id="cuerpo">';          

		  while ($row = pg_fetch_row($consulta)) {			 	                      
              $codigo.='<table id="tblEntrega" border="2">';
                $codigo.='<tr>                
                <td style="width:100px">Registro #: </td>
                <td style="width:100px">';
                $codigo.=$row[2];
                $codigo.='</td>
                <td style="width:100px">Fecha Ingreso: </td>
                <td style="width:150px">';
                $codigo.=$row[14];
                $codigo.='</td>
                <td style="width:100px">Fecha Salida: </td>
                <td style="width:150px">';
                $codigo.=$row[17];
                $codigo.='</td>
                <td style="width:80px">Cliente: </td>
                <td style="width:150px">';
                $codigo.=$row[31]." ".$row[32];
                $codigo.='</td>
                </tr><tr>
                <td style="width:100px">Tipo Equipo: </td>
                <td style="width:100px">';
                $codigo.=$row[25];
                $codigo.='</td>
                <td style="width:100px">Nro de serie: </td>
                <td style="width:150px">';
                $codigo.=$row[9];
                $codigo.='</td>
                <td style="width:100px">Modelo: </td>
                <td style="width:150px">';
                $codigo.=$row[16];
                $codigo.='</td>
                <td style="width:80px">Marca: </td>
                <td style="width:150px">';
                $codigo.=$row[23];
                $codigo.='</td></tr><tr>
                <td style="width:100px">Técnico: </td>
                <td style="width:100px" colspan="3"><b>';
                $codigo.=$row[35]." ".$row[36];
                $codigo.='</b></td>
                <td>Total Repración: </td>
                <td>';
                $codigo.="$ ".$row[3];
                $codigo.='</td>
                <td>Descuento: </td><td>';
                $codigo.="$ ".$row[18];
                $codigo.='</td></tr>';                                                                                  
                $codigo.='</table>';                   
            }                       
            $codigo.='<br>';
            $codigo.='</div>';                
    	   $codigo.='</body></html>';           				 
$codigo=utf8_decode($codigo);
$dompdf= new DOMPDF();
$dompdf->load_html($codigo);
ini_set("memory_limit","32M");
$dompdf->set_paper("A4","landscape");
$dompdf->render();
//$dompdf->stream("reporteRegistro.pdf");
$dompdf->stream('reporteTecnico.pdf',array('Attachment'=>0));
?>