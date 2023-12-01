<?php
require "fpdf186/fpdf.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
session_start();

$userid = $_SESSION["gebruikersid"];
$ticketid = $_GET["ticketID"];

$dataTickets = getTicketData($mysqli, $ticketid); 
foreach ($dataTickets as $tickets); 
$evenementID = $tickets["evenementID"]; 

$evenementdata = getEventsByEventid($mysqli, $evenementID); 
foreach ($evenementdata as $evenement); 
$zaalid = $evenement["zaalID"];

$zaalgegevens = getzalenByID($mysqli, $zaalid); 
foreach ($zaalgegevens as $zaal); 

$userID = $tickets["userID"];
$userdata = getUserDataByID($mysqli, $userID);
foreach ($userdata as $user);

$categorieData = getCategorieDataByID($mysqli, $tickets["categoryID"]); 
foreach ($categorieData as $categorie); 
//generates pdf + add page
$pdf = new FPDF(); 
$pdf -> AddPage(); 

//creates the pdf
$pdf->SetFont('Arial', 'B', 10);
$pdf -> Cell(50, 10, 'RS Ticket Service', 0, 1, 'L');
$pdf -> SetFillColor(255,16,31);
$pdf -> SetTextColor(253,255,255);
$pdf -> Cell(50, 10, 'naam', 0,0, 'L',1);
$pdf -> cell(50,10,'ticketnummer', 0, 0, 'L', 1); 
$pdf -> Cell(90,10,'datum van voorstelling', 0, 1, 'L', 1);
$pdf -> Cell(50,10,$user['lastname'].' '. $user['firstname'], 0, 0, 'L',1);
$pdf -> Cell(50,10,$tickets['TicketID'],0,0,'L',1); 
$pdf -> Cell(90,10,$evenement['datum'],0,1,'L',1); 

$pdf -> Cell(190,110,$pdf -> Image("./img/eventPictures/" . $evenement['afbeelding'] . "",10,40, 190, 110),0,1, 'C');

$pdf -> SetTextColor(0,0,0);
$pdf -> Cell(100, 10, $zaal["naam"], 1, 0, 'L' );
$pdf -> Cell(90,10, 'Categorie: ' .$categorie["name"],1,1,'L');
$pdf -> Cell(100, 10, $evenement["naam"], 1, 0, 'L' );
$pdf -> Cell(90,10,'prijs: '.$categorie["prijs"],1,1,'L');



//saves the pdf as file + output to browser 
//$pdf-> Output('F', 'ticket.pdf'); 
$pdf-> Output('i'); 

?>








