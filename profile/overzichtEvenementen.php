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
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th>concert</th>
            <th>beschrijving</th>
            <th>weergeven</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');
          $userID = $_SESSION["gebruikersid"]; 
          $dataEvenement = getEventsByUserID($mysqli, $userID);  
          if ($dataEvenement->num_rows > 0) {
            while ($row = $dataEvenement->fetch_assoc()) {
              if ($row['weergeven'] == 1) {
                $checked = "checked";
              } else {
                $checked = "";
              }
          ?>
          <tr>
            <td><?php echo $row['evenementID']; ?></td>
            <td><?php echo $row['naam']; ?></td>
            <td><?php echo $row['beschrijving']; ?></td>
            <td><input type="checkbox" class="toggle toggle-info" id="weergeven" <?php echo $checked; ?>/></td>            
          </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
      <?php
      // Database connection
      $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');    
      // check if the weergeven is 1 or 0
      $query = 'SELECT weergeven FROM evenementen WHERE evenementID = ?';
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $_POST['evenementID']);
      $stmt->execute();
      $result = $stmt->get_result();
      $data = $result->fetch_assoc();
      //print weergeven
      echo $data['weergeven'];
                // If the toggle button is on, set weergeven to 1, else set it to 0
        if (isset($_POST['weergeven'])) {
          if ($_POST['weergeven'] == 0) {
            $query = 'UPDATE evenementen SET weergeven = 0 WHERE evenementID = ?';
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $_POST['evenementID']);
            $stmt->execute();
          } else {
            $query = 'UPDATE evenementen SET weergeven = 1 WHERE evenementID = ?';
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $_POST['evenementID']);
            $stmt->execute();
          }
        }
        ?>
     
     </div>

</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>

