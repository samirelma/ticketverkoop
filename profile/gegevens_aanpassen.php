<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>

<?php

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

// Fetch the current user's data
$query = 'SELECT * FROM users WHERE username = ?';
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $_SESSION['id']); // 's' stands for string
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
echo 'id: ' . $_SESSION['id'];
echo'<br>';


if (isset($_SESSION['id'])) {
    echo 'id: ' . $_SESSION['id'];
} else {
    echo 'id is not set.';
}
echo'<br>';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'])) {
        $query = 'UPDATE users SET username = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssi', $_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_SESSION['id']);

        if ($stmt->execute()) {
            // Fetch the updated data
            $query = 'SELECT * FROM users WHERE id = ?';
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $_SESSION['id']);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result) {
                    $updatedData = $result->fetch_assoc();
                    if ($updatedData) {
                        // rest of your code
                    } else {
                        echo 'No id found with the given id.';
                    }
                } else {
                    echo 'Failed to execute query. Error: ' . $stmt->error;
                }
            } else {
                echo 'Failed to bind parameters. Error: ' . $stmt->error;
            }
        }
    }
}
?>

<!-- Your HTML code here -->


<body>
    <center>
        <h1 class="md:text-center text-4xl font-bold mb-8">Wijzig account</h1>
        <form action="/profile/gegevens_aanpassen.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Firstname</span>
                        </label>
                        <input type="text" name="firstname" value="<?php echo isset($data['firstname']) ? $data['firstname'] : ''; ?>" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Lastname</span>
                        </label>
                        <input type="text" name="lastname" value="<?php echo isset($data['lastname']) ? $data['lastname'] : ''; ?>" class="input input-bordered w-full" required />
                    </div>
                </div>

                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" class="input input-bordered w-full" required />
                    </div>
                </div>
                <button name="wijzig" class="btn btn-primary">Wijzig gegevens</button>
        </form>
    </center>
</body>

</html>


</div>
</center>



</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>