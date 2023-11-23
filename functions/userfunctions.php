<?php
function getProfilePicture($mysqli, $gebruikerid) {
    $resultaat = $mysqli->query("SELECT profilePicture FROM users WHERE id= ".$gebruikerid."");
    return (($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc());
}
function getzalen($mysqli) {
    $resultaat = $mysqli->query("SELECT * FROM tblzalen"); 
    return(($resultaat->num_rows == 0)?false:$resultaat); 
}
function geteventsforarena($mysqli, $zaal) {
    $resultaat = $mysqli->query("SELECT * FROM evenementen WHERE zaalID='" .$zaal."'"); 
    return(($resultaat->num_rows == 0)?false:$resultaat); 
}
?>