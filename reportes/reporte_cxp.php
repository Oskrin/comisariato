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
            $this->Image('../images/logo_empresa.jpg',5,8,35,30);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(70, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(60, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(170, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(170, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(170, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,45,210,45);            
            $this->SetFont('Arial','B',12);                                                                            
            $this->Cell(190, 5, utf8_decode("RECIBO DE PAGO "),0,1, 'C',0);                                                                                                                            
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
    

    $saldo=0;
    $repetido=0;    
    if ($_GET['tipo_pago'] == "EXTERNA") {        
        $sql=pg_query("select * from c_pagarexternas,proveedores,usuario,empresa where c_pagarexternas.id_proveedor=proveedores.id_proveedor and c_pagarexternas.id_usuario=usuario.id_usuario and empresa.id_empresa=c_pagarexternas.id_empresa and num_factura='$_GET[id]'");        
        while($row=pg_fetch_row($sql)){
            if($repetido==0){
                $pdf->SetX(1); 
                $pdf->SetFillColor(187, 179, 180);            
                $pdf->Cell(50, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[14]),35),1,0, 'L',1);                                     
                $pdf->Cell(80, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[15]),35),1,0, 'L',1);                                     
                $pdf->Cell(75, 6, maxCaracter(utf8_decode('SECCIÓN:'.$row[43]),50),1,1, 'L',1);                                             
                $pdf->Ln(3);

                $pdf->SetX(1); 
                $pdf->Cell(30, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
                $pdf->Cell(30, 6, utf8_decode('Tipo Documento'),1,0, 'C',0);                                     
                $pdf->Cell(50, 6, utf8_decode('Nro. Factura'),1,0, 'C',0);                                     
                $pdf->Cell(25, 6, utf8_decode('Total'),1,0, 'C',0);                                             
                $pdf->Cell(25, 6, utf8_decode('Valor Pago'),1,0, 'C',0);                                             
                $pdf->Cell(20, 6, utf8_decode('Saldo'),1,0, 'C',0);                                             
                $pdf->Cell(25, 6, utf8_decode('Fecha Pago'),1,1, 'C',0);                    
                $repetido=1;                   
            }                          
            $sql1=pg_query("select * from pagos_pagar where num_factura='$_GET[id]' and id_cuentas_pagar='$_GET[comprobante]'");
            while($row1=pg_fetch_row($sql1)){
                $pdf->Cell(30, 6, utf8_decode($row1[0]),0,0, 'C',0);                                         
                $pdf->Cell(30, 6, utf8_decode($row[9]),0,0, 'C',0);                                         
                $pdf->Cell(50, 6, utf8_decode($row[8]),0,0, 'C',0);                                         
                $pdf->Cell(25, 6, utf8_decode($row1[12] + $row1[13]),0,0, 'C',0);                                         
                $pdf->Cell(25, 6, utf8_decode($row1[12]),0,0, 'C',0);                                         
                $pdf->Cell(20, 6, utf8_decode($row1[13]),0,0, 'C',0);                                         
                $pdf->Cell(25, 6, utf8_decode($row1[4]),0,1, 'C',0);                 
                $saldo=$row1[13];
            }  
            $pdf->Ln(2);
            $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',0);                                     
            $pdf->Cell(187, 6, utf8_decode('Total Saldo'),0,0, 'R',0);                                     
            $pdf->Cell(20, 6,(number_format($saldo,2,',','.')) ,0,0, 'C',0);         
        }
    }
    else{        
        $sql=pg_query("select * from factura_compra,proveedores,usuario,empresa where factura_compra.id_proveedor=proveedores.id_proveedor and factura_compra.id_usuario=usuario.id_usuario and factura_compra.id_empresa=empresa.id_empresa and num_serie='$_GET[id]' and proveedores.id_proveedor='$_GET[proveedor]'");        
        while($row=pg_fetch_row($sql)){
            $pdf->SetX(1); 
            $pdf->SetFillColor(187, 179, 180);            
            $pdf->Cell(50, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[23]),35),1,0, 'L',1);                                     
            $pdf->Cell(80, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[24]),35),1,0, 'L',1);                                     
            $pdf->Cell(75, 6, maxCaracter(utf8_decode('SECCIÓN:'.$row[52]),50),1,1, 'L',1);                                             
            $pdf->Ln(3);
            
             $pdf->SetX(1); 
            $pdf->Cell(30, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
            $pdf->Cell(30, 6, utf8_decode('Tipo Documento'),1,0, 'C',0);                                     
            $pdf->Cell(50, 6, utf8_decode('Nro. Factura'),1,0, 'C',0);                                     
            $pdf->Cell(25, 6, utf8_decode('Total'),1,0, 'C',0);                                             
            $pdf->Cell(25, 6, utf8_decode('Valor Pago'),1,0, 'C',0);                                             
            $pdf->Cell(20, 6, utf8_decode('Saldo'),1,0, 'C',0);                                             
            $pdf->Cell(25, 6, utf8_decode('Fecha Pago'),1,1, 'C',0);                    
        }        
        $sql=pg_query("select * from pagos_pagar where num_factura='$_GET[id]' and comprobante='$_GET[comprobante]'");
        $meses=0;
        $id_pv=0;
        while($row=pg_fetch_row($sql)){                        
            $pdf->Cell(30, 6, utf8_decode($row[3]),0,0, 'C',0);                                         
            $pdf->Cell(30, 6, utf8_decode($row[9]),0,0, 'C',0);                                         
            $pdf->Cell(50, 6, utf8_decode($_GET['id']),0,0, 'C',0);                                         
            $pdf->Cell(25, 6, utf8_decode($row[12] + $row[13]),0,0, 'C',0);                                         
            $pdf->Cell(25, 6, utf8_decode($row[12]),0,0, 'C',0);                                         
            $pdf->Cell(20, 6, utf8_decode($row[13]),0,0, 'C',0);                                         
            $pdf->Cell(25, 6, utf8_decode($row[4]),0,1, 'C',0);                         
            $saldo=$row[13];            
        }
        $pdf->Ln(2);
        $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',0);                                     
        $pdf->Cell(187, 6, utf8_decode('Total Saldo'),0,0, 'R',0);                                     
        $pdf->Cell(20, 6,(number_format($saldo,2,',','.')) ,0,0, 'C',0);         
    }    
    $pdf->Output();
?>