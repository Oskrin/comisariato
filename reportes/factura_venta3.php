<?php
require('../fpdf/fpdf.php');
include '../procesos/base.php';
conectarse();
class PDF extends FPDF {
    var $widths;
    var $aligns;

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            
            //$this->Rect($x,$y,$w,$h);

            $this->MultiCell( $w,5,$data[$i],0,$a,false);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }
    

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r", '', $txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

    
}
$pdf = new PDF('P','mm',array(76,300));
date_default_timezone_set('America/Guayaquil');
$fecha=date('Y-m-d H:i:s', time());   
$pdf->AddPage();
$pdf->SetMargins(0,0,0,0);
$pdf->Ln(0);
$pdf->SetFont('Arial','',10);
$sql=pg_query("select id_factura_venta,num_factura,nombre_empresa,telefono_empresa,direccion_empresa,email_empresa,pagina_web,ruc_empresa,nombres_cli,identificacion,direccion_cli,telefono,ciudad,fecha_actual,forma_pago,fecha_cancelacion,nombre_usuario,apellido_usuario,direccion_cli from factura_venta,clientes,empresa,usuario where factura_venta.id_cliente=clientes.id_cliente and empresa.id_empresa=factura_venta.id_empresa and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_factura_venta='$_GET[id]'");             
    $numfilas = pg_num_rows($sql);
    for ($i=0; $i<$numfilas; $i++)
    {       
        $fila = pg_fetch_row($sql);                             
        $pdf->SetFont('Arial','',10);       
        $pdf->SetX(0);              
        $pdf->Text(2,3,utf8_decode(''."RUC:"),0,'C', 0);////CLIENTE (X,Y)   
        $pdf->Text(20,3,utf8_decode(''.strtoupper($fila[9])),0,'C', 0);////CLIENTE (X,Y)    
        $pdf->Text(2,8,utf8_decode(''."CLIENTE:"),0,'C', 0);////CLIENTE (X,Y)   
        $pdf->Text(20,8,utf8_decode(''.strtoupper($fila[8])),0,'C', 0);////CLIENTE (X,Y)    
        $pdf->Text(2,13,utf8_decode(''."DIR.:"),0,'C', 0);////CLIENTE (X,Y) 
        $pdf->Text(20,13,utf8_decode(''.strtoupper($fila[18])),0,'C', 0);////CLIENTE (X,Y)
        $pdf->Text(2,18,utf8_decode(''."FECHA.:"),0,'C', 0);////CLIENTE (X,Y)   
        $pdf->Text(20,18,utf8_decode(''.strtoupper($fila[13])),0,'C', 0);////CLIENTE (X,Y)  
        $pdf->Ln(10);                           
    }   
    $pdf->SetX(2);      
    $pdf->SetWidths(array(10, 33, 15, 15)); 
    $sql=pg_query("select detalle_factura_venta.cantidad,productos.articulo,detalle_factura_venta.precio_venta,detalle_factura_venta.total_venta from factura_venta,detalle_factura_venta,productos where factura_venta.id_factura_venta=detalle_factura_venta.id_factura_venta and detalle_factura_venta.cod_productos=productos.cod_productos and detalle_factura_venta.id_factura_venta='$_GET[id]'");    
    $pdf->Row(array("Cant",utf8_decode("Descripción"),"Pre. Uni","Pre. Tot"));  
    while($fila = pg_fetch_row($sql)){  
        $pdf->SetX(2);      
        $pdf->SetFont('Arial','',9);            
        $descripcion =  utf8_decode($fila[1]);
        if(strlen($descripcion) > 20){
            $descripcion = substr($descripcion, 0,15);
        }
        
        $pdf->SetX(2);
        $pdf->Row(array(utf8_decode($fila[0]), $descripcion, utf8_decode($fila[2]), utf8_decode($fila[3])));

        
    }   
    $pdf->SetY(115);        
    $sql=pg_query("select tarifa0,tarifa12,iva_venta,descuento_venta,total_venta from factura_venta where id_factura_venta= '$_GET[id]'");    
    $sub0 = 0;                      
    $sub12 = 0;
    $iva = 0;
    $total = 0;
    while($fila = pg_fetch_row($sql)){  
        $tar0 = $fila[0];
    $sub0 = $fila[1];
        $sub12 = $fila[2];
        $iva = $fila[3];
        $total = $fila[4];
    }   
    $pdf->SetX(2);      
        $pdf->SetWidths(array(62, 35));                         
    $pdf->Row(array("Tarifa 0%",$tar0));    
    $pdf->SetX(2);      
    $pdf->SetWidths(array(62, 35));                         
    $pdf->Row(array("Tarifa 12%",$sub0));   
    $pdf->SetX(2);      
    $pdf->SetWidths(array(62, 35));                         
    $pdf->Row(array("Iva 12%",$sub12)); 
    $pdf->SetX(2);      
    $pdf->SetWidths(array(62, 35));                         
    $pdf->Row(array("Total",$total));   
    $pdf->Ln(20);   
    $pdf->SetX(2);      
    
    $pdf->SetY(160);        
    $pdf->Row(array("","."));   
$pdf->Output();
?>