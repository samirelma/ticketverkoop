<?php
function getProfilePicture($mysqli, $gebruikerid) {
    $stmt = $mysqli->prepare("SELECT profilePicture FROM users WHERE id = ?");
    $stmt->bind_param("i", $gebruikerid);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return (($resultaat->num_rows == 0) ? false : $resultaat->fetch_assoc());
}
function getzalen($mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM tblzalen");
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return (($resultaat->num_rows == 0) ? false : $resultaat);
}
function geteventsforarena($mysqli, $zaal) {
    $stmt = $mysqli->prepare("SELECT * FROM evenementen WHERE zaalID = ?");
    $stmt->bind_param("s", $zaal);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return (($resultaat->num_rows == 0) ? false : $resultaat);
}
?>