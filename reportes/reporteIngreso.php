<?php
    require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start()   ;
    class PDF extends FPDF{   
        var $widths;
        var $aligns;       
        function SetWidths($w){            
            $this->widths=$w;
        }                       
        function Header(){                         
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,25);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,46,210,46);            
            $this->SetFont('Arial','B',12);                                                                            
            $this->Cell(190, 5, utf8_decode("INGRESOS "),0,1, 'C',0);                                                                                                                            
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(3);
            $this->SetFillColor(255,255,225);            
            $this->SetLineWidth(0.2);                                        
        }
        function Footer(){            
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
    

    $sql=pg_query("select * from ingresos,usuario,empresa where ingresos.id_usuario=usuario.id_usuario and ingresos.id_empresa=empresa.id_empresa  and comprobante='$_GET[comprobante]'");        
    while($row=pg_fetch_row($sql)){ 
        $pdf->SetX(1); 
        $pdf->SetFillColor(187, 179, 180);            
        $pdf->Cell(90, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[18]),35),1,0, 'L',1);                                     
        $pdf->Cell(115, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[17].' '.$row[16]),35),1,1, 'L',1);                                     
        $pdf->SetX(1); 
        $pdf->Cell(75, 6, maxCaracter(utf8_decode('ORIGEN:'.$row[6]),50),1,0, 'L',1);                                             
        $pdf->Cell(70, 6, maxCaracter(utf8_decode('DESTINO:'.$row[7]),50),1,0, 'L',1);                                             
        $pdf->Cell(60, 6, maxCaracter(utf8_decode('FECHA INGRESO:'.$row[4]),50),1,1, 'L',1);    
        $pdf->Ln(3);       
        
        $pdf->SetX(1);
        $pdf->Cell(25, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                         
        $pdf->Cell(30, 6, utf8_decode('Código'),1,0, 'C',0);                                         
        $pdf->Cell(60, 6, utf8_decode('Producto'),1,0, 'C',0);                                         
        $pdf->Cell(20, 6, utf8_decode('Cantidad'),1,0, 'C',0);                                         
        $pdf->Cell(25, 6, utf8_decode('Precio Costo'),1,0, 'C',0);                                         
        $pdf->Cell(25, 6, utf8_decode('Precio Venta'),1,0, 'C',0);                                         
        $pdf->Cell(20, 6, utf8_decode('Total'),1,1, 'C',0);                   
    
        $temp1=$row[8];
        $temp2=$row[9];
        $temp3=$row[10];
        $temp4=$row[11];
        $temp5=$row[12];            
    }
    $sql=pg_query("select * from detalle_ingreso,productos where detalle_ingreso.cod_productos=productos.cod_productos and id_ingresos='$_GET[comprobante]'");        
    while($row=pg_fetch_row($sql)){            
        $pdf->Cell(25, 6, utf8_decode($row[1]),0,0, 'C',0);                                             
        $pdf->Cell(30, 6, maxCaracter(utf8_decode($row[9]),15),0,0, 'L',0);                                             
        $pdf->Cell(60, 6, maxCaracter(utf8_decode($row[11]),25),0,0, 'L',0);                                             
        $pdf->Cell(20, 6, utf8_decode($row[3]),0,0, 'C',0);                                             
        $pdf->Cell(25, 6, utf8_decode($row[4]),0,0, 'C',0);                      
        $pdf->Cell(25, 6, utf8_decode($row[17]),0,0, 'C',0);                              
        $pdf->Cell(20, 6, utf8_decode($row[6]),0,1, 'C',0);                                      
    }
    
    $pdf->SetX(1);
    $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',1);                                     
    $pdf->Cell(186, 6, utf8_decode('Tarifa 0:'),0,0, 'R',0);                                         
    $pdf->Cell(20, 6,(number_format($temp1,2,',','.')) ,0,1, 'C',0);          

    $pdf->SetX(1);    
    $pdf->Cell(186, 6, utf8_decode('Tarifa 12:'),0,0, 'R',0);                                         
    $pdf->Cell(20, 6,(number_format($temp2,2,',','.')) ,0,1, 'C',0);          

    $pdf->SetX(1);    
    $pdf->Cell(186, 6, utf8_decode('Iva:'),0,0, 'R',0);                                         
    $pdf->Cell(20, 6,(number_format($temp3,2,',','.')) ,0,1, 'C',0);          

    $pdf->SetX(1);    
    $pdf->Cell(186, 6, utf8_decode('Descuento:'),0,0, 'R',0);                                         
    $pdf->Cell(20, 6,(number_format($temp4,2,',','.')) ,0,1, 'C',0);          

    $pdf->SetX(1);    
    $pdf->Cell(186, 6, utf8_decode('Total:'),0,0, 'R',0);                                         
    $pdf->Cell(20, 6,(number_format($temp5,2,',','.')) ,0,1, 'C',0);          

    $pdf->Output();
?>