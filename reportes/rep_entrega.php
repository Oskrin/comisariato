<?php
require('../dompdf/dompdf_config.inc.php');
session_start();
	$codigo='<html> 
    <head> 
   		<link rel="stylesheet" href="../css/estilosFactura.css" type="text/css" /> 
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
			<h3>ENTREGA DE EQUIPO</h3>
		</div>';
		include '../procesos/base.php';
		conectarse();
        $total=0;
        $id_g=0;
        $sub=0;
        $des=0;
        $sql=pg_query("SELECT * FROM trabajo_tecnico where id_registro='$_GET[id]'");
        while($row=pg_fetch_row($sql)){
            $total=$row[3];
            $id_g=$row[0];
        }
      $consulta = pg_query("select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_registro='$_GET[id]'");   
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
                <td style="width: 80px;">'.$row[9].'</td>                
                <td style="width:70px;">Cliente: </td>
                <td style="width:100px;">';
                $codigo.=$row[24];
                $codigo.='</td>
              </tr>
              <tr>
                <td style="width:80px;">Tipo Equipo: </td>
                <td style="width:65px;">';
                $codigo.=$row[47];
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
                $codigo.=$row[19];
                $codigo.='</td>
              </tr>
              <tr>
                <td style="width:80px;">Color Equipo: </td>
                <td style="width:65px;">';
                $codigo.=$row[16];
                $codigo.='</td>
                <td style="width:100px;">Total a Pagar: </td>
                <td style="width:120px;">';
                $codigo.='$ '.(number_format($total,2,',','.'));
                $codigo.='</td>
                <td style="width:80px;">Descuento: </td>
                <td style="width: 80px;">'.$row[13].'</td>';  
                $des=$row[13];                              
            }
            //$codigo.="select * from trabajo_tecnico,usuario where trabajo_tecnico.id_trabajotecnico='$_GET[id_registro]' and trabajo_tecnico.id_tecnico=usuario.id_usuario";
            $consulta = pg_query("select * from trabajo_tecnico,usuario where trabajo_tecnico.id_registro='$_GET[id]' and trabajo_tecnico.id_tecnico=usuario.id_usuario");   
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
            <td style="width:450px">Detalle </td>            
            <td style="width:100px">Precio U. </td>            
            <td style="width:100px">Precio Total </td>            
        </tr>';   
        $sql=pg_query("select * from detalles_trabajo where id_trabajotecnico='$id_g'");
        while($row=pg_fetch_row($sql)){
            $div=0;
            if($row[2]==0 || $row[5]==0){
                $div=0;
            }
            else{
                $div=($row[2]/$row[5]);
            }
            $div=(number_format($div,2,',','.'));
        $codigo.='<tr id="">
            <td style="width:100px">'.$row[5].' </td>            
            <td style="width:450px">'.$row[1].' </td>            
            <td style="width:100px">'.$div.' </td>            
            <td style="width:100px">'.$row[2].' </td>            
        </tr>';   
        $sub=$sub+$row[2];

        }
        $codigo.='</table>'; 
        $codigo.='<table id="tblEntrega6" style="margin-left:413px;margin-top:-3px;" >';     
        $codigo.='<tr>
            <td style="border:solid 1px;width:97px;height:20px;text-align:center;">Subtotal: </td>';           
            $codigo.='<td style="border:solid 1px;width:97px;height:20px;text-align:center">';
            $codigo.="$ ".$sub;            
            $codigo.='</td>                       
        </tr></table>';
        $codigo.='<table id="tblEntrega7"  style="margin-left:413px;margin-top:-5px;">';     
        $codigo.='<tr>
            <td style="border:solid 1px;width:97px;height:20px;text-align:center">Descuento: </td>            
            <td style="border:solid 1px;width:97px;height:20px;text-align:center">';
            $codigo.="$ ".$des;
            $codigo.='</td>                        
        </tr></table> ';
        $codigo.='<table id="tblEntrega8" style="margin-left:413px;margin-top:-5px;">';     
        $codigo.='<tr>
            <td style="border:solid 1px;width:97px;height:20px;text-align:center">Total a Pagar: </td>            
            <td style="border:solid 1px;width:97px;height:20px;text-align:center">';
            $codigo.="$ ".($sub-$des);
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