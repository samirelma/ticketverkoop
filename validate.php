<?php
require "phpqrcode/qrlib.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validate Ticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    
</head>

<?php
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
    echo '<div class="text-6xl font-bold text-center text-red-500 bg-blue-500 rounded-lg p-6 shadow-lg">Invalid Ticket Date</div>';
    exit;
}

// Check if the ticket is already scanned
$ticket = $result->fetch_assoc();
if ($ticket['scanned'] == 1) {
    echo '<div class="text-6xl font-bold text-center text-red-500 bg-blue-500 rounded-lg p-6 shadow-lg">Ticket already used</div>';
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
    echo '<div class="text-6xl font-bold text-center text-red-500 bg-blue-500 rounded-lg p-6 shadow-lg">Invalid Ticket Date</div>';
    exit;
}

// Mark the ticket as scanned
$sql = "UPDATE tbltickets SET scanned = 1 WHERE TicketID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $ticketid);
$stmt->execute();

echo '<div class="text-6xl font-bold text-center text-green-500 bg-blue-500 rounded-lg p-6 shadow-lg">Valid Ticket</div>';
?> 