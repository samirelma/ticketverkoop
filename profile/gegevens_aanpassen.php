<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Profiel</title>
</head>

<?php
// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

// Fetch the current user's data
$query = 'SELECT * FROM users WHERE id = ?';
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $_SESSION["gebruikersid"]);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();



// If the user clicked the submit button...
if (isset($_POST['wijzig'])) {
    // Update the record
    $query = 'UPDATE users SET firstname = ?, lastname = ?, email = ?, username = ? WHERE id = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssssi', $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_SESSION["gebruikersid"]);
    $stmt->execute();


    // Redirect to this page
    header('Location: /profile/gegevens_aanpassen.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the file upload
    if (isset($_FILES['fileToUpload'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/img/accountPictures/";

        $filename = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $filename;

        // Check if the target directory exists and is writable
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Update the user's profile picture in the database
            $query = 'UPDATE users SET profilePicture = ? WHERE id = ?';
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('si', $filename, $_SESSION["gebruikersid"]);
            $stmt->execute();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}



?>

<!-- Your HTML code here -->


<body>
    <center>
        <h1 class="md:text-center text-4xl font-bold mb-8">Wijzig account</h1>
<form action="/profile/gegevens_aanpassen.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl" enctype="multipart/form-data">            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Firstname</span>
                        </label>
                        <input type="text" name="firstname" value="<?php echo ($data['firstname']) ?>" class="input input-bordered w-full" required />

                    </div>

                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Lastname</span>
                        </label>
                        <input type="text" name="lastname" value="<?php echo ($data['lastname']) ?>" class="input input-bordered w-full" required />
                    </div>
                </div>

                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" value="<?php echo ($data['email']) ?>" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control md:flex-1">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" value="<?php echo ($data['username']) ?>" class="input input-bordered w-full" required />
                    </div>
                </div>
                <!-- Image -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-blue-500">Foto</span>
                    </label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <button name="wijzig" class="btn btn-primary">Wijzig gegevens</button>
        </form>
        <br>
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