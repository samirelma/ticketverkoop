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

// validate if ticket exists and is paid for
$sql = "SELECT * FROM tbltickets WHERE userID = ? AND TicketID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ii', $userid, $ticketid);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: /");
}

// Get purchaseID that is associated with the ticket
$result = $result->fetch_assoc();
$purchaseID = $result['purchaseID'];


$sql = "SELECT * FROM user_purchases WHERE purchaseID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $purchaseID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: /");
}

// Check if isPaid is 1 in user_purchases
$result = $result->fetch_assoc();
if ($result['isPaid'] == 0) {
    header("Location: /");
}




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
// Remember the x and y coordinates
$x = $pdf->GetX();
$y = $pdf->GetY();

// Output the "beschrijving" cell
$beschrijving = $evenement["beschrijving"];
$beschrijving = trim($beschrijving);
$pdf->MultiCell(100, 15, $beschrijving, 1, 'L');

// Get the height of the MultiCell
$height = $pdf->GetY() - $y;

// Move the cursor back to the right of the "beschrijving" cell
$pdf->SetXY($x + 100, $y);

// Output the "rij" and "stoel" cells
$pdf->Cell(45, $height, $tickets["rij"], 1, 0, 'L');
$pdf->Cell(45, $height, $tickets["stoel"], 1, 1, 'L');

// Output the "qr code" cell
$pdf->Cell(70, 70, 'qr code', 1, 0, 'C');
$currentDate = date("Y-m-d");

$eventDate = $evenement["datum"];
$eventDate = date("Y-m-d", strtotime($eventDate));

if ($eventDate == $currentDate) {
    $codeText = "Valid Ticket";
} else {
    $codeText = "Invalid Ticket";
}

$codeText = str_replace(" ", "", $codeText);

// Check if ticket is already scanned
$sql = "SELECT scanned FROM tbltickets WHERE TicketID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $ticketid);
$stmt->execute();
$result = $stmt->get_result();
$ticket = $result->fetch_assoc();

if ($ticket['scanned'] == 1) {
    $codeText = "Invalid Ticket";
} else {
    // Check if ticket is valid
    if ($eventDate == $currentDate) {
        $codeText = "Valid Ticket";
    } else {
        $codeText = "Invalid Ticket";
    }
}

$validate = 'https://ticketverkoop.virtualmin.cedricverlinden.com/validate.php?ticketID=' . $ticketid;
QRcode::png($validate, "qrcode.png", QR_ECLEVEL_L, 3);
$pdf->Image("qrcode.png", 20, 20, 50, 50);
unlink("qrcode.png");
/*1st line
$codeText = str_replace(" ", "", $codeText); - This line is removing all spaces from the $codeText string. 
The str_replace function is used to replace some characters with some other characters in a string. 
Here, it's replacing spaces (" ") with nothing ("").

2nd line
QRcode::png($codeText, "qrcode.png", QR_ECLEVEL_L, 3); - 
This line is generating a QR code from the $codeText string. 
The QRcode::png function is part of the PHP QR Code library. It creates a PNG image of a QR code with the text from $codeText.
The image is saved as "qrcode.png". QR_ECLEVEL_L is the error correction level, and 3 is the size of the QR code.

3de line
$pdf -> Image("qrcode.png", 20, 210, 50, 50); - 
This line is adding the QR code image to a PDF document. 
The Image method is part of the FPDF library, which is a PHP class to generate PDF files. 
It inserts the image file "qrcode.png" at the position (20, 210) in the PDF, and the image's size is set to 50x50 units.

4th line
unlink("qrcode.png"); - This line is deleting the "qrcode.png" file from the server. 
The unlink function in PHP is used to delete files. 
It's used here to clean up and remove the QR code image file after it has been added to the PDF.
*/
$pdf-> MultiCell( 120, $lengte, $kleineLetters, 1, 'L');



// output to browser 
$pdf-> Output('i'); 
?>