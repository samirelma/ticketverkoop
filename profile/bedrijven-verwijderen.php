<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if (!isset($_SESSION['user'])) {
    header("Location: /profile/login.php");
    exit;
}
if ($_SESSION['user'] != 'admin') {
    header("Location: ../index.php");
    exit;
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

if (isset($_POST['userid'])) {
  $user_id = $_POST['userid'];

  $query = "DELETE FROM users WHERE id = ?";

  // Create a new mysqli_stmt object
  $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');
  // Prepare the SQL query
  $stmt = $mysqli->prepare($query);

  // Bind the $user_id variable to the placeholder in the SQL query
  $stmt->bind_param('i', $user_id);

  // Execute the prepared statement
  $stmt->execute();

  // Check if any rows were affected by the query and display a message accordingly
  if ($stmt->affected_rows > 0) {
    echo '<div id="success-alert" role="alert" class="alert alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span>User succesfully deleted!</span>
  </div>';

  echo '<script>
          setTimeout(function() {
            var successAlert = document.getElementById("success-alert");
            successAlert.style.display = "none";
          
          }, 2000);
        </script>';
        } else {
          echo '<div id="alert" role="alert" class="alert alert-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          <span>Warning: Bedrijf not deleted </span>
        </div>';

echo '<script>
          setTimeout(function() {
            var alertElement = document.getElementById("alert");
            alertElement.style.display = "none";
          }, 3000);
        </script>';
  }
}
  ?>
  <script>
    setTimeout(function() {
      // Get the message element by its id
      var message = document.getElementById('message');
      // If the message element exists, hide it by setting its display style to 'none'
      if (message) message.style.display = 'none';
    }, 3000);
  </script>
  <?php


echo '
<div class="flex flex-col gap-8">
';
?>
<form action="/profile/bedrijven-verwijderen.php" class="flex flex-row justify-center gap-4">
  <div class="form-control w-full max-w-xs">
    <input type="text" name="search" placeholder="Search" class="input input-primary input-bordered">
  </div>
  <button class="btn btn-primary">Zoeken</button>
</form>




<?php 
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

// Check if the search term is set in the URL query parameters
if (isset($_GET['search'])) {
  // If set, assign the search term to a variable
  $searchTerm = $_GET['search'];
  // Prepare a SQL statement to select users with a specific function and username containing the search term
  $sql = "SELECT id, username, email, firstname, lastname FROM users WHERE function = 2 AND username LIKE ?";
  // Prepare the statement for execution
  $stmt = $mysqli->prepare($sql);
  // Bind the search term as a parameter to the statement
  $param = "%{$searchTerm}%";
  $stmt->bind_param('s', $param);
} else {
  // If the search term is not set, prepare a SQL statement to select all users with a specific function
  $sql = "SELECT id, username, email, firstname, lastname FROM users WHERE function = 2";
  // Prepare the statement for execution
  $stmt = $mysqli->prepare($sql);
}

?>
<?php
// Execute the statement
$stmt->execute();
// Get the result set from the executed statement
$result = $stmt->get_result();
// Fetch all rows from the result set as an associative array
$users = $result->fetch_all(MYSQLI_ASSOC);
// Check if there are any users to delete
if (count($users) > 0) {
  // Loop through each user and delete them
  foreach ($users as $user) {
    echo "<div class='p-4 border rounded-lg'>";
    echo "<div class='user-info'>";
    echo "<h2 class='text-lg font-bold'>" . $user['username'] . "</h2>";
    echo "<div class='user-details'>";
    echo "<p class='text-gray-600'>Email: " . $user['email'] . "</p>";
    echo "<p class='text-gray-600'>Voornaam: " . $user['firstname'] . "</p>";
    echo "<p class='text-gray-600'>Achternaam: " . $user['lastname'] . "</p>";
    echo "</div>";
    echo "<form action='/profile/bedrijven-verwijderen.php' method='post'>";
    echo "<input type='hidden' name='userid' value='" . $user['id'] . "'>";
    echo "<button class='btn btn-error m-2' type='submit'>Delete</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
} else {
  echo "<p class='ml-6'>Geen bedrijven gevonden</p>";
  ?>
  <a class="ml-6" href="../profile/bedrijven-verwijderen.php" >klik hier om terug te gaan</a>
  <?php
}
?>

</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>


