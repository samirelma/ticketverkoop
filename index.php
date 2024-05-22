<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if(isset($_POST["bestel"])) {
  header("Location:../selectTicketPage.php?zaalID=".$_POST["zaalID"]."&evenementID=".$_POST["evenementID"]);
}
//check if the payment is successful
if (isset($_GET['payment']) && $_GET['payment'] == 'success') {
  echo '<div class="alert alert-success" role="alert">
  Betaling is gelukt!
</div>';
  echo '<script>
  setTimeout(function() {
    document.querySelector(".alert").style.display = "none";
  }, 4000);
  </script>';
  //update the database to set isPaid to 1
  $stmt = $mysqli->prepare("UPDATE user_purchases SET isPaid = 1 WHERE id = ? AND isPaid = 0");
  $stmt->bind_param("i", $_SESSION["gebruikersid"]);
  $stmt->execute();
  $stmt->close();
}

//check if the payment is cancelled  let the message dissapear after 5 seconds
if (isset($_GET['payment']) && $_GET['payment'] == 'cancelled') {
  echo '<div class="alert alert-danger" role="alert">
  Betaling is geannuleerd!
</div>';
  echo '<script>
  setTimeout(function() {
    document.querySelector(".alert").style.display = "none";
  }, 4000);
  </script>';
  //delete the ticket from the database in user_purchases
  $stmt = $mysqli->prepare("DELETE FROM user_purchases WHERE id = ? AND isPaid = 0");
  $stmt->bind_param("i", $_SESSION["gebruikersid"]);
  $stmt->execute();
  $stmt->close();
  
}
// now make also an alert for ?alert=evenementtoegevoegd
if (isset($_GET['alert']) && $_GET['alert'] == 'evenementtoegevoegd') {
  echo '<div class="alert alert-success" role="alert">
  Evenement is toegevoegd!
</div>';
  echo '<script>
  setTimeout(function() {
    document.querySelector(".alert").style.display = "none";
  }, 4000);
  </script>';
}

// now make also an alert for ?alert=register
if (isset($_GET['success'])) {
  if ($_GET['success'] == "register") {
    echo '<div class="alert alert-success" role="alert">
    Registratie is gelukt!
  </div>';
    echo '<script>
    setTimeout(function() {
      document.querySelector(".alert").style.display = "none";
    }, 4000);
    </script>';
  }
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
          if ($data != false) {
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
              ';
              echo "<div class='text-gray-600'>
              <p>Beschrijving:</p>
                  <textarea name='beschrijving' class='text-gray-600' required readonly>" . $event["beschrijving"] . "</textarea>
              </div>";
              echo'
              <p> datum: '.$event["datum"].'</p>
              <div class="card-actions">
              <form method="post" action="index.php">
              <input type="hidden" value="'.$event["zaalID"].'" name="zaalID">
              <input type="hidden" value="'.$event["evenementID"].'" name="evenementID">
                <button class="btn btn-primary" name="bestel">Bestel tickets</button>
              </form>
              </div>
            </div>
          </div>'; 
            }
          }
        } else {
          echo '<p class="text-2xl ml-6">Er zijn geen evenementen gevonden</p>';
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