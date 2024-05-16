<?php
require "phpqrcode/qrlib.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";


if (!isset($_GET['ticketID'])) {
    echo "No ticket ID provided";
    exit;
}

$ticketid = $_GET['ticketID'];

// Validate if the ticket exists
$sql = "SELECT * FROM tbltickets WHERE TicketID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $ticketid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Invalid Ticket";
    exit;
}

// Check if the ticket is already scanned
$ticket = $result->fetch_assoc();
if ($ticket['scanned'] == 1) {
    echo "Ticket already used";
    exit;
}
$dataTickets = getTicketData($mysqli, $ticketid); 
foreach ($dataTickets as $tickets); 
$evenementID = $tickets["evenementID"]; 

$evenementdata = getEventsByEventid($mysqli, $evenementID); 
foreach ($evenementdata as $evenement); 
$zaalid = $evenement["zaalID"];
$currentDate = date("Y-m-d");

$eventDate = $evenement["datum"];
$eventDate = date("Y-m-d", strtotime($eventDate));

if ($eventDate != $currentDate) {
    echo "Invalid Ticket Date";
    exit;
}

// Mark the ticket as scanned
$sql = "UPDATE tbltickets SET scanned = 1 WHERE TicketID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $ticketid);
$stmt->execute();

echo "Valid Ticket";
?>