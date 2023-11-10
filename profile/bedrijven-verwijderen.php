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
if (isset($_POST['productid'])) {
    $product_id = $_POST['productid'];

    $query = "DELETE FROM users WHERE function = ?";
    $deleteData = insert($query, ['type' => 'i', 'value' => $product_id]);
    if ($deleteData) {
        echo "bedrijv deleted";
    } else {
        echo "Something went wrong";
    }
}



?>

<form action="/products/delete" method="get" class="flex flex-row justify-center gap-4">
  <div class="form-control w-full max-w-xs">
    <input type="text" name="search" placeholder="Search" class="input input-primary input-bordered">
  </div>
  <button class="btn btn-primary">Search</button>
</form>


<script>
    // make a function for getting all users
    function getAllUsers() {
        $query = "SELECT * FROM users";
        $users = fetchAll($query);
        return $users;
    }
</script>

<?php

if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  $query = "SELECT * FROM users WHERE MATCH(username, email, firstname, lastname) AGAINST(? IN BOOLEAN MODE)";
  $users = fetchSingle($query, ['type' => 's', 'value' => "$searchTerm*"]);
}
$sql = "SELECT username, email, firstname, lastname FROM users WHERE function = 2";
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

$result = mysqli_query($mysqli, $sql);

echo "<div class='grid grid-cols-4 gap-4'>";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      echo "<div class='p-4 border rounded-lg'>";
      echo "<h2 class='text-lg font-bold'>" . $row['username'] . "</h2>";
      echo "<p class='text-gray-600'>Email: " . $row['email'] . "</p>";
      echo "<p class='text-gray-600'>First Name: " . $row['firstname'] . "</p>";
      echo "<p class='text-gray-600'>Last Name: " . $row['lastname'] . "</p>";
      echo "<button class='btn btn-primary' name='verwijderen'>Delete</button>";

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
?>