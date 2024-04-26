<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
include $_SERVER['DOCUMENT_ROOT'] . "/berekenZaalStoelen.php";

if (!isset($_SESSION['user'])) {
    echo "<div class='bg-red-200 p-3 rounded-lg text-red-700'>";
    echo "Please login first!";
    echo "<a href='/profile/login.php' class='block mt-2 text-blue-500 hover:text-blue-700'>Login</a>";
    echo "</div>";
    exit;
}

if (isset($_POST["categorieAntwoord"])) {
  $zaalID = $_POST["zaalID1"];
  $evenementID = $_POST["evenementID1"];
  $ticketCategorie = $_POST["ticketCategorie1"];
} else if (isset($_POST["blokantwoord"])) {
  $zaalID = $_POST["zaalID2"];
  $evenementID = $_POST["evenementID2"];  
  $ticketCategorie = $_POST["ticketCategorie2"];
  $blok = $_POST["blok2"];
} elseif (isset($_POST["stoelantwoord"])) {
  $zaalID = $_POST["zaalID3"];
  $evenementID = $_POST["evenementID3"];
  $ticketCategorie = $_POST["ticketCategorie3"];
  $blok = $_POST["blok3"];
  $stoel = $_POST["stoel3"];
} elseif (isset($_POST["winkelwagen"])) {
  $zaalID = $_POST["zaalID3"];
  $evenementID = $_POST["evenementID3"];
  $ticketCategorie = $_POST["ticketCategorie3"];
  $stoel = $_POST["stoel3"];
  $blok = $_POST["blok3"];
  $sqlPrijs = 'SELECT prijs FROM ticket_categories WHERE id = ' . $ticketCategorie;
  $resultaat = $mysqli->query($sqlPrijs);
  $prijs = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
  foreach ($prijs as $prijs) {
    $prijs = $prijs["prijs"];
  }
  $sqlproductnaam = 'SELECT name FROM ticket_categories WHERE id = ' . $ticketCategorie;
  $resultaat = $mysqli->query($sqlproductnaam);
  $productnaam = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
  foreach ($productnaam as $productnaam) {
    $productnaam = $productnaam["name"];
  }

// save the selected ticket in user_purchases with the id timeOfPurchase productId is auto increment, price, productName ,stoel, blok, evenementID, isPaid = 0 if isPaid = 1 the ticket is paid
$sql = 'INSERT INTO user_purchases (id, timeOfPurchase, productId, price, productName, secretKey,  isPaid , stoel, blok) VALUES (?,?,?,?,?,?,?,?)';
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die("Failed to prepare SQL query: " . $mysqli->error);
}
$isPaid = 0;
$stmt->bind_param('isissiii', $_SESSION["gebruikersid"], date("Y-m-d H:i:s"), $ticketCategorie, $prijs, $productnaam, $isPaid, $stoel, $blok,);
$stmt->execute();
  var_dump($stmt->affected_rows);
  $stmt->execute();
  header("Location: ../chart.php");
} elseif (isset($_POST["volgendeTicket"])) {
   $zaalID = $_POST["zaalID3"];
  $evenementID = $_POST["evenementID3"];
  $ticketCategorie = $_POST["ticketCategorie3"];
  $blok = $_POST["blok3"];
  $stoel = $_POST["stoel3"];
} else {
  $zaalID = $_GET["zaalID"];
  $evenementID = $_GET["evenementID"];
}
$zaalAsString = getzalenByID($mysqli, $zaalID);
foreach ($zaalAsString as $zaal) {
  $zaalPlategrond = "img/zaalPictures/" . $zaal["plategrond"];
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>title</title>
</head>

<body>
  <div class="hero min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
      <div class="text-center lg:text-left">
        <h1 class="text-5xl font-bold">Reserveer plaatsen</h1>
        <p class="py-6">Selecteer hier uw plaats om een ticket te boeken.</p>
        <img src="<?php echo $zaalPlategrond ?> " width="700" height="550">
      </div>
      <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <?php
        if ((!isset($_POST["categorieAntwoord"])) && (!isset($_POST["blokantwoord"])) && (!isset($_POST["stoelantwoord"]))) {
        ?>
          <form class="card-body" method="post" action="selectTicketPage.php">
            <div class="form-control">
              <input type="hidden" value="<?php echo $_GET["zaalID"] ?> " name="zaalID1">
              <input type="hidden" value="<?php echo $_GET["evenementID"] ?> " name="evenementID1">
              <label class="label">
                <span class="label-text">categorie</span>
              </label>
              <select class="select w-full max-w-xs" name="ticketCategorie1">
                <?php

                foreach (getCategorieData($mysqli) as $categorie) {
                ?>
                  <option value="<?php echo $categorie['id'] ?>"><?php echo ($categorie['name'] . " €" . $categorie['prijs']) ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-control mt-6">
              <button class="btn btn-primary" name="categorieAntwoord">Volgende</button>
            </div>
          </form>
        <?php } else if (isset($_POST["categorieAntwoord"])) {
        ?>
          <form class="card-body" method="post" action="selectTicketPage.php">
            <div class="form-control">
              <label class="label">
                <span class="label-text">Blok</span>
              </label>
              <input type="hidden" name="zaalID2" value="<?php echo isset($zaalID) ? $zaalID : '' ?>">
              <input type="hidden" name="evenementID2" value="<?php echo isset($evenementID) ? $evenementID : '' ?>">
              <input type="hidden" name="ticketCategorie2" value="<?php echo $ticketCategorie ?>">
              <select class="select w-full max-w-xs" name="blok2">
                <?php foreach (berekenZaalBlokken($ticketCategorie, $zaalID) as $blok) { ?>
                  <option value="<?php echo $blok ?>"><?php echo $blok ?></option> <?php } ?>
              </select>
            </div>
            <div class="form-control mt-6">
              <button class="btn btn-primary" name="blokantwoord">Volgende</button>
            </div>
          </form>
        <?php
        } else if (isset($_POST["blokantwoord"])) {
        ?>
          <form class="card-body" method="post" action="selectTicketPage.php">
            <div class="form-control">
              <label class="label">
                <span class="label-text">Stoel</span>
              </label>
              <input type="hidden" name="zaalID3" value="<?php echo $zaalID ?>">
              <input type="hidden" name="evenementID3" value="<?php echo isset($evenementID) ? $evenementID : '' ?>">
              <input type="hidden" name="ticketCategorie3" value="<?php echo $ticketCategorie ?>">
              <input type="hidden" name="blok3" value="<?php echo $blok ?>">
              <select class="select w-full max-w-xs" name="stoel3">
                <?php foreach (berekenZaalStoel($blok, $zaalID) as $stoel) { ?>
                  <option value="<?php echo $stoel ?>"><?php echo $stoel ?></option> <?php } ?>
              </select>
            </div>
            <div class="form-control mt-6">
              <button class="btn btn-primary" name="stoelantwoord">Volgende</button>
            </div>
          </form>
        <?php } elseif (isset($_POST["stoelantwoord"])) { ?>
          <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
              <h2 class="card-title">Afrekenen</h2>
              <p>Wil je uw plaats afrekenen?</p><br>
              <?php $sql = 'SELECT `name`, `prijs` FROM ticket_categories WHERE id= "' . $ticketCategorie . '"';
              $categorienaamString = $mysqli->query($sql);
              ($categorienaamString->num_rows == 0) ? false : $categorienaamString;
              foreach ($categorienaamString as $categorienaam) { ?>
                <p>Uw plaats is categorie: <?php echo $categorienaam["name"] ?> blok: <?php echo $blok ?> stoel: <?php echo $stoel ?>.</p><br>
                <p> Prijs: €<?php echo $categorienaam["prijs"] ?>
                <?php } ?>
            </div>
            <div class="card-actions justify-end">
              <form method="post" action="selectTicketPage.php">
                <input type="hidden" name="zaalID3" value="<?php echo isset($zaalID) ? $zaalID : '' ?>">
                <input type="hidden" name="evenementID3" value="<?php echo isset($evenementID) ? $evenementID : '' ?>">
                <input type="hidden" name="ticketCategorie3" value="<?php echo $ticketCategorie ?>">
                <input type="hidden" name="blok3" value="<?php echo $blok ?>">
                <input type="hidden" name="stoel3" value="<?php echo $stoel ?>">
                <button class="btn btn-primary" name="volgendeTicket">Nog een ticket toevoegen</button>
                <button class="btn btn-primary" name="winkelwagen">winkelwagen</button>
              </form>
            
            </div>
          </div>
      </div>
    <?php  } ?>
    <input type="hidden" name="zaalID3" value="<?php echo isset($zaalID) ? $zaalID : '' ?>">
    <input type="hidden" name="evenementID3" value="<?php echo isset($evenementID) ? $evenementID : '' ?>">
    </div>
  </div>
  </div>

</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>