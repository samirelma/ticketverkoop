<?php
function getProfilePicture($mysqli, $gebruikerid) {
    $resultaat = $mysqli->query("SELECT profilePicture FROM users WHERE id= '".$gebruikerid."'");
    return (($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc());
}
?>