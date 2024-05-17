<?php
//make the connection to the database
$mysqli = new mysqli('localhost', 'samirelmazzoujisql1', 'jwVhocruvE', 'samirelmazzoujisql1');

// Check if there is a connection error
if ($mysqli->connect_error) {
  // If there is a connection error, terminate the script and display an error message
  die("Connection failed: " . $mysqli->connect_error);
}
