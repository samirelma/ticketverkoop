
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
                    $query = ("SELECT *  FROM tbloverdraagnotifications WHERE ontvangerID =".$_SESSION["gebruikersid"]);
                    $resultaat = $mysqli -> query($query); 
                    ($resultaat->num_rows == 0)?false:$resultaat;
                    foreach ($resultaat as $notificationData); 

                    $queryGebruiker = ("SELECT * FROM users WHERE id=" .$notificationData["overdragerID"]); 
                    $resultaat = $mysqli -> query($queryGebruiker); 
                    ($resultaat->num_rows == 0)?false:$resultaat;
                    foreach ($resultaat as $gebruikerData); 

                    $queryTicket = ("SELECT naam FROM evenementen WHERE evenementID =" .$notificationData["evenementID"]); 
                    $evenementData = $mysqli -> query($queryTicket); 
                    echo $gebruikerData["username"]. " wil zijn ticket voor ".$evenementData." overdragen aan jouw"; 

                ?>
                <form>
                <button name="accepteer"  class="btn btn-primary">accepteren</button>
                <button name="weigeren"  class="btn btn-primary">weigeren</button>
                </form> 
            </span>
        </div> 
        <div class="divider divider-info"></div> 
      </div>
</body>
</html>