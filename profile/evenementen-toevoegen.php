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

if (isset($_POST['create'])) {
    global $mysqli;

    $naam = $_POST['naam'];
    $datum = $_POST['datum'];
    $aantalTickets = $_POST['aantalTickets'];
    $beschrijving = $_POST['beschrijving'];
    $zaalID = $_POST['zaal'];  // Use 'zaal' instead of 'zaalID'
    $userid = $_POST['userid'];  // Make sure 'userid' is submitted with the form



  $insertData = addEvent(
    $naam,
    $datum,
    $aantalTickets,
    $beschrijving,
    $file,
    $zaalID
  );
}

function addEvent(
  $naam,
  $datum,
  $aantalTickets,
  $beschrijving,
  $file,
  $zaalID
) {
    $query = 'INSERT INTO evenementen (naam, datum, aantalTickets, beschrijving, afbeelding, zaalID) VALUES (?, ?, ?, ?, ?, ?)';  // Add zaalID to the query

    // Use the user ID to query the database
    $sql = "SELECT * FROM users WHERE id = ?";
    $userid = $_SESSION['userid']; // Get the user ID from the session

    // De naam van de afbeelding wordt opgeslagen in de variabele $imageName
    $imageName = $file['name'];

    // De tijdelijke naam van de afbeelding wordt opgeslagen in de variabele $imageTmpName
    $imageTmpName = $file['tmp_name'];

    // Het doelmap wordt gedefinieerd in de variabele $targetDir
    $targetDir = PUBLIC_R . "/images/";

    // De basisnaam van de afbeelding wordt opgeslagen in de variabele $baseImageName
    $baseImageName = basename($imageName, ".png") . ".png";

    // Het doelbestand wordt gedefinieerd in de variabele $targetFile
    $targetFile = $targetDir . $baseImageName;

    // De afbeelding wordt verplaatst van de tijdelijke locatie naar de doelmap
    move_uploaded_file($imageTmpName, $targetFile);
  

    // execute the query
    $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop'); 
    $mysqli = $mysqli;
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();



        // If a file is uploaded, move it to folder img and update the image name
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['fileToUpload'])) {
                $file = $_FILES['fileToUpload'];
                $imageName = $file['name']; // The original name of the uploaded file
                $imageTmpName = $file['tmp_name']; // The temporary location of the uploaded file
                // Move the uploaded file from the temporary location to the img folder
                move_uploaded_file($imageTmpName, $_SERVER['DOCUMENT_ROOT'] . '/img/eventPictures/' . $imageName);
            }
        }
        // Create a new mysqli object to connect to the database
        $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop'); 

        // Prepare the SQL query
        $stmt = $mysqli->prepare($query);

        // Bind the parameters to the prepared statement
        $stmt->bind_param(
        'ssissi',    
        $naam,
        $datum,
        $aantalTickets,
        $beschrijving,
        $imageName,
        $zaalID
        );
        try {
            // Execute the SQL query
            $result = $stmt->execute();
            if ($result) {
                // Redirect to the homepage if the query was successful
                header("Location: ../index.php");
            } else {
                // Print an error message if the query failed
                echo "Something went wrong";
            }
        } catch (mysqli_sql_exception $e) {
            // Print any errors that occurred during the execution of the query
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
            <span class="label-text text-blue-500">Einde datum event</span>
        </label>
        <input type="datetime-local" name="datum" class="input input-bordered w-full" required />
    </div>

    <!-- Number of Tickets -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-blue-500">Aantal tickets</span>
        </label>
        <input type="number" name="aantalTickets" placeholder="100" class="input input-bordered w-full" required />
    </div>

    <!-- Description -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-blue-500">beschrijving</span>
        </label>
        <textarea name="beschrijving" class="textarea textarea-bordered min-h-[8em]" placeholder="Event Description" required></textarea>
    </div>

    <!-- Image -->
    <div class="form-control w-full">
    <label class="label">
      <span class="label-text text-blue-500">Foto</span>
    </label>
    <input type="file" name="fileToUpload" id="fileToUpload">
  </div>

  <?php
// Connect to the database
$mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');

// Prepare the SQL query
$stmt = $mysqli->prepare("SELECT zaalID, naam FROM tblzalen");

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Start the select element
echo "<select name='zaal'>";

// Loop through the result and create the option elements
while ($row = $result->fetch_assoc()) {
    echo "<option name='zaalID' value='" . $row['zaalID'] . "'>" . $row['naam'] . "</option>";
}

// End the select element
echo "</select>";
?>



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