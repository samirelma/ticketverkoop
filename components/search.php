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

    // Connect to the database

    if (isset($_GET['search'])) {
        $Search = $_GET['search'];

        // Prepare the SQL statement
        $stmt = $mysqli->prepare("SELECT * FROM evenementen WHERE naam LIKE ?");

        // Bind the search query parameter
        $param = "%" . $Search . "%";
        $stmt->bind_param("s", $param);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();



    

          // Display the ticket data in an HTML table
          echo '<div class="flex flex-wrap gap-4">';
          if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          echo '
          <div class="card w-96 bg-base-100 shadow-xl">
          <figure class="px-10 pt-10">';
          if (empty($row["afbeelding"])) {
            echo ' <img src="../img/eventPictures/no_picture.png" alt="'.$row["naam"].'" class="rounded-xl
            " />';
          } else {
            echo ' <img src="../img/eventPictures/'.$row["afbeelding"].'" alt="'.$row["naam"].'" class="rounded-xl" />'; 
          }
            echo'
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title
            ">'.$row["naam"].'</h2>
            <p>'.$row["beschrijving"].'</p>
            <p> datum: '.$row["datum"].'</p>
            <div class="card-actions">
              <button class="btn btn-primary">Bestel tickets</button>
            </div>
          </div>
        </div>'; 
          }
        } else {
          echo '<p class="text-2xl">
          er zijn geen gegevens gepland voor deze zaal</p>';
        }

        echo '</div>';
      }


?>

</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>