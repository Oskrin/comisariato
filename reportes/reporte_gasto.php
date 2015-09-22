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
            $this->Cell(190, 8, $_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,45,30);
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
            $this->Cell(190, 5, utf8_decode("GASTOS INTERNOS "),0,1, 'C',0);                                                                                                                            
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
    
    $total=0;
    $sub=0;
    $repetido=0;   
    $contador=0; 
    $pv=0;
    $pc=0;
    $sql=pg_query("select * from gastos_internos,usuario,proveedores where gastos_internos.id_usuario=usuario.id_usuario and gastos_internos.id_proveedor=proveedores.id_proveedor and comprobante='$_GET[id]'");
    while($row=pg_fetch_row($sql)) {
        $pdf->SetX(1); 
        $pdf->SetFillColor(187, 179, 180);            
        $pdf->Cell(90, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[24]),35),1,0, 'L',1);                                     
        $pdf->Cell(115, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[25]),50),1,1, 'L',1);                                             
        $pdf->Ln(3);
        
        $pdf->SetX(1); 
        $pdf->Cell(40, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
        $pdf->Cell(60, 6, utf8_decode('Nro. Factura'),1,0, 'C',0);                                     
        $pdf->Cell(25, 6, utf8_decode('Fecha'),1,0, 'C',0);                                             
        $pdf->Cell(60, 6, utf8_decode('Descripción'),1,0, 'C',0);                                             
        $pdf->Cell(20, 6, utf8_decode('Total'),1,1, 'C',0);                                   
        
        $pdf->Cell(40, 6, utf8_decode($row[3]),0,0, 'C',0);                                         
        $pdf->Cell(60, 6, utf8_decode($row[6]),0,0, 'C',0);                                         
        $pdf->Cell(25, 6, utf8_decode($row[4]),0,0, 'C',0);                                         
        $pdf->Cell(60, 6, maxCaracter(utf8_decode($row[7]),25),0,0, 'L',0);                                         
        $pdf->Cell(20, 6, utf8_decode($row[8]),0,1, 'C',0);                                         
    }    
    $pdf->Output();
?>