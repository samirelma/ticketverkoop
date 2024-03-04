<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";



 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<?php
    // Database connection
    $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');
 
    // If the toggle button is on, set weergeven to 1, and if it's off, set it to 0
    $weergeven = isset($_POST['weergeven']) ? 1 : 0;
    // Update the weergeven value in the database
    $query = 'UPDATE evenementen SET weergeven = ? WHERE evenementID = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii', $weergeven, $_POST['evenementID']);
    $stmt->execute();


    ?>
<body>
       <div class="overflow-x-auto">
   <table class="table">
     <thead>
       <tr>
         <th>Concert</th>
         <th>Beschrijving</th>
         <th>Weergeven</th>
                </tr>
     </thead>
     <tbody>
       <?php
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

        // Fetch rows from the database
        $query = "SELECT * FROM evenementen WHERE userID = ?";
       $userID = $_SESSION["gebruikersid"]; 
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();


        // Loop through the rows
        while ($row = $result->fetch_assoc()) {
          // Set $checked based on the weergeven value
          $checked = $row['weergeven'] == 1 ? 'checked' : '';

       ?>
           <tr>
             <td><?php echo $row['naam']; ?></td>
             <td><?php echo $row['beschrijving']; ?></td>
             <form method="POST" action="overzichtEvenementen.php">
              <td>
                <input type="hidden" name="evenementID" value="<?php echo $row['evenementID']; ?>" />
                <input type="checkbox" class="toggle toggle-info" id="weergeven" name="weergeven" value="1" <?php echo $checked; ?> onchange="this.form.submit()" />
              </td>
              </form>
                        </tr>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <?php
       }
            ?>
</tbody>

    </table>


     </div>

</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>