<?php
//make the connection to the database
$mysqli = new mysqli('localhost', 'samirelma', 'hDY8RWeNNvcsWBh', 'samirelma');

// Check if there is a connection error
if ($mysqli->connect_error) {
  // If there is a connection error, terminate the script and display an error message
  die("Connection failed: " . $mysqli->connect_error);
}