<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<?php
if (isset($_POST["geefWeer"])) {

}
?>
<div class="overflow-x-auto">
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>evenement </th>
        <th>datum</th>
        <th>beschrijving</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        <?php
        $userID = $_SESSION["gebruikersid"];
    $evenementdata= getEvenementenByBedrijfID($mysqli, $userID); 
    foreach ($evenementdata as $evenement) {
    ?>
      <tr class="hover">
        <th><?php echo $evenement["evenementID"] ?></th>
        <td><?php echo $evenement["naam"] ?></td>
        <td><?php echo $evenement["datum"] ?></td>
        <td><?php echo $evenement["beschrijving"] ?></td>
        <form>
        <td><button class="btn" name="bekijk">bekijk</button></td>
        <td><button class="btn" name="geefWeer">geef weer</button></td>
    </form>
      </tr>
    </tbody>
    <?php } ?>
  </table>
</div>
</body>
</html>