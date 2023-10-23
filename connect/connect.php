<?php
//make the connection to the database
$connect = mysqli_connect("localhost", "root", "", "ticketverkoop");
//check if the connection is made
if (!$connect) {
  die("Error: Could not connect to database");
}

