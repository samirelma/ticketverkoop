<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Tijd aanpassen</title>
</head>

<body>
    <?php
    if (!isset($_SESSION['user'])) {
        header("Location: /profile/login.php");
        exit;
    }

        //make a search bar so u can search for events
        ?>
        <form action="/profile/tijd-aanpassen.php" class="flex flex-row justify-center gap-4">
  <div class="form-control w-full max-w-xs">
    <input type="text" name="search" placeholder="Search" class="input input-primary input-bordered">
  </div>
  <button class="btn btn-primary">Zoeken</button>
</form>
<br>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

// Check if the search term is set in the URL query parameters
if (isset($_GET['search'])) {
    // If set, assign the search term to a variable
    $searchTerm = $_GET['search'];
 // Prepare a SQL statement containing the search term
     $sql = "SELECT evenementID, naam, aantalTickets, beschrijving, datum FROM evenementen WHERE naam LIKE ?";
    // Prepare the statement for execution
    $stmt = $mysqli->prepare($sql);
    // Bind the search term as a parameter to the statement
    $param = "%{$searchTerm}%";
    $stmt->bind_param('s', $param);
} else {
    // If the search term is not set, prepare a SQL statement to select all events
    $sql = "SELECT evenementID, naam, aantalTickets, beschrijving, datum FROM evenementen";
      // Prepare the statement for execution
  $stmt = $mysqli->prepare($sql);

}

  
  // Execute the statement
$stmt->execute();
// Get the result set from the executed statement
$result = $stmt->get_result();

    // Display the ticket data in an HTML table
    echo "<div class='grid grid-cols-4 gap-4'>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='p-4 border rounded-lg'>";
            //$row is a variable that represents a row of data fetched from a database query result. 
            echo "<h2 class='text-gray-600'>Naam: " . $row['naam'] . "</h2>";
            echo "<p class='text-gray-600'>Beschrijving: " . $row['beschrijving'] . "</p>";
            echo "<p class='text-gray-600'>aantal Tickets: " . $row['aantalTickets'] . "</p>";
            echo "<p class='text-gray-600'>Datum: " . $row['datum'] . "</p>";
        
          // Start the form

        echo "<form action='/profile/update-timer.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['evenementID'] . "' />"; // Pass the id of the event to the form
        ?>
        <!-- Date -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text text-blue-500">Wijzig datum event</span>
            </label>
            <input type="datetime-local" name="datum" class="input input-bordered w-full" required />
        </div>
        <br>
        <div class='form-control w-full text-center'>
            <button class='btn btn-primary mx-auto' type='submit'>Wijzig</button>
        </div>
        <?php
        // End the form
        echo "</form>";

            echo "</div>";
        }
    } else {
        echo "No results to display!";
        
        
  ?>
  <br>
  <a href="../profile/tijd-aanpassen.php" >klik hier om terug te gaan</a>
  <?php
    }
    echo "</div>";
    ?>
</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>