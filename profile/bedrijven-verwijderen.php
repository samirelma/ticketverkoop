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
    echo "<div id='message'>User deleted</div>";
  } else {
    echo "<div id='message'>User not deleted</div>";
  }
}
  // Hide the message after 3 seconds using JavaScript
  ?>
  <script>
    setTimeout(function() {
      var message = document.getElementById('message');
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

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT id, username, email, firstname, lastname FROM users WHERE function = 2 AND username LIKE ?";
    $stmt = $mysqli->prepare($sql);
    $param = "%{$searchTerm}%";
    $stmt->bind_param('s', $param);
} else {
    $sql = "SELECT id, username, email, firstname, lastname FROM users WHERE function = 2";
    $stmt = $mysqli->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

if (count($users) > 0) {
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
  }
} else {
  echo "<p>Geen gebruikers gevonden</p>";
  ?>
  <a href="../profile/bedrijven-verwijderen.php" >klik hier om terug te gaan</a>
  <?php
}
?>

</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";

?>



