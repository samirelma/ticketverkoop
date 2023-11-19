<?php
function getProfilePicture($mysqli, $gebruikerid) {
    $resultaat = $mysqli->query("SELECT * FROM users where gebruikerid= '".$gebruikerid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['profielfoto'];
}
?>