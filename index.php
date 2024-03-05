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
  
 

// Define the SQL query to retrieve the ticket data



$sql = "SELECT naam, aantalTickets, beschrijving, afbeelding, zaalID FROM evenementen";



// Execute the SQL query
$result = mysqli_query($mysqli, $sql);

// Display the ticket data in an HTML table
echo "<div class='grid grid-cols-4 gap-4'>";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      echo "<div class='p-4 border rounded-lg'>";
      if ($row['afbeelding'] != '') {
         // If the file exists in the 'img/eventPictures/' directory, set $imgPath to the path of the image
    // Otherwise, set $imgPath to the path of the image in the 'Downloads/' directory
   
        $imgPath = file_exists('img/eventPictures/' . $row['afbeelding']) ? 'img/eventPictures/' . $row['afbeelding'] : 'Downloads/' . $row['afbeelding'];
        // Display the image using the $imgPath as the source, and set the 'alt' attribute to the value of the 'naam' field in the $row array
    // The image is displayed with a class of 'w-full' and inline styles for maximum width of 200px and auto height
    
        echo "<img src='" . $imgPath . "' alt='" . $row['naam'] . "' class='w-full' style='max-width: 200px; height: auto;'>";
    } else {
      // If the 'afbeelding' field is empty, display a default image using a URL from the Noun Project API
    // The image is displayed with a class of 'w-full' and inline styles for maximum width of 250px and auto height
        echo "<img src='https://thenounproject.com/api/private/icons/583402/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0' alt='No Image' class='w-full' style='max-width: 250px; height: auto;'>";
      }
      //$row is a variable that represents a row of data fetched from a database query result. 
      echo "<h2 class='text-gray-600'>Naam: " . $row['naam'] . "</h2>";
      echo "<p class='text-gray-600'>Beschrijving: " . $row['beschrijving'] . "</p>";
      echo "<p class='text-gray-600'>aantal Tickets: " . $row['aantalTickets'] . "</p>";
      echo '<form method="post" action="index.php">
      <input type="hidden" value="'.$row['zaalID'].'" name="zaalID">
      <button class="btn btn-primary" name="bestel">Buy Now</button>
      </form>';
      echo "</div>";
  }
} else {
  echo "No results to display!";
}
echo "</div>";



 
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