<?php
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
function($mysqli){
$sql = "SELECT * FROM evenementen WHERE datum < CURDATE()"; 
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$pastevenst = (($result->num_rows == 0) ? false : $result->fetch_all(MYSQLI_ASSOC));
foreach($pastevenst as $evenement){
    $stmt2 = $mysqli->prepare("DELETE FROM evenementen WHERE evenementID = ?");
    $stmt2->bind_param("i", $evenement['id']);
    $stmt2->execute();
    $sql2 = "DELETE FROM tblTickets WHERE evenementID = ?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("i", $evenement['id']);
    $stmt2->execute();
    $sql3 = "DELETE FROM user_purchases WHERE evenementID = ?";
    $stmt3 = $mysqli->prepare($sql3);
    $stmt3->bind_param("i", $evenement['id']);
    $stmt3->execute();
} 
}
?>