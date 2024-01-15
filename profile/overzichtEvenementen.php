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
       $userID = $_SESSION["gebruikersid"]; 
        $dataevenement = getEventsByUserID($mysqli,$userID); 
       foreach ($dataevenement as $evenemten) {
       ?>
           <tr>
             <th><?php echo $evenemten["evenementID"]?></th>
             <td><?php echo $evenemten["naam"]?></td>
             <td><?php echo $evenemten["beschrijving"]?></td>
             <?php
             echo '
              <form method="post" action="overzichtEvenementen.php">
              <td><input type="checkbox" class="toggle toggle-info" checked /></td>
              </form>
             '?>
           </tr>
         </tbody>
       </table>
       <?php
       }
       ?>
     </div>

</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>

