<?php
$mysqli = new mysqli("localhost","root","","ticketverkoop");
if ($mysqli->connect_errno) {
    echo "failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli ->connect_error;
}
?>
