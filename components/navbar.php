<?php
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<div class="navbar bg-[#150578]">
  <div class="flex-1 text-[#FF101F]">
    <a class="btn btn-ghost normal-case text-xl " href="../index.php">RS ticket service</a>
  </div>
  <div class="flex-auto text-[#FDFFFF]">
    <a class="btn btn-ghost normal-case text-xl " href="../main_page/zalen.php">Zalen</a>
    <a class="btn btn-ghost normal-case text-xl " href="../index.php">Tickets</a>
    <div class="form-control">
      <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
    </div>
</div>
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img src="/images/stock/photo-1534528741775-53994a69daeb.jpg" />
        </div>
      </label>
      <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
        <li><a href="../profile/gebruikersProfiel.php">Profiel</a>
        <li><a href="../profile/register.php">Registreren</a></li>
        <?php
        if (isset($_SESSION["user"])) {
          echo '<li><a href="../profile/logout.php">Uit loggen</a></li>';
        } else {
       echo ' <li><a href="../profile/login.php">Login</a></li>';
        }
        if (isset($_SESSION["user"])) {
          if ($_SESSION["user"] == "bedrijf") {
            echo '<li><a href="">evenementen toevoegen</a></li>';
          }
          if ($_SESSION["user"] == "member") {
            echo '<li><a href="../profile/mijnTickets.php">Mijn Tickets</a></li>';
          }
          if ($_SESSION["user"] == "admin") {
            echo '<li><a href="../profile/bedrijvenLijst.php">bedrijven banner</a></li>';
          }
        } 
        ?>
      </ul>
    </div>
</div> 
</body>
</html>