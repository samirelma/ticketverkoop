<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
 if(isset($_POST["ticket"])) {
 header("Location: ../generatePDF.php?ticketID=".$_POST["ticketID"]);
 }    
 if(isset($_POST["overdragen"])) {
 header("Location:../ticketOverdragen.php?ticketID=".$_POST["ticketID"]."&evenementID=".$_POST["evenementID"]); 
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
    $userId = $_SESSION["gebruikersid"];
    $ticketAsString = getTicketsByUser($mysqli, $userId); 
    if ($ticketAsString != false){
      foreach ($ticketAsString as $ticket) {
        $eventId = $ticket["evenementID"];
        $data2 = getEventsByEventid($mysqli,$eventId);
        foreach ($data2 as $event) {
        ?>
        <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th></th>
              <th>concert</th>
              <th>beschrijving</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
   
            
            ?>
                <tr>
                  <th><?php echo $ticket["TicketID"]; ?></th>
                  <td><?php echo $event["naam"]; ?></td>
                  <td><?php echo $event["beschrijving"]; ?></td>
                   <form method="post" action="mijnTickets.php">
                   <input type="hidden" value="<?php echo $ticket["TicketID"] ?>" name="ticketID"> 
                   <input type="hidden" value="<?php echo $ticket["evenementID"] ?>" name="evenementID" >
                   <td><button class="btn" name="ticket">Ticket</button></td>
                   <?php 
                  $query = "SELECT * FROM tbloverdraagnotifications WHERE overdragerID = ".$_SESSION["gebruikersid"]; 
                  $resultaat = $mysqli -> query($query); 
                  if(mysqli_num_rows($resultaat) == 0) {
                  ?>
                   <td><button class="btn" name="overdragen">Overdragen</button></td>
                   </form>  
                   <?php } else {
                    echo '<td> overdraging aangevraagd</td>';
                   }?>               
                </tr>
          <?php  
        }
        } ?>
              </tbody>
            </table>
          </div>
        <?php
        
    } else {
        echo "Je hebt nog geen tickets besteld"; 
    }

    ?>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>

