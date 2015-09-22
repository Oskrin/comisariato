<?php
    //require('../fpdf/fpdf.php');
    include '../fpdf/rotation.php';
    include '../procesos/base.php';
    include '../procesos/funciones.php';

    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start();

    class PDF extends PDF_Rotate {   
        var $widths;
        var $aligns;
        function SetWidths($w) {            
            $this->widths=$w;
        }        

        function RotatedText($x, $y, $txt, $angle) {
            //Text rotated around its origin
            $this->Rotate($angle, $x, $y);
            $this->Text($x, $y, $txt);
            $this->Rotate(0);
        }

        function RotatedImage($file, $x, $y, $w, $h, $angle) {
            //Image rotated around its upper-left corner
            $this->Rotate($angle, $x, $y);
            $this->Image($file, $x, $y, $w, $h);
            $this->Rotate(0);
        }                      
    }
    $pdf = new PDF('L','mm','A5');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->SetFont('Arial','B',9);   
    $pdf->SetX(5);    
    $pdf->SetFont('Amble-Regular','',9);     

    $sql=pg_query("select id_devolucion_venta,num_serie,fecha_actual,tarifa0,tarifa12,iva_venta,descuento_venta,total_venta,observaciones,identificacion,nombres_cli,telefono,direccion_cli from devolucion_venta,clientes where devolucion_venta.id_cliente=clientes.id_cliente and devolucion_venta.id_devolucion_venta='$_GET[id]'");    
    while($row = pg_fetch_row($sql)) {
        $cliente = $row[10];
        $ci_ruc = $row[9];
        $direccion = $row[12];
        $telefono = $row[11];
        $fecha = $row[2];
        $nro_fac = substr($row[1],8);
        $iva0 = $row[3];
        $iva12 = $row[4];
        $iva_venta = $row[5];
        $descuento_venta = $row[6];
        $total_venta = $row[7];
        
    }        
    /////////header   
    $pdf->SetFont('Arial','B',10);        
    $pdf->Text(113, 21, maxCaracter(utf8_decode($nro_fac),20),1,0, 'L',0);
    
    /////////medio
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->Text(30, 48, maxCaracter(utf8_decode($cliente),80),1,0, 'L',0);/////cliente
    $pdf->Text(30, 55, maxCaracter(utf8_decode($direccion),50),1,0, 'L',0);////direccion
    $pdf->Text(113, 55, maxCaracter(utf8_decode($telefono),20),1,0, 'L',0);////telefono
    $pdf->Text(30, 62, maxCaracter(utf8_decode($ci_ruc),20),1,0, 'L',0);////ruc ci
    $pdf->Text(113, 62, maxCaracter(utf8_decode($fecha),20),1,0, 'L',0);/////fecha
   
    ////////detalles//////////////////////    
    $sql=pg_query("select id_detalle_deventa,id_devolucion_venta,productos.cod_productos,cantidad,precio_venta,descuento_producto,total_venta,articulo from detalle_devolucion_venta,productos where detalle_devolucion_venta.cod_productos=productos.cod_productos and id_devolucion_venta='$_GET[id]' and productos.incluye_iva = 'No'");
    $yy = 76;
    $iva_base = 1.12;    
    $pdf->SetTextColor(0,0,0);
    while($row = pg_fetch_row($sql)){
        $total_si = 0;
        $total_sit = 0;
        $total_si = $row[6] / $iva_base;
        $total_sit = $total_si / $row[1];
        $total_si = truncateFloat($total_si,2);
        $total_sit = truncateFloat($total_sit,2);

        $pdf->Text(15, $yy, maxCaracter(utf8_decode($row[0]),3),0,1, 'L',0);    
        $pdf->Text(25, $yy, maxCaracter(utf8_decode($row[7]),50),0,0, 'L',0);            
        $pdf->Text(95, $yy, maxCaracter(number_format($total_sit,2,',','.'),6),0,0, 'L',0);            
        $pdf->Text(120, $yy, maxCaracter(number_format($total_si,2,',','.'),6),0,0, 'L',0);            
   
        $yy = $yy + 5;  
    }

    $sql = pg_query("select id_detalle_deventa,id_devolucion_venta,productos.cod_productos,cantidad,precio_venta,descuento_producto,total_venta,articulo from detalle_devolucion_venta,productos where detalle_devolucion_venta.cod_productos=productos.cod_productos and id_devolucion_venta='$_GET[id]' and productos.incluye_iva = 'Si'");
    $pdf->SetTextColor(0,0,0);
    while($row = pg_fetch_row($sql)) {
        $temp_1 =  number_format($row[6],2,',','.');
        $pdf->Text(15, $yy, maxCaracter(utf8_decode($row[3]),3),0,1, 'L',0);    
        $pdf->Text(25, $yy, maxCaracter(utf8_decode($row[7]),50),0,0, 'L',0);    
        $pdf->Text(95, $yy, maxCaracter(utf8_decode($row[4]),6),0,0, 'L',0);    
        $pdf->Text(120, $yy, maxCaracter($temp_1,6),0,0, 'L',0);             
        $yy = $yy + 5;           
    }

    /////////pie        
    $subtotal = truncateFloat($iva12,2);
    $descuento_venta = truncateFloat($descuento_venta,2);
    $iva_venta = truncateFloat($iva_venta,2);
    $iva0 = truncateFloat($iva0,2);
    $total_venta = truncateFloat($total_venta,2);

    $pdf->Text(120, 113, maxCaracter($subtotal,5),0,1, 'L',0);    
    $pdf->Text(120, 119, maxCaracter($iva0,5),0,1, 'L',0);     
    $pdf->Text(120, 125, maxCaracter($iva_venta,5),0,1, 'L',0);    
    $pdf->Text(98, 126, '12',0,1, 'L',0);    
    $pdf->Text(120, 131, maxCaracter($descuento_venta,5),0,1, 'L',0);    
    $pdf->Text(120, 137, maxCaracter($total_venta,10),0,1, 'L',0);    

    $pdf->Output();
