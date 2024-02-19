<?php
require "fpdf186/fpdf.php";
require "phpqrcode/qrlib.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
session_start();

define('EURO',chr(128));

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

if ($categorie["id"] == 1) {
 $kleineLetters = 'Op vertoon van dit ticket krijg je toegang tot het eten, de zaal en de parking. De deuren van de voorstelling gaan telkens een half uur voor de start van de voorstelling open. Met dit ticket kan je maar een keer binnen geef deze ticket dus niet door zonder dit te registreren op de website. 
 Let Op scan de qr code van deze ticket niet zelf, de qr code van dit ticket is maar 1 keer geldig en kan geen tweede keer meer gescand worden. indien uw ticket niet geldig is kan uw toegang tot de zaal gewijgerd worden.';
 $lengte = 7.77 ; 
} else {
    $kleineLetters = "Op vertoon van dit ticket krijg je toegang tot de zaal en de parking. De deuren van de voorstelling gaan telkens een half uur voor de start van de voorstelling open. Met dit ticket kan je maar een keer binnen geef deze ticket dus niet door zonder dit te registreren op de website.
    Let Op scan de qr code van deze ticket niet zelf, de qr code van dit ticket is maar 1 keer geldig en kan geen tweede keer meer gescand worden. indien uw ticket niet geldig is kan uw toegang tot de zaal gewijgerd worden.";
    $lengte = 8.75;
}   
//generates pdf + add page
$pdf = new FPDF(); 
$pdf -> AddPage(); 

//creates the pdf
$pdf -> SetFont('Arial', 'B', 10);
$pdf -> Cell(50, 10, 'RS Ticket Service', 0, 1, 'L');
$pdf -> SetFillColor(255,16,31);
$pdf -> SetTextColor(253,255,255);
$pdf -> Cell(50, 10, 'naam', 1,0, 'L',1);
$pdf -> cell(50,10,'ticketnummer', 1, 0, 'L', 1); 
$pdf -> Cell(90,10,'datum van voorstelling', 1, 1, 'L', 1);
$pdf -> SetTextColor(0,0,0);
$pdf -> Cell(50,10,$user['lastname'].' '. $user['firstname'], 1, 0, 'L');
$pdf -> Cell(50,10,$tickets['TicketID'],1,0,'L'); 
$pdf -> Cell(90,10,$evenement['datum'],1,1,'L'); 
$pdf -> Cell(190,110,$pdf -> Image("./img/eventPictures/" . $evenement['afbeelding'] . "",10,40, 190, 110),0,1, 'C');
$pdf -> SetTextColor(253,255,255);
$pdf -> Cell(100, 10, $zaal["naam"], 1, 0, 'L',1 );
$pdf -> Cell(90,10, 'Categorie: ' .$categorie["name"],1,1,'L',1);
$pdf -> SetTextColor(0,0,0);
$pdf -> Cell(100, 10, $evenement["naam"], 1, 0, 'L' );
$pdf -> Cell(90,10,'prijs: '.EURO.$categorie["prijs"],1,1,'L');
$pdf -> SetTextColor(253,255,255);
$pdf -> Cell(100,10,' beschrijving',1,0, 'L', 1); 
$pdf -> Cell (45,10, 'rij',1,0, 'L',1); 
$pdf -> Cell(45,10,'stoel',1,1,'L',1);
$pdf -> SetTextColor(0,0,0);
$pdf -> Cell(100,15,$evenement["beschrijving"],1,0, 'L'); 
$pdf -> Cell (45,15, $tickets["rij"] ,1,0, 'L',0); 
$pdf -> Cell(45,15,$tickets["stoel"] ,1,1,'L',0);
$pdf -> Ln(10); 
$pdf -> Cell(70,70,'qr code', 1, 0, 'C');
$pdf -> Cell(120,70, $pdf -> Image("temp/test".md5($tickets['TicketID'].'|L|4').".png", 10, 10, 100, 100), 1, 1, 'C');
$pdf -> SetTextColor(253,255,255);
$pdf-> MultiCell( 120, $lengte, $kleineLetters, 1, 'L');

// output to browser 
$pdf-> Output('i'); 
?>








