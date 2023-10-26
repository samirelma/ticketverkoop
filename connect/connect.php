<?php
//make the connection to the database
$connect = new mysqli('localhost', 'root', '', 'dbticketverkoop');

if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

