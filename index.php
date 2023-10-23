<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";   

//make a link that goes to register.php
echo "<a href='/profile/register.php'>Register</a>";

