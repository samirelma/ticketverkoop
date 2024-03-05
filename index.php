<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
 if(isset($_POST["bestel"])) {
  header("Location:../selectTicketPage.php?zaalID=".$_POST["zaalID"]);
 }
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<?php 
  
 






 
          // Display all the tickets in an HTML table from the database
          echo '<div class="flex flex-wrap gap-4">';
          //dont get results from database just show all the events
          $data = getallevents($mysqli);
          foreach ($data as $event) {
            if($event["weergeven"] == 1) {
            echo '
            <div class="card w-72 bg-base-100 shadow-xl">
            <figure class="px-10 pt-10">';
            if (empty($event["afbeelding"])) {
              echo ' <img src="../img/eventPictures/no_picture.png" alt="'.$event["naam"].'" class="rounded-xl" />';
            } else {
              echo ' <img src="../img/eventPictures/'.$event["afbeelding"].'" alt="'.$event["naam"].'" class="rounded-xl" />'; 
            }
              echo'
            </figure>
            <div class="card-body items-center text-center">
              <h2 class="card-title">'.$event["naam"].'</h2>
              <p>'.$event["beschrijving"].'</p>
              <p> datum: '.$event["datum"].'</p>
              <div class="card-actions">
                <button class="btn btn-primary">Bestel tickets</button>
              </div>
            </div>
          </div>'; 
            }
          }
          echo '</div>';
      
          

?>
  </body>
  </html>
  <?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
// Close the database connection
mysqli_close($mysqli);
?>