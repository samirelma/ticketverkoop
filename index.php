<!DOCTYPE html>
  <html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>  


<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";   

//make a link that goes to register.php
echo "<a href='/profile/register.php'>Register</a>";


