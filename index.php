<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
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

$sql = "SELECT naam, aantalTickets, beschrijving, afbeelding FROM evenementen";
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');


// Execute the SQL query
$result = mysqli_query($mysqli, $sql);

// Display the ticket data in an HTML table
echo "<div class='grid grid-cols-4 gap-4'>";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      echo "<div class='p-4 border rounded-lg'>";
      if ($row['afbeelding'] != '') {
        echo "<img src='" . $row['afbeelding'] . "' alt='" . $row['naam'] . "' class='w-full'>";
      } else {
        echo "<img src='https://thenounproject.com/api/private/icons/583402/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0' alt='No Image' class='w-full'>";
      }
      echo "<h2 class='text-lg font-bold'>" . $row['naam'] . "</h2>";
      echo "<p class='text-gray-600'>" . $row['beschrijving'] . "</p>";
      echo "<p class='text-gray-800 font-bold'>€" . $row['aantalTickets'] . "</p>";
      echo "<button class='btn btn-primary'>Buy Now</button>";
      echo "</div>";
  }
} else {
  echo "No results to display!";
}
echo "</div>";


?>
  </body>
  </html>
  <?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
// Close the database connection
mysqli_close($mysqli);
?>