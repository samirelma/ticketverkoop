<?php
//make the connection to the database
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

