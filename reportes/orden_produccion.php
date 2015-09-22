<?php
    require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start();

    class PDF extends FPDF {   
        var $widths;
        var $aligns;       
        function SetWidths($w) {            
            $this->widths=$w;
        } 

        function Header() {                         
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8,$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,26);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,45,210,45);            
            $this->SetFont('Arial','B',12);                                                                            
            $this->Cell(190, 5, utf8_decode("ORDENES DE PRODUCCIÓN"),0,1, 'C',0);                                                                                                                            
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(3);
            $this->SetFillColor(255,255,225);            
            $this->SetLineWidth(0.2);                                        
        }
        function Footer() {            
            $this->SetY(-15);            
            $this->SetFont('Arial','I',8);            
            $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
        }               
    }
    $pdf = new PDF('P','mm','a4');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->SetFont('Arial','B',9);   
    $pdf->SetX(5);    
    $pdf->SetFont('Amble-Regular','',9); 


    $sum=0; 
    $cant=0;
    $sql=pg_query("select * from ordenes_produccion,productos where ordenes_produccion.cod_productos=productos.cod_productos and id_ordenes='$_GET[id]'");    
    while($row=pg_fetch_row($sql)){
        $pdf->SetX(1); 
        $pdf->Cell(22, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
        $pdf->Cell(25, 6, utf8_decode('Fecha'),1,0, 'C',0);                                     
        $pdf->Cell(20, 6, utf8_decode('Cantidad'),1,0, 'C',0);                                     
        $pdf->Cell(25, 6, utf8_decode('Precio Venta'),1,0, 'C',0);                                     
        $pdf->Cell(35, 6, utf8_decode('Código'),1,0, 'C',0);                                     
        $pdf->Cell(50, 6, utf8_decode('Producto'),1,0, 'C',0);                                     
        $pdf->Cell(30, 6, utf8_decode('T. Precio Venta'),1,1, 'C',0);                                     
        $pdf->Ln(1);

        $pdf->SetX(1); 
        $pdf->Cell(22, 6, utf8_decode($row[2]),0,0, 'C',0);                
        $pdf->Cell(25, 6, utf8_decode($row[3]),0,0, 'C',0);                
        $pdf->Cell(20, 6, utf8_decode($row[6]),0,0, 'C',0);                
        $pdf->Cell(25, 6, utf8_decode($row[18]),0,0, 'C',0);                                        
        $pdf->Cell(35, 6, utf8_decode($row[10]),0,0, 'L',0);                                        
        $pdf->Cell(50, 6, utf8_decode($row[12]),0,0, 'L',0);                                        
        $pdf->Cell(30, 6, (number_format(($row[6]*$row[18]),2,',','.')),0,1, 'C',0);                                        
        $cant=$row[6];
    }
    $pdf->Ln(5);
    $pdf->SetX(1); 
    $pdf->Cell(30, 6, utf8_decode('Cantidad'),1,0, 'C',0);                                     
    $pdf->Cell(40, 6, utf8_decode('Cod. Producto'),1,0, 'C',0);                                     
    $pdf->Cell(87, 6, utf8_decode('Descripción'),1,0, 'C',0);                                     
    $pdf->Cell(25, 6, utf8_decode('P. Unitario'),1,0, 'C',0);                                     
    $pdf->Cell(25, 6, utf8_decode('P. Total'),1,1, 'C',0);  

    $sql=pg_query("select * from detalles_ordenes,productos where detalles_ordenes.cod_productos=productos.cod_productos and id_ordenes='$_GET[id]'");
    while($row=pg_fetch_row($sql)) {
        $pdf->SetX(1);
        $pdf->Cell(30, 6, utf8_decode($row[3]),0,0, 'C',0);                                        
        $pdf->Cell(40, 6, utf8_decode($row[8]),0,0, 'C',0);                                        
        $pdf->Cell(87, 6, utf8_decode($row[10]),0,0, 'L',0);                                        
        $pdf->Cell(25, 6, utf8_decode($row[4]),0,0, 'C',0);                                        
        $pdf->Cell(25, 6, utf8_decode($row[5]),0,1, 'C',0);                                                
        $sum=$sum+$row[5];     
    }
    $pdf->SetX(1);                                             
    $pdf->Cell(207, 0, utf8_decode(""),1,1, 'R',0);
    $pdf->Cell(185, 6, utf8_decode("Total Orden"),0,0, 'R',0);
    $pdf->Cell(23, 6, (number_format($sum,2,',','.')),0,1, 'C',0);                        
    $pdf->Cell(185, 6, utf8_decode("Precio por Producto"),0,0, 'R',0);
    $pdf->Cell(23, 6, number_format(($sum/$cant),2,',','.'),0,1,'C',0);                        
    $pdf->Ln(8);           
   
    $pdf->Output();
?>