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
        var $temp1;
        var $temp2;
        var $temp3;
        var $temp4;
        var $temp5;
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
            $this->Cell(190, 8, $_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(190, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(190, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(190, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);
            $this->SetFillColor(120,120,120);
                       
            $this->Line(1,50,210,50);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(190, 5, utf8_decode("KARDEX DE CLIENTES"),0,1, 'C',0);                                                                                                                                        
            $this->SetFont('Arial','B',10);                                                                
            $this->Cell(90, 5, utf8_decode("Desde: ".$_GET['inicio']),0,0, 'R',0);                                                                                        
            $this->Cell(40, 5, utf8_decode("Hasta: ".$_GET['fin']),0,1, 'C',0);                                                                                                                
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(3);
            $this->SetFillColor(255,255,225);            
            $this->SetLineWidth(0.2);                                    
            $this->SetX(1);           
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

    $total=0;
    $saldo=0;
    $repetido=0;
    $consulta=pg_query("select * from clientes where id_cliente='$_GET[id]' order by id_cliente asc");
    while($row=pg_fetch_row($consulta)){
        $consulta1=pg_query("select * from c_cobrarexternas where id_cliente='$_GET[id]' and fecha_actual between '$_GET[inicio]' and '$_GET[fin]' order by id_c_cobrarexternas asc");
        $pdf->SetFillColor(187, 179, 180);            
        $pdf->SetX(1); 
        $pdf->Cell(80, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[2]),35),1,0, 'L',1);                                     
        $pdf->Cell(125, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[3]),50),1,1, 'L',1);                                                             
        $pdf->Ln(1);   
        while($row1=pg_fetch_row($consulta1)){
            if($row1[10]>0){  
                $total = 0;              
                $pdf->SetX(1); 
                $pdf->Cell(80, 6, maxCaracter(utf8_decode('Factura #:'.$row1[7]),35),1,0, 'L',1);                                     
                $pdf->Cell(125, 6, maxCaracter('Serie #:'.substr($row1[7],0,7),35),1,1, 'L',1);                                                                     
                $pdf->Ln(1);
                $pdf->SetX(1); 
                $pdf->Cell(60, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
                $pdf->Cell(45, 6, utf8_decode('Tipo Doc.'),1,0, 'C',0);                                     
                $pdf->Cell(40, 6, utf8_decode('Fecha Mov.'),1,0, 'C',0);                                     
                $pdf->Cell(30, 6, utf8_decode('Valor'),1,0, 'C',0);                                     
                $pdf->Cell(30, 6, utf8_decode('Saldo'),1,1, 'C',0);                                                                                                                    
                $repetido = 1; 
                $pdf->SetX(1);                                                                                 
                $pdf->Cell(60, 6, utf8_decode($row1[4]),0,0, 'C',0);   
                $pdf->Cell(45, 6, utf8_decode("Cuentas por cobrar"),0,0, 'C',0);   
                $pdf->Cell(40, 6, utf8_decode($row1[5]),0,0, 'C',0);   
                $pdf->Cell(30, 6, utf8_decode($row1[9]),0,0, 'C',0);   
                $total=$total+$row1[10];  
                $saldo=$saldo+$row1[10];              
                $pdf->Cell(30, 6, utf8_decode($row1[10]),0,1, 'C',0);                                   
                $pdf->SetX(1); 
                $pdf->Ln(1);
                $pdf->SetX(1);
                $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',0);    
                $pdf->Cell(175, 6, utf8_decode('Saldo Pendiente'),0,0, 'R',0);    
                $pdf->Cell(30, 6, utf8_decode($total),0,1, 'C',0);                    
                $pdf->Ln(5);
            }      
        }
        $consulta2=pg_query("select * from factura_venta where id_cliente='$_GET[id]' and forma_pago='Credito'");
            while($row2=pg_fetch_row($consulta2)){
                $total=0;
                $pdf->SetX(1); 
                $pdf->Cell(80, 6, maxCaracter(utf8_decode('Factura #:'.$row2[5]),35),1,0, 'L',1);                                     
                $pdf->Cell(125, 6, maxCaracter('Serie #:'.substr($row2[5],0,7),35),1,1, 'L',1);                                                     
                $pdf->Ln(1);
                $pdf->SetX(1); 
                $pdf->Cell(50, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
                $pdf->Cell(50, 6, utf8_decode('Tipo Doc.'),1,0, 'C',0);                                     
                $pdf->Cell(45, 6, utf8_decode('Fecha Mov.'),1,0, 'C',0);                                     
                $pdf->Cell(30, 6, utf8_decode('Valor'),1,0, 'C',0);                                     
                $pdf->Cell(30, 6, utf8_decode('Saldo'),1,1, 'C',0);                                                                                                                                        
                $repetido=1;               
                $consulta3=pg_query("select * from pagos_venta where id_factura_venta='$row2[0]'");                       
                while($row3=pg_fetch_row($consulta3)){
                    $pdf->SetX(1); 
                    $pdf->Cell(50, 6, utf8_decode($row3[2]),0,0, 'C',0);   
                    $pdf->Cell(50, 6, utf8_decode("Factura Venta"),0,0, 'C',0);   
                    $pdf->Cell(45, 6, utf8_decode($row3[4]),0,0, 'C',0);   
                    $pdf->Cell(30, 6, utf8_decode($row3[8] - $row3[9]),0,0, 'C',0);   
                    $pdf->Cell(30, 6, utf8_decode($row3[8] - (($row3[8] - $row3[9]))),0,1, 'C',0);                       
                    $total=($row3[8]-($row3[8]-$row3[9]));                             
                    if($row3[5]!=""){
                        $pdf->SetX(1); 
                        $pdf->Cell(50, 6, utf8_decode($row3[2]),0,0, 'C',0);                                   
                        $pdf->Cell(50, 6, utf8_decode('Abono'),0,0, 'C',0);    
                        $pdf->Cell(45, 6, utf8_decode($row3[4]),0,0, 'C',0);    
                        $pdf->Cell(30, 6, utf8_decode(" - ".$row3[5]),0,0, 'C',0);                                                    
                        $total=$total-$row3[5];
                        $pdf->Cell(30, 6, utf8_decode($total),0,1, 'C',0);                                                                            
                    }
                    $saldo=$saldo+$total;
                    $consulta4=pg_query("select * from detalle_pagos_venta where id_pagos_venta='$row3[0]'");
                    while($row4=pg_fetch_row($consulta4)){
                        
                    }
                    
                }
                $pdf->Cell(175, 6, utf8_decode("Saldo Pendiente"),0,0, 'R',0);                                                                   
                $pdf->Cell(30, 6, utf8_decode($total),0,1, 'C',0);                                                                                            
            }
            ////total final///   
            $pdf->Cell(175, 6, utf8_decode("Gran Total"),0,0, 'R',0);                                                                   
            $pdf->Cell(30, 6, utf8_decode($saldo),0,1, 'C',0);
    }

   $pdf->Output();
?>