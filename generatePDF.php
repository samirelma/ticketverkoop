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
//generates pdf + add page
$pdf = new FPDF(); 
$pdf -> AddPage(); 

//creates the pdf
$pdf->SetFont('Arial', 'B', 10);
$pdf -> Cell(50, 10, 'RS Ticket Service', 0, 0, 'C');
$pdf -> Cell(100, 10, $evenement["naam"], 0, 1, 'C');
$pdf -> Cell(190,110,$pdf -> Image("./img/eventPictures/" . $evenement['afbeelding'] . "",10,20, 190, 110),1,1, 'C');

$pdf ->SetFont('Arial', '', 10); 
$pdf -> Cell(50, 10, 'naam: '.$user["lastname"].' '.$user["firstname"], 1,0, 'L');
$pdf ->Cell(50,20, 'plaats: '.$tickets["seatName"], 1, 0, 'C'); 
$pdf -> Cell(50, 10, 'email: '.$user["email"], 1,1, 'L');


//saves the pdf as file + output to browser 
//$pdf-> Output('F', 'ticket.pdf'); 
$pdf-> Output('i'); 

?>








