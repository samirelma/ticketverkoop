<?php
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
include $_SERVER['DOCUMENT_ROOT'] . "/functions/userfunctions.php";

if (isset($_GET['purchaseid']) && isset($_GET['secret'])) {
    $purchaseID = $_GET['purchaseid'];
    $secret = $_GET['secret'];

    // Check if secret is correct
    $sql = "SELECT * FROM user_purchases WHERE purchaseId = ? AND secretkey = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('is', $purchaseID, $secret);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        header("Location: /");
    }



    // Redirect to the index page
    header("Location: /?payment=cancelled");



} else {
    header("Location: /");
}
