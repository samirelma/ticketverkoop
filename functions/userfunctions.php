

<?php
function getProfilePicture($mysqli, $gebruikerid) {
    $sql = ("SELECT profilePicture FROM users WHERE id =".$gebruikerid); 
    return ($mysqli -> query($sql));
}
?>