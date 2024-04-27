<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

if (isset($_POST["betalen"])) {
  $ticketCategorie = $_POST["productID"];
  $sql = 'SELECT `name`, `prijs` FROM ticket_categories WHERE id= "' . $ticketCategorie . '"';
  $categorienaamString = $mysqli->query($sql);
  ($categorienaamString->num_rows == 0) ? false : $categorienaamString;
  foreach ($categorienaamString as $categorienaam) {   
      // Insert new ticket into tbltickets and link it to the purchase (via id)
      $sql = 'INSERT INTO tbltickets (rij, stoel, evenementID, categoryID, userID, purchaseID) VALUES (?,?,?,?,?,?)';
      $stmt = $mysqli->prepare($sql);
      // data uit db halen
      $blok = $_POST["blok"];
      $stoel = $_POST["stoel"];
      $ticketCategorie = $_POST["productID"];
      $evenementID = $_POST["evenementID"];
      $purchaseId = $_POST["purchaseID"];
      $stmt->bind_param('ssiiii', $blok, $stoel, $evenementID, $ticketCategorie, $_SESSION["gebruikersid"], $purchaseId);
      $stmt->execute();

      header("Location: /profile/betalen/stripe-betaalsysteem.php?purchaseid=" . $purchaseId);
      echo "Uw ticket is succesvol aangekocht!";
    }
  }

if (isset($_POST["verwijder"])) {
  $sql = "DELETE FROM user_purchases WHERE id = " . $_POST["userID"] . " AND evenementID = " . $_POST["evenementID"] . " AND blok = " . $_POST["blok"] . " AND stoel = " . $_POST["stoel"] . " AND price = " . $_POST["prijs"];
  $mysqli->query($sql);
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
//make a query to get all the tickets that are in the cart using the userID and check if isPaid is 0 (not paid) let it be in the cart if isPaid is 1 (paid) remove it from the cart
  $sql = "SELECT * FROM user_purchases WHERE id = " . $_SESSION["gebruikersid"] ." AND isPaid = 0";
  $resultaat = $mysqli->query($sql);
  $chartData = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
  ?>
  <div class="card w-96 bg-base-100 shadow-xl">
    <div class="card-body">
      <h2 class="card-title">Winkel Wagen</h2>
      <?php
      if ($chartData == false) {
        echo "<p>U heeft geen tickets in uw winkelwagen</p>";
      } else {
      foreach ($chartData as $chart) {
        $sql = "SELECT naam FROM evenementen WHERE evenementID = " . $chart["productId"];
        $resultaat = $mysqli->query($sql);
        $event = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
        foreach ($event as $event) {
          echo "<h2>" . $event["naam"] . "</h2>";
        }
      
      ?>
        <div style="display: flex; align-items: center;">
          <form method="post" action="chart.php" style="margin-left: 10px;">
            <p style="margin: 0;"> blok: <?php echo $chart["blok"] ?> stoel: <?php echo $chart["stoel"] ?> prijs: € <?php echo $chart["price"] ?></p>
            <input type="hidden" name="blok" value="<?php echo $chart["blok"] ?>">
            <input type="hidden" name="stoel" value="<?php echo $chart["stoel"] ?>">
            <input type="hidden" name="prijs" value="<?php echo $chart["price"] ?>">
            <input type="hidden" name="evenementID" value="<?php echo $chart["evenementID"] ?>">
            <input type="hidden" name="userID" value="<?php echo $_SESSION["gebruikersid"] ?>">
            <input type="hidden" name="productID" value="<?php echo $chart["productId"] ?>">
            <input type="hidden" name="purchaseID" value="<?php echo $chart["purchaseID"] ?>">
            <button class="btn btn-primary" name="verwijder">Verwijder</button>
          </form>
        </div>
      <?php
      }
      }
      ?>
      <form action="#" method="post">
        <?php if ($chartData != false) {
          echo '
            <input type="hidden" name="blok" value="' . $chart["blok"] . '">
            <input type="hidden" name="stoel" value="' . $chart["stoel"] . '">
            <input type="hidden" name="prijs" value="' . $chart["price"] . '">
            <input type="hidden" name="evenementID" value="' . $chart["evenementID"] . '">
            <input type="hidden" name="userID" value="' . $_SESSION["gebruikersid"] . '">
            <input type="hidden" name="productID" value="' . $chart["productId"] . '">
            <input type="hidden" name="purchaseID" value="' . $chart["purchaseID"] . '">
            <button type="submit" name="betalen" class="btn btn-primary">Betalen</button>';
        } ?>
      </form>
    </div>
  </div>
</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>