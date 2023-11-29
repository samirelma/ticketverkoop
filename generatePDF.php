<?php
require "fpdf186/fpdf.php";
session_start();

$userid = $_SESSION["gebruikersid"];
$evenementid = $_GET["evenementID"]; 
//generates pdf + add page
$pdf = new FPDF(); 
$pdf -> AddPage(); 

//creates header of pdf 
//header() ;
$pdf->SetFont('Arial', '', 10);
$pdf -> Cell(50, 10, 'RS Ticket Service', 0, 0, 'C');



//saves the pdf as file + output to browser 
//$pdf-> Output('F', 'ticket.pdf'); 
$pdf-> Output('i'); 

?>








