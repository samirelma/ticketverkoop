<?php
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
include $_SERVER['DOCUMENT_ROOT'] . "/functions/userfunctions.php";
session_start();
$searchTerm = $_GET['search'] ?? '';
?>


<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
  
<div class="navbar bg-[#150578]" style="margin-bottom: 20px;">
  <div class="flex-1 text-[#FF101F]">
    <a class="btn btn-ghost normal-case text-xl " href="../index.php">RS ticket service</a>
  </div>
  <div class="flex-auto text-[#FDFFFF]">
    <a class="btn btn-ghost normal-case text-xl " href="../main_page/zalen.php">Zalen</a>
    <a class="btn btn-ghost normal-case text-xl " href="../index.php">Tickets</a>
    <div class="form-control">
    <form action="/components/search.php" method="get" class="form-control w-full relative">
      <input type="text" name="search" placeholder="Search" class="input input-bordered w-24 md:w-auto text-black"/>
    </form>
    </div>
</div>


    <?php
   echo ' <div class="dropdown dropdown-end">';
   if (isset($_SESSION["user"])) {
       echo'
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
       <div class="w-10 rounded-full">';
        $gebruikersid = $_SESSION["gebruikersid"]; 
        $data = getProfilePicture($mysqli,$gebruikersid);
        foreach($data as $value){ 
        if (empty($value)) {
          echo '<img src="../img/accountPictures/no_profile_picture.jpg"/>'; 
        } else {
          echo '<img src="../img/accountPictures/'.$value.'"/>'; 
        }
      }
        echo'
        </div>
      </label>
      <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
        <li><a href="../profile/gegevens_aanpassen.php">Profiel</a>
        <li><a href="../profile/logout.php">Uitloggen</a></li>';         
          if ($_SESSION["user"] == "bedrijf") { 
            echo '<li><a href="../profile/evenementen-toevoegen.php">Evenementen Toevoegen</a></li>';
            echo'<li><a href="../profile/overzichtEvenementen.php">Overzicht Evenementen</a></li>'; 
            echo '<li><a href="../profile/tijd-aanpassen.php">Tijd Aanpassen</a></li>';
            echo '<li><a href="../profile/mijnTickets.php">Mijn Tickets</a></li>';
          }
          if ($_SESSION["user"] == "member") {
            echo '<li><a href="../profile/mijnTickets.php">Mijn Tickets</a></li>';
          }
          if ($_SESSION["user"] == "admin") {
            echo '<li><a href="../profile/evenementen-toevoegen.php">Evenementen Toevoegen</a></li>';
            echo '<li><a href="../profile/bedrijven-verwijderen.php">Bedrijven Verwijderen</a></li>';
            echo '<li><a href="../profile/tijd-aanpassen.php">Tijd Aanpassen</a></li>';
            echo'<li><a href="../profile/overzichtEvenementen.php">Overzicht Evenementen</a></li>'; 
            echo '<li><a href="../profile/mijnTickets.php">Mijn Tickets</a></li>';
          } 
          } else {
          if (isset($_POST['login'])) {
            header("Location: ../profile/login.php"); 
          } 
          if (isset($_POST["register"])) {
            header("location: ../profile/register.php");
          }
          echo '<form method="post" action="../components/navbar.php">
          <div class="flex-auto text-[#FDFFFF]">
         <button class="btn btn-ghost" name="login">Login</button>
         <button class="btn btn-ghost" name="register">Register</button>
          </div>
          </form>'; 
        }
        ?>
      </ul>
    </div>
</div> 
</body>
</html>
<?php 
if (isset($_SESSION["gebruikersid"])) {
 $userid = $_SESSION["gebruikersid"];
 $query = "SELECT * FROM tbloverdraagnotifications WHERE ontvangerID = ".$_SESSION["gebruikersid"]; 
 $resultaat = $mysqli -> query($query); 
 foreach ($resultaat as $notification) {
  if ($notification["ontvangerID"] == $userid) {
  include $_SERVER['DOCUMENT_ROOT'] . "../ticketOverdragenMessage.php";
  }
  }
}
?>