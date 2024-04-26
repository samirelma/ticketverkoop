<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";


if (isset($_POST["betalen"])) {
  $sql = 'SELECT `name`, `prijs` FROM ticket_categories WHERE id= "' . $ticketCategorie . '"';
  $categorienaamString = $mysqli->query($sql);
  ($categorienaamString->num_rows == 0) ? false : $categorienaamString;
  foreach ($categorienaamString as $categorienaam) {
    $sql = 'INSERT INTO user_purchases (id, timeOfPurchase, productId, price, productName) VALUES (?,?,?,?,?)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('isiss', $_SESSION["gebruikersid"], date("Y-m-d H:i:s"), $ticketCategorie, $categorienaam["prijs"], $categorienaam["name"]);
    $stmt->execute();
    //go to start page if the ticket is saved in the database else give error message
    if ($stmt->affected_rows == 0) {
      echo "Er iseen fout opgetreden bij het aankopen van uw ticket!";
    } else {


      // Get the purchase id from the last insert
      $purchaseId = $mysqli->insert_id;

      // Insert new ticket into tbltickets and link it to the purchase (via id)
      $sql = 'INSERT INTO tbltickets (rij, stoel, evenementID, categoryID, userID, purchaseID) VALUES (?,?,?,?,?,?)';
      $stmt = $mysqli->prepare($sql);
            // data uit db halen
    $sqldata = 'SELECT * FROM tblreservedtickets WHERE userID = ' . $_SESSION["gebruikersid"];
    $resultaat = $mysqli->query($sqldata);
    $data = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $data) {
      $blok = $data["blok"];
      $stoel = $data["stoel"];
      $zaalID = $data["zaalID"];        
    }
      $stmt->bind_param('ssiiii', $blok, $stoel, $zaalID, $ticketCategorie, $_SESSION["gebruikersid"], $purchaseId);
      $stmt->execute();
      
      
      header("Location: /profile/betalen/stripe-betaalsysteem.php?purchaseid=" . $purchaseId);
      echo "Uw ticket is succesvol aangekocht!";
    }
  }
}


if (isset($_POST["verwijder"])) {
  $sql = "DELETE FROM tblreservedtickets WHERE userID = " .$_POST["userID"]." AND evenementID = ".$_POST["evenementID"]." AND blok = ".$_POST["blok"]." AND stoel = ".$_POST["stoel"]." AND prijs = ".$_POST["prijs"];
  var_dump($sql);
  $mysqli -> query($sql);
  header("Location: chart.php");

 
 }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>title</title>
</head>
<body>
<?php 
 $sql = "SELECT * FROM tblreservedtickets WHERE userID = ".$_SESSION["gebruikersid"];
 $resultaat = $mysqli -> query($sql);
 $chartData = ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
  if ($chartData == false) {
    echo "<h1>U heeft geen tickets in uw winkelwagen</h1>";
    exit();
  }
?>
 <div class="card w-96 bg-base-100 shadow-xl">
  <div class="card-body">
    <h2 class="card-title">Winkel Wagen</h2>
    <?php
 foreach ($chartData as $chart) {
  $sql = "SELECT naam FROM evenementen WHERE evenementID = ".$chart["evenementID"];
  $resultaat = $mysqli -> query($sql);
  $event = ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
  foreach ($event as $event) {
    echo "<h2>".$event["naam"]."</h2>";
  }
 ?>
 <div style="display: flex; align-items: center;">
  <form method="post" action="chart.php" style="margin-left: 10px;">
    <p style="margin: 0;"> blok: <?php echo $chart["blok"]?> stoel: <?php echo $chart["stoel"]?> prijs: € <?php echo $chart["prijs"]?></p>
    <input type="hidden" name="blok" value="<?php echo $chart["blok"]?>">
    <input type="hidden" name="stoel" value="<?php echo $chart["stoel"]?>">
    <input type="hidden" name="prijs" value="<?php echo $chart["prijs"]?>">
    <input type="hidden" name="evenementID" value="<?php echo $chart["evenementID"]?>">
    <input type="hidden" name="userID" value="<?php echo $_SESSION["gebruikersid"]?>">
    <button class="btn btn-primary" name="verwijder">Verwijder</button>
  </form>
</div>
 <?php
 }
 
?>
    <form action="/profile/betalen/stripe-betaalsysteem.php" method="get">
  <input type="hidden" name="purchaseid" value="<?php echo $purchaseid; ?>">
  <button type="submit" class="btn btn-primary">Betalen</button>
</form>
  </div>
</div>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>