<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
define('PUBLIC_R', '/path/to/your/directory');
//make it sp if u arent logged in u cant get to this page and if u arent admin or bedrijf u cant get to this page
if (!isset($_SESSION['user'])) {
    header("Location: /profile/login.php");
    exit;
}
if ($_SESSION['user'] != 'admin' && $_SESSION["user"] != "bedrijf") {
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
//naam datum aantalTickets beschrijving afbeelding
if (isset($_POST['create'])) {
    global $connect;

  $naam = $_POST['naam'];
  $datum = $_POST['datum'];
  $aantalTickets = $_POST['aantalTickets'];
  $beschrijving = $_POST['beschrijving'];
  $file = $_FILES['afbeelding'];

  $insertData = addEvent(
    $naam,
    $datum,
    $aantalTickets,
    $beschrijving,
    $file
  );
}



function addEvent(
  $naam,
  $datum,
  $aantalTickets,
  $beschrijving,
  $file
) {
    $query = 'INSERT INTO evenementen (naam, datum, aantalTickets, beschrijving, afbeelding) VALUES (?, ?, ?, ?, ?)';

    // execute the query
    

    // Set the image name to the uploaded file name or to 'default.png' if no file is uploaded
    $imageName = isset($file['afbeelding']) ? $file['afbeelding'] : 'default.png';

    // Set the temporary image name to the uploaded file's temporary name or to null if no file is uploaded
    $imageTmpName = isset($file['tmp_name']) ? $file['tmp_name'] : null;

    // If a file is uploaded, move it to the public downloads directory and update the image name
    if ($imageTmpName) {
        $targetDir = PUBLIC_R . "/Downloads/";
        $baseImageName = basename($imageName, ".png") . ".png";
        $targetFile = $targetDir . $baseImageName;
        move_uploaded_file($imageTmpName, $targetFile);
    } else {
        // Use a default image if no image is uploaded
        $imageName = 'default.png';
    }

    // Create a new mysqli object to connect to the database
    $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop'); 

    // Prepare the SQL query
    $stmt = $mysqli->prepare($query);

    // Bind the parameters to the prepared statement
    $stmt->bind_param(
        'ssiss',    
        $naam,
        $datum,
        $aantalTickets,
        $beschrijving,
        $imageName
    );

        try {
            // Execute the SQL query
            $result = $stmt->execute();
            if ($result) {
                header("Location: ../index.php");
            } else {
                echo "Something went wrong";
            }
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
           
}
?>



<h1 class="text-center text-4xl font-bold mb-12 text-blue-500">Maak een nieuwe evenement</h1>

<form action="/profile/evenementen-toevoegen.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-4 max-w-2xl mx-auto">
    <!-- Name -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-blue-500">Naam</span>
        </label>
        <input type="text" name="naam" placeholder="Event Name" class="input input-bordered w-full" required />
    </div>

    <!-- Date -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-green-500">Einde datum event</span>
        </label>
        <input type="date" name="datum" class="input input-bordered w-full" required />
    </div>

    <!-- Number of Tickets -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-yellow-500">Aantal tickets</span>
        </label>
        <input type="number" name="aantalTickets" placeholder="100" class="input input-bordered w-full" required />
    </div>

    <!-- Description -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-red-500">beschrijving</span>
        </label>
        <textarea name="beschrijving" class="textarea textarea-bordered min-h-[8em]" placeholder="Event Description" required></textarea>
    </div>

    <!-- Image -->
    <div class="form-control w-full">
    <label class="label">
      <span class="label-text text-purple-500">Foto</span>
    </label>
    <input type="file" name="fileToUpload" id="fileToUpload">
  </div>


    <div class="form-control w-full max-w-xs mt-4">
        <button name="create" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">Create</button>
    </div>
    
    <br>
</form>
</form> 
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>