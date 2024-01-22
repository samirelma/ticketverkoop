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
   ?>
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
        $dataEvenement = getEventsByUserID($mysqli,$userID);  
        if ($dataEvenement->num_rows > 0) {
          while ($row = $dataEvenement->fetch_assoc()) {
            if($row['weergeven'] == 1){
              $checked = "checked";
            }else{
              $checked = "";
            }

            ?>
            <tr>
              <td><?php echo $row['evenementID']; ?></td>
              <td><?php echo $row['naam']; ?></td>
              <td><?php echo $row['beschrijving']; ?></td>
              <td><input type="checkbox" class="toggle toggle-info" id="weergeven"  <?php $checked ?>/></td>            
            </tr>
            <?php
          }
        }
        ?>
      </tbody>

       </table>
       <?php
       
     
       ?>
     </div>

</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>