?>

<?php
require('../dompdf/dompdf_config.inc.php');
session_start();
	$codigo='<html>
     <head> 
        
    </head>
    <style>
    @page {
        margin-top: 2em;
        margin-left: 3em;
        margin-bottom: 1em;
        margin-right: 2em;
    }
    </style> 
    <body>';    
    include '../procesos/base.php';
    conectarse();  
    $subtotal12=0;
    $subtotal0=0;
    $subtotal=0;
    $iva12=0;
    $total=0;  
    $consulta=pg_query("select id_devolucion_venta,fecha_actual,num_serie,tarifa0,tarifa12,iva_venta,descuento_venta,total_venta,observaciones,identificacion,nombres_cli,telefono,direccion_cli from devolucion_venta,clientes where devolucion_venta.id_cliente=clientes.id_cliente and devolucion_venta.id_devolucion_venta='$_GET[id]'");
    while($row=pg_fetch_row($consulta)){
        $subtotal0=$row[3];
        $subtotal12=$row[4];
        $subtotal=$subtotal12+$subtotal0;
        $iva12=$row[5];
        $total=$row[7];
        $codigo.='<div style="height:93px;border:solid 0px;">
        </div>
        <div style="border:solid 0px;font-size:11px">
            <div style="width:40px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:370px;height:15px;border:solid 0px;display:inline-block;">'.'&nbsp;&nbsp;&nbsp;'.$row[10].'</div>
            <div style="width:100px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:180px;height:15px;border:solid 0px;display:inline-block;">'.$row[1].'</div>
            <div style="width:40px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:180px;height:15px;border:solid 0px;display:inline-block;">&nbsp;&nbsp;&nbsp;'.$row[9].'</div>
            <div style="width:80px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:100px;height:15px;border:solid 0px;display:inline-block;">'.$row[11].'</div>
            <div style="width:165px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:110px;height:15px;border:solid 0px;display:inline-block;">'.$row[2].'</div>
            <div style="width:65px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:340px;height:15px;border:solid 0px;display:inline-block;">&nbsp;&nbsp;&nbsp;'.$row[12].'</div>
            <div style="width:125px;height:15px;border:solid 0px;display:inline-block;"></div>
            <div style="width:155px;height:15px;border:solid 0px;display:inline-block;">'.$row[8].'</div>
        </div>';

        $codigo.='<div style="height:20px;border:solid 0px;display:inline-block;"></div>';
        $sql=pg_query("select id_detalle_deventa,id_devolucion_venta,productos.cod_productos,cantidad,precio_venta,descuento_producto,total_venta,articulo from detalle_devolucion_venta,productos where detalle_devolucion_venta.cod_productos=productos.cod_productos and id_devolucion_venta='$row[0]'");
        while($row1=pg_fetch_row($sql)){            
            $codigo.='<div style="height:240px;border:solid 0px;font-size:11px;text-align:center;">
                <div style="width:95px;height:15px;border:solid 0px;display:inline-block;">'.$row1[3].'</div>
                <div style="width:415px;height:15px;border:solid 0px;display:inline-block;">'.$row1[7].'</div>
                <div style="width:75px;height:15px;border:solid 0px;display:inline-block;">'.$row1[4].'</div>
                <div style="width:105px;height:15px;border:solid 0px;display:inline-block;">'.$row1[6].'</div>
            </div>';   
        }        
        $codigo.='<div style="border:solid 0px;">
        <div style="width:105px;height:15px;border:solid 0px;display:inline-block;"></div>
        <div style="width:370px;height:40px;border:solid 0px;display:inline-block;font-size:11px;overflow:hidden">'.$row[8].'</div>
            <div style="width:110px;height:80px;border:solid 0px;display:inline-block;">
                <div style="width:100px;height:17px;border:solid 0px;"></div>
                <div style="width:100px;height:17px;border:solid 0px;"></div>
                <div style="width:100px;height:17px;border:solid 0px;"></div>
                <div style="width:100px;height:17px;border:solid 0px;"></div>
                <div style="width:100px;height:17px;border:solid 0px;"></div>
            </div>
            <div style="width:110px;height:80px;border:solid 0px;display:inline-block;font-size:11px;text-align:center;">
                <div style="width:120px;height:17px;border:solid 0px;">'.$subtotal12.'</div>
                <div style="width:120px;height:17px;border:solid 0px;">'.$subtotal0.'</div>
                <div style="width:120px;height:17px;border:solid 0px;">'.$subtotal.'</div>
                <div style="width:120px;height:17px;border:solid 0px;">'.$iva12.'</div>
                <div style="width:120px;height:17px;border:solid 0px;">'.$total.'</div>
            </div>
        </div>';
            
    }
 
    $dompdf= new DOMPDF();
    $dompdf->load_html($codigo);
   ini_set("memory_limit","100M");
    $dompdf->set_paper("A5","landscape");
    $dompdf->render();
    //$dompdf->stream("reporteRegistro.pdf");
    $dompdf->stream('notaCredito.pdf',array('Attachment'=>0));
?>