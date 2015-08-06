<?php

session_start();
//include '../fdpf/fpdf.php';
include '../fpdf/rotation.php';
include '../procesos/base.php';
include '../procesos/convertir.php';
conectarse();
$letras = new EnLetras();

//header("Content-Type: text/html; charset=iso-8859-1 ");
date_default_timezone_set('UTC');
$fecha = date("Y-m-d");
$anulado = 0;

class PDF extends PDF_Rotate {

    var $widths;
    var $aligns;

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            //$this->Rect($x,$y,$w,$h);

            $this->MultiCell($w, 8, $data[$i], 0, $a, false);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function Rows($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 2 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            //$this->Rect($x,$y,$w,$h);

            $this->MultiCell($w, 3, $data[$i], 0, $a, false);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function Rowss($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            //$this->Rect($x,$y,$w,$h);

            $this->MultiCell($w, 5, $data[$i], 0, $a, false);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                }
                else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function Header() {
        
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

    function Footer() {
        
    }

}


    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetMargins(10, 0, 0, 0);
    $pdf->SetAutoPageBreak(true, 0);
    $pdf->Ln(5);

///////////////
$pdf->SetTextColor(70, 119, 159);

    $sql = pg_query("select id_factura_venta,num_factura,nombre_empresa,telefono_empresa,direccion_empresa,email_empresa,pagina_web,ruc_empresa,nombres_cli,identificacion,direccion_cli,telefono,ciudad,fecha_actual,forma_pago,fecha_cancelacion,nombre_usuario,apellido_usuario from factura_venta,clientes,empresa,usuario where factura_venta.id_cliente=clientes.id_cliente and empresa.id_empresa=factura_venta.id_empresa and factura_venta.id_usuario=usuario.id_usuario and factura_venta.id_factura_venta='$_GET[id]'");
    $numfilas = pg_num_rows($sql);
    for ($i = 0; $i < $numfilas; $i++) {
        $fila = pg_fetch_row($sql);
        $pdf->SetX(130);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(55, 10, '', 0, 1, 'C', 'true');
        $pdf->SetX(130);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(55, 50, '', 0, 1, 'C');
        $pdf->Text(25, 76, utf8_decode('' . strtoupper($fila[8])), 0, 'C', 0); ////CLIENTE (X,Y)	
        $pdf->Text(25, 82, utf8_decode('' . strtoupper($fila[9])), 0, 'C', 0); ////RUC (X,Y)	
        $pdf->Text(25, 88, utf8_decode('' . strtoupper($fila[10])), 0, 'C', 0); ///DIRECCION (X,Y)	
        $pdf->Text(25, 94, utf8_decode('' . strtoupper($fila[11])), 0, 'C', 0); ///TELEFONO(X,Y)	
        $pdf->Text(115, 94, utf8_decode('' . strtoupper($fila[12])), 0, 'C', 0); ///CIUDAD(X,Y)			
        $pdf->Text(180, 76, utf8_decode(strtoupper($fila[13])), 0, 'C', 0); ///FECHA EMISION (X,Y)
        $pdf->Text(180, 82, utf8_decode(strtoupper($fila[14])), 0, 'C', 0); ////FORMA PAGO (X,Y)
        $pdf->Text(183, 88, utf8_decode(strtoupper($fila[15])), 0, 'C', 0); ///FECHA VENCIMIENTO (X,Y)			
        $pdf->Ln(32);
    }

///////////////
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths(array(20, 130, 30, 30));
$pdf->SetFillColor(85, 107, 47);
$sql = pg_query("select detalle_factura_venta.cantidad,productos.articulo,detalle_factura_venta.precio_venta,detalle_factura_venta.total_venta from factura_venta,detalle_factura_venta,productos where factura_venta.id_factura_venta=detalle_factura_venta.id_factura_venta and detalle_factura_venta.cod_productos=productos.cod_productos and detalle_factura_venta.id_factura_venta='$_GET[id]'");
$numfilas = pg_num_rows($sql);
for ($i = 0; $i < $numfilas; $i++) {
    $fila = pg_fetch_row($sql);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    $pdf->Row(array(utf8_decode($fila[0]), utf8_decode($fila[1]), utf8_decode($fila[2]), utf8_decode($fila[3])));
}
$temp = '';
$temp1 = '';
$t = 180;
$prod = 0;
$cont_prod = 0;
$sql = pg_query("select * from factura_venta where id_factura_venta='$_GET[id]' and estado='Pasivo'");
if (pg_num_rows($sql)) {
    $anulado = 1;
} else {
    $sql = pg_query("select id_factura_venta from detalle_factura_venta where id_Factura_venta='$_GET[id]'");
    if (pg_num_rows($sql) <= 7) {
        $sql = pg_query("select cod_productos from detalle_factura_venta where id_factura_venta='$_GET[id]'");
        while ($row = pg_fetch_row($sql)) {
            $sql1 = pg_query("select * from serie_venta where id_factura_venta='$_GET[id]' and cod_productos='$row[0]'");
            if (pg_num_rows($sql1) > 10) {
                $cont_prod = 1;
            }
        }
        if ($cont_prod == 0) {
            $sql = pg_query("select * FROM detalle_factura_venta,productos where productos.cod_productos=detalle_factura_venta.cod_productos and id_factura_venta='$_GET[id]'");
            while ($row = pg_fetch_row($sql)) {
                $temp = '';
                $temp1 = '';
                $temp = $row[9];
                $sql1 = pg_query("select * from serie_venta,factura_venta,productos where factura_venta.id_factura_venta=serie_venta.id_factura_venta and productos.cod_productos=serie_venta.cod_productos and serie_venta.id_factura_venta='$_GET[id]' and productos.cod_productos='$row[2]'");
                if (pg_num_rows($sql1)) {
                    while ($row1 = pg_fetch_row($sql1)) {
                        $temp1 = $row1[3] . ',' . $temp1;
                    }
                }
                $pdf->SetY($t);
                $pdf->SetX(10);
                $pdf->SetFont('Arial', '', 7);
                //$pdf->SetWidths(array(20,30, 200));	
                $pdf->SetY($t);
                $pdf->SetX(50);
                $pdf->SetWidths(array(0, 140));
                if (strlen($temp1) > 0) {
                    $pdf->Rows(array('', $temp1));
                }
                //$pdf->Cell(195,10,$temp.':'.$temp1,0,1,'L');	   		
                $t = $t + 6;
            }
        }
    } else {
        $prod = 1;
    }
}
///////////////
$letras = new EnLetras();
$sql = pg_query("select factura_venta.descuento_venta,factura_venta.tarifa0,factura_venta.tarifa12,factura_venta.iva_venta,factura_venta.total_venta from factura_venta,detalle_factura_venta,productos where factura_venta.id_factura_venta=detalle_factura_venta.id_factura_venta and detalle_factura_venta.cod_productos=productos.cod_productos and detalle_factura_venta.id_factura_venta='$_GET[id]'");
$fila = pg_fetch_row($sql);
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(50);
$pdf->SetY(249); //////////LETRAS EN  NUMEROS Y SUBTOTALES	
$pdf->Cell(125, 8, utf8_decode('                             ' . $letras->ValorEnLetras($fila[4], "dolares")), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(172);
$pdf->Cell(30, 8, utf8_decode($fila[2]), 0, 1, 'C');
$pdf->SetX(172);
$pdf->Cell(30, 8, utf8_decode($fila[0]), 0, 1, 'C');
$pdf->SetX(172);
$pdf->Cell(30, 8, utf8_decode($fila[1]), 0, 1, 'C');
$pdf->SetX(172);
$pdf->Cell(30, 8, '', 0, 1, 'C');
$pdf->SetX(172);
$pdf->Cell(30, 8, utf8_decode($fila[3]), 0, 1, 'C');
$pdf->SetX(172);
$pdf->Cell(30, 8, utf8_decode($fila[4]), 0, 1, 'C');
//////////////

if ($anulado == 1) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->RotatedImage('../images/circle.png', 165, 30, 40, 16, 45);
    $pdf->RotatedText(178, 30, 'ANULADO!', 45);
}
if ($prod == 1 or $cont_prod == 1) {
    $pdf->AddPage();
    $pdf->SetX(30);
    $pdf->SetY(10);
    $pdf->SetFont('Arial', '', 13);
    $pdf->Cell(200, 8, utf8_decode('Números de Serie'), 0, 1, 'C');

    $sql = pg_query("select * FROM detalle_factura_venta,productos where productos.cod_productos=detalle_factura_venta.cod_productos and id_factura_venta='$_GET[id]'");
    while ($row = pg_fetch_row($sql)) {
        $temp = '';
        $temp1 = '';
        $temp = $row[9];
        $sql1 = pg_query("select * from serie_venta,factura_venta,productos where factura_venta.id_factura_venta=serie_venta.id_factura_venta and productos.cod_productos=serie_venta.cod_productos and serie_venta.id_factura_venta='$_GET[id]' and productos.cod_productos='$row[2]'");
        if (pg_num_rows($sql1)) {
            while ($row1 = pg_fetch_row($sql1)) {
                $temp1 = $row1[3] . ',' . $temp1;
            }
        }
        $tt = 10;
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(0, 35, 160));
        if (strlen($temp1) > 0) {
            $pdf->Rowss(array('', $temp, $temp1));
        }
        //$pdf->Cell(195,10,$temp.':'.$temp1,0,1,'L');	   		
        $tt = $tt + 10;
    }
}
$pdf->Output();
?>




