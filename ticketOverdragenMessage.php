<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
if (isset($_POST["accepteer"])) {
    $sql = "UPDATE tbltickets SET userID = ? WHERE ticketID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $_POST["ontvangerID"], $_POST["ticketID"]);
    $stmt->execute();
    
    $query = "DELETE FROM tbloverdraagnotifications WHERE ticketID = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $_POST["ticketID"]);
    $stmt->execute();
    
    header("Location: index.php");
}
if (isset($_POST["weigeren"])) {
    $sql = "DELETE FROM tbloverdraagnotifications WHERE ticketID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_POST["ticketID"]);
    $stmt->execute();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <div class="flex flex-col w-full">
        <br> <div role="alert" class="alert alert-info">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
             <span>
                <?php 
                    $stmt = $mysqli->prepare("SELECT * FROM tbloverdraagnotifications WHERE ontvangerID = ?");
                    $stmt->bind_param("i", $_SESSION["gebruikersid"]);
                    $stmt->execute();
                    $resultaat = $stmt->get_result();
                    ($resultaat->num_rows == 0) ? false : $resultaat;
                    foreach ($resultaat as $notificationData); 

                    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->bind_param("i", $notificationData["overdragerID"]);
                    $stmt->execute();
                    $resultaat = $stmt->get_result();
                    ($resultaat->num_rows == 0) ? false : $resultaat;
                    foreach ($resultaat as $gebruikerData); 

                    $stmt = $mysqli->prepare("SELECT * FROM evenementen WHERE evenementID = ?");
                    $stmt->bind_param("i", $notificationData["evenementID"]);
                    $stmt->execute();
                    $resultaat = $stmt->get_result();
                    ($resultaat->num_rows == 0) ? false : $resultaat;
                    foreach ($resultaat as $evenementData); 

                    echo $gebruikerData["username"]. " wil zijn ticket voor ".$evenementData["naam"]." overdragen aan jouw"; 

                ?>
                <form method="post" action="ticketOverdragenMessage.php">
                <input type="hidden" value="<?php echo $notificationData["ticketID"]?>" name="ticketID"/>
                <input type="hidden" value="<?php echo $notificationData["overdragerID"]?>" name="overdragerID"/>
                <input type="hidden" value="<?php echo $notificationData["ontvangerID"]?>" name="ontvangerID"/>
                <button name="accepteer"  class="btn btn-primary">accepteren</button>
                <button name="weigeren"  class="btn btn-primary">weigeren</button>
                </form> 
            </span>
        </div> 
        <div class="divider divider-info"></div> 
      </div>
</body>
</html>