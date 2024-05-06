<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

if (isset($_POST["betalen"])) {


  // Get all the data from the database user_purchases
  $stmt = $mysqli->prepare("SELECT * FROM user_purchases WHERE id = ? AND isPaid = 0");
  $stmt->bind_param('i', $_SESSION["gebruikersid"]);
  $stmt->execute();
  $resultaat = $stmt->get_result();
  $chartData = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);

  foreach ($chartData as $chart) {
    $rij = $chart["blok"];
    $stoel = $chart["stoel"];
    $evenementID = $chart["evenementID"];
    $categoryID = $chart["productId"];
    
    $purchaseId = $chart["purchaseID"];

    $sql = 'INSERT INTO tbltickets (rij, stoel, evenementID, categoryID, userID, purchaseID) VALUES (?,?,?,?,?,?)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssiiii', $rij, $stoel, $evenementID, $categoryID, $_SESSION["gebruikersid"], $purchaseId);
    $stmt->execute();
  }




  header("Location: /profile/betalen/stripe-betaalsysteem.php?purchaseid=" . $purchaseId);
  echo "Uw ticket is succesvol aangekocht!";
}

if (isset($_POST["verwijder"])) {
  $sql = "DELETE FROM user_purchases WHERE id = ? AND evenementID = ? AND blok = ? AND stoel = ? AND price = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('iiisi', $_POST["userID"], $_POST["evenementID"], $_POST["blok"], $_POST["stoel"], $_POST["prijs"]);
  $stmt->execute();
  header("Location: chart.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>title</title>
</head>

<body class="flex items-center justify-center min-h-screen">
  <?php
  //make a query to get all the tickets that are in the cart using the userID and check if isPaid is 0 (not paid) let it be in the cart if isPaid is 1 (paid) remove it from the cart
  $stmt = $mysqli->prepare("SELECT * FROM user_purchases WHERE id = ? AND isPaid = 0");
  $stmt->bind_param('i', $_SESSION["gebruikersid"]);
  $stmt->execute();
  $resultaat = $stmt->get_result();
  $chartData = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
  ?>
  <div class="card w-96 bg-base-100 shadow-xl">
    <div class="card-body">
      <h2 class="card-title">Winkel Wagen</h2>
      <?php
      if ($chartData == false) {
        echo "<p>U heeft geen tickets in uw winkelwagen</p>";
      } else {
        $totaalprijs = 0;
        foreach ($chartData as $chart) {
          $totaalprijs += $chart["price"];
          $stmt = $mysqli->prepare("SELECT naam FROM evenementen WHERE evenementID = ?");
          $stmt->bind_param('i', $chart["evenementID"]);
          $stmt->execute();
          $resultaat = $stmt->get_result();
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
        echo "<h2>Totaal prijs: € " . $totaalprijs . "</h2>";
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