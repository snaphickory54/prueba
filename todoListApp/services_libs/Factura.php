<?php

class Factura {
    
public function generar($num,$data){

print_r("hola");
//Recibir detalles de factura
$id_factura = $num;

//variable que guarda el nombre del archivo PDF
$archivo="factura-$id_factura.pdf";


//Llamada al script fpdf
require('fpdf.php');

//$totalPaga = $data["precio_unidad"]*$data["cantidad"];
$archivo_de_salida=$archivo;

$pdf=new FPDF();  //crea el objeto
$pdf->AddPage();  //a�adimos una p�gina. Origen coordenadas, esquina superior izquierda, posici�n por defeto a 1 cm de los bordes.


//logo de la tienda
//$pdf->Image('../empresa.jpg' , 0 ,0, 40 , 40,'JPG', 'http://php-estudios.blogspot.com');

// Encabezado de la factura
$pdf->SetFont('Arial','B',18);
$pdf->Cell(190, 10, $data["boleta"], 0, 2, "C");
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(190,5, "Numero de factura: $id_factura"."\n", 0, "C", false);
$pdf->Ln(2);


// Datos de la compra
$pdf->SetFont('Arial','b',15);
$pdf->MultiCell(
160, //posici�n X
5, //posicion Y
        
"Pelicula".$data["nombre"]."\n".
"Horario".$data["horario"]."\n".  
"Precio: ".$data["valorBoleta"]."\n".
"numero De bolestas ".$data["numeroBoleta"]."\n".
"Valor total ".$data["valorTotal"],
        
0, // bordes 0 = no | 1 = si
"J", // texto justificado
false);

$pdf->Output($archivo_de_salida);//cierra el objeto pdf

//Creacion de las cabeceras que generar�n el archivo pdf
header ("Content-Type: application/download");
header ("Content-Disposition: attachment; filename=$archivo");
header("Content-Length: " . filesize("$archivo"));
$fp = fopen($archivo, "r");
fpassthru($fp);
fclose($fp);

//Eliminaci�n del archivo en el servidor
//unlink($archivo);


}

}