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
            $this->Cell(170, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
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

            $this->SetFillColor(120,120,120);
            $this->Line(1,60,210,60);            
            $this->Line(1,45,210,45);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(190, 5, utf8_decode("KARDEX DE PRODUCTOS"),0,1, 'C',0);                                                                                                                
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(2);
            $this->SetFillColor(255,255,225);

            if($_GET['id'] == "") {
                $this->SetX(1);                                  
                $this->Cell(85, 6, utf8_decode('Desde el: '.$_GET['inicio']),0,0, 'L',1);                                
                $this->Cell(120, 6, utf8_decode('Hasta el: '.$_GET['fin']),0,1, 'L',1);                
                $this->SetX(1);                                  
                $this->Cell(85, 6, utf8_decode('Código: '),0,0, 'L',1);                
                $this->Cell(120, 6, utf8_decode('Descripción: '),0,1, 'L',1); 

                
            } else {
                $sql = pg_query("select P.codigo, P.articulo from productos P where P.cod_productos = '$_GET[id]'");
                $this->SetLineWidth(0.2);
                while($row=pg_fetch_row($sql)){                          
                    $this->SetX(1);                                  
                    $this->Cell(85, 6, utf8_decode('Desde el: '.$_GET['inicio']),0,0, 'L',1);                                
                    $this->Cell(120, 6, utf8_decode('Hasta el: '.$_GET['fin']),0,1, 'L',1);                
                    $this->SetX(1);                                  
                    $this->Cell(85, 6, utf8_decode('Código: '.$row[0]),0,0, 'L',1);                
                    $this->Cell(120, 6, utf8_decode('Descripción: '.$row[1]),0,1, 'L',1);             
                } 

            }

            $this->Ln(5);                        
            $this->SetX(1);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(53, 5, utf8_decode("Transacción"),1,0, 'C',0);
            $this->Cell(40, 5, utf8_decode("Origen"),1,0, 'C',0);
            $this->Cell(40, 5, utf8_decode("Destino"),1,0, 'C',0);        
            $this->Cell(25, 5, utf8_decode("Fecha"),1,0, 'C',0);                
            $this->Cell(25, 5, utf8_decode("Movimiento"),1,0, 'C',0);
            $this->Cell(25, 5, utf8_decode("Stock"),1,0, 'C',0);
            $this->Ln(5);
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

    if($_GET['id'] == "") {
        $sql=pg_query("SELECT K.detalle, K.origen, k.destino, K.fecha_kardex, K.cantidad, K.saldo, K.estado from kardex K where k.fecha_kardex between '$_GET[inicio]' and '$_GET[fin]'  order by k.id_kardex asc");   
        while($row=pg_fetch_row($sql)) {                
            $pdf->SetX(1);                  
            $pdf->Cell(53, 5, maxCaracter(utf8_decode($row[0]),30),0,0, 'C',0);
            $pdf->Cell(40, 5, maxCaracter(utf8_decode($row[1]),20),0,0, 'L',0);
            $pdf->Cell(40, 5, maxCaracter(utf8_decode($row[2]),20),0,0, 'C',0);        
            $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[3]),20),0,0, 'C',0);
            if($row[6] == '2' || $row[6] == '4') {                                     
                $pdf->Cell(25, 5, maxCaracter(utf8_decode('-'. $row[4]),20),0,0, 'C',0);
            } else {
                $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[4]),20),0,0, 'C',0);
            }
            $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[5]),20),0,0, 'C',0); 
            
            $pdf->Ln(5);                                                                
        }
    } else {
        $sql=pg_query("SELECT K.detalle, K.origen, k.destino, K.fecha_kardex, K.cantidad, K.saldo, K.estado from kardex K where k.fecha_kardex between '$_GET[inicio]' and '$_GET[fin]'  and k.cod_productos = '$_GET[id]'  order by k.id_kardex asc");   
        while($row=pg_fetch_row($sql)) {                
            $pdf->SetX(1);                  
            $pdf->Cell(53, 5, maxCaracter(utf8_decode($row[0]),30),0,0, 'C',0);
            $pdf->Cell(40, 5, maxCaracter(utf8_decode($row[1]),20),0,0, 'L',0);
            $pdf->Cell(40, 5, maxCaracter(utf8_decode($row[2]),20),0,0, 'C',0);        
            $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[3]),20),0,0, 'C',0);
            if($row[6] == '2' || $row[6] == '4') {                                     
                $pdf->Cell(25, 5, maxCaracter(utf8_decode('-'. $row[4]),20),0,0, 'C',0);
            } else {
                $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[4]),20),0,0, 'C',0);
            }
            $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[5]),20),0,0, 'C',0); 
            
            $pdf->Ln(5);                                                                
        }

    }

    $pdf->Output();
?>
