<!DOCTYPE html>
  <html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>  


<?php 
  
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";


//make a link that goes to register.php
echo "<a href='/profile/register.php'>Register</a>";

// Define the SQL query to retrieve the ticket data
$sql = "SELECT name, description, price, imageurl FROM tickets";
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');


// Execute the SQL query
$result = mysqli_query($mysqli, $sql);

// Display the ticket data in an HTML table
echo "<div class='grid grid-cols-4 gap-4'>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<div class='border p-4 rounded-lg shadow-lg'>";
  if (!empty($row['imageurl'])) {
    echo "<img src='" . $row['imageurl'] . "' alt='" . $row['name'] . "' class='w-full'>";
  } else {
    echo "<img src='https://thenounproject.com/api/private/icons/583402/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0' alt='Default Image' class='w-full'>";
  }
  echo "<h2 class='text-lg font-bold'>" . $row['name'] . "</h2>";
  echo "<p class='text-gray-600'>" . $row['description'] . "</p>";
  echo "<p class='text-gray-800 font-bold'>€" . $row['price'] . "</p>";
  echo "<button class='btn btn-primary'>Buy Now</button>";
  echo "</div>";
}
echo "</div>";

// Close the database connection
mysqli_close($mysqli);