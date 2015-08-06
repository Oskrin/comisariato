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
			<h3>ENTREGA DE EQUIPO</h3>
		</div>';
		include '../../procesos/base.php';
		conectarse();
        $campo1=$_GET['id'].",";
        $campo2=$_GET['val'].",";
        if($campo1[0]!=","){        
            $campo1=','.$campo1;        
        }
        if($campo2[0]!=","){
            $campo2=",".$campo2;
        }
        $vect1 = explode(",", $campo1);
        $vect2 = explode(",", $campo2);          
		$consulta = pg_query("select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_registro='$_GET[id_registro]'");   
         $codigo.='<div id="cuerpo">';   
         $codigo.='<table id="tblEntrega"  border="0" cellpadding="0" cellspacing="0" >';
		  while ($row = pg_fetch_row($consulta)) {			 	           
            $codigo.='<tbody><tr>
                <td style="width:80px;">Registro #: </td>
                <td style="width:65px;">';
                $codigo.=$row[0];
                $codigo.='</td>
                <td style="width:100px;">Fecha Ingreso: </td>
                <td style="width: 120px;">';
                $codigo.=$row[9];
                $codigo.='</td>
                <td style="width:80px">Fecha Salida: </td>
                <td style="width: 80px;">'.$_GET['hoy'].'</td>                
                <td style="width:70px;">Cliente: </td>
                <td style="width:100px;">';
                $codigo.=$row[22];
                $codigo.='</td>
              </tr>
              <tr>
                <td style="width:80px;">Tipo Equipo: </td>
                <td style="width:65px;">';
                $codigo.=$row[45];
                $codigo.='</td>
                <td style="width:100px">Nro de serie: </td>
                <td style="width:120px;">';
                $codigo.=$row[4];
                $codigo.='</td>
                <td style="width:80px;">Modelo: </td>
                <td style="width:80px;">';
                $codigo.=$row[11].'</td>                
                <td style="width:70px;">Marca: </td>
                <td style="width:100px;">';
                $codigo.=$row[18];
                $codigo.='</td>
              </tr>
              <tr>
                <td style="width:80px;">Color Equipo: </td>
                <td style="width:65px;">';
                $codigo.=$row[16];
                $codigo.='</td>
                <td style="width:100px;">Total a Pagar: </td>
                <td style="width:120px;">';
                $codigo.='$ '.$_GET['total'];
                $codigo.='</td>
                <td style="width:80px;">Descuento: </td>
                <td style="width: 80px;">'.$_GET['desc'].'</td>';                                
            }
            //$codigo.="select * from trabajo_tecnico,usuario where trabajo_tecnico.id_trabajotecnico='$_GET[id_registro]' and trabajo_tecnico.id_tecnico=usuario.id_usuario";
            $consulta = pg_query("select * from trabajo_tecnico,usuario where trabajo_tecnico.id_registro='$_GET[id_registro]' and trabajo_tecnico.id_tecnico=usuario.id_usuario");   
                while ($row = pg_fetch_row($consulta)) {                
                    $codigo.='<td style="width:85px">Nombre Técnico: </td>
                    <td style="width: 150px;">';
                    $codigo.=$row[6]." ".$row[7];
                    $codigo.='</td>';
                    $reco=$row[4];

                }
            $codigo.='</tr>';               
            $codigo.='<tr>';               
                    $codigo.='<td colspan="2">Recomendaciones del Técnico</td>
                    <td colspan="6">';
                    $codigo.=$reco;                    
                    $codigo.='</td>
        </td></tbody></table><br>';    
        $codigo.='<table id="tblEntrega1" border="1" cellpadding="0" cellspacing="0">';     
         $codigo.='<tr id="tr1">
            <td style="width:100px">Cantidad </td>            
            <td style="width:400px">Detalle </td>            
            <td style="width:100px">Precio U. </td>            
            <td style="width:100px">Precio Total </td>            
        </tr>';   
        $tamaño = sizeof($vect1);
        for($i=1;$i<$tamaño-1;$i++)
        {
            $codigo.='<tr>
                <td style="width:100px">';
                $codigo.='1';
                $codigo.='</td>            
                <td style="width:414px">';
                $codigo.=$vect1[$i];
                $codigo.='</td>            
                <td style="width:118px">';
                $codigo.='$ '.$vect2[$i]; 
                $codigo.='</td>            
                <td style="width:118px">';
                $codigo.='$ '.$vect2[$i]; 
                $codigo.='</td>            
            </tr>';   
        }
        $codigo.='</table>'; 
        $codigo.='<table id="tblEntrega6" style="margin-left:386px" >';     
        $codigo.='<tr>
            <td style="border:solid 1px;width:115px;height:28px;text-align:center">Subtotal: </td>';           
            $codigo.='<td style="border:solid 1px;width:115px;height:28px;text-align:center">';
            $codigo.="$ ".($_GET['total']+$_GET['desc']);            
            $codigo.='</td>                       
        </tr></table>';
        $codigo.='<table id="tblEntrega7"  style="margin-left:386px">';     
        $codigo.='<tr>
            <td style="border:solid 1px;width:115px;height:28px;text-align:center">Descuento: </td>            
            <td style="border:solid 1px;width:115px;height:28px;text-align:center">';
            $codigo.="$ ".$_GET['desc'];
            $codigo.='</td>                        
        </tr></table> ';
        $codigo.='<table id="tblEntrega8" style="margin-left:386px;">';     
        $codigo.='<tr>
            <td style="border:solid 1px;width:115px;height:28px;text-align:center">Total a Pagar: </td>            
            <td style="border:solid 1px;width:115px;height:28px;text-align:center">';
            $codigo.="$ ".$_GET['total'];
            $codigo.='</td>
        </tr></table>            

        </div>';              
	$codigo.='</body></html>';           				 
$codigo=utf8_decode($codigo);
$dompdf= new DOMPDF();
$dompdf->load_html($codigo);
ini_set("memory_limit","1000M");
$dompdf->set_paper("A4","portrait");
$dompdf->render();
//$dompdf->stream("reporteRegistro.pdf");
$dompdf->stream('reporteEntrega.pdf',array('Attachment'=>0));
?>