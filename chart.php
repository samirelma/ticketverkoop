<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if (isset($_POST["verwijder"])) {
  $sql = "DELETE FROM tblreservedtickets WHERE userID = ".$POST_["userID"]." AND evenementID = ".$_POST["evenementID"]." AND blok = ".$_POST["blok"]." AND stoel = ".$_POST["stoel"]." AND prijs = ".$POST["prijs"];
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
    <p style="margin: 0;"> blok: <?php echo $chart["blok"]?> stoel: <?php echo $chart["stoel"]?> prijs: <?php echo $chart["prijs"]?></p>
    <input type="hidden" name="blok" value="<?php echo $chart["blok"]?>">
    <input type="hidden" name="stoel" value="<?php echo $chart["stoel"]?>">
    <input type="hidden" name="prijs" value="<?php echo $chart["prijs"]?>">
    <input type="hidden" name="evenementID" value="<?php echo $chart["evenementID"]?>">
    <input type="hidden" name="userID" value="<?php echo $chart["userID"]?>">
    <button class="btn btn-primary" name="verwijder">Verwijder</button>
  </form>
</div>
 <?php
 }
 
?>
    <div class="card-actions justify-end">
      <button class="btn btn-primary">Buy Now</button>
    </div>
  </div>
</div>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>