<?php
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
    error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);

    try {
        // Execute the SQL query
        $result = $stmt->execute();
        if ($result) {
        } else {
            // Print an error message if the query failed
            echo "Something went wrong";
        }
    } catch (mysqli_sql_exception $e) {
        // Print any errors that occurred during the execution of the query
        echo $e->getMessage();
    }

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
        $query = 'INSERT INTO evenementen (naam, datum, aantalTickets, beschrijving, afbeelding, zaalID, userID, weergeven) VALUES (?, ?, ?, ?, ?, ?, ' . $_SESSION["gebruikersid"] . ', 1)';  // Add zaalID to the query

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
        include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";

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
                // Print a success message if the query succeeded
                //show the alert on every page

                //redirect to the homepage after showing the alert
                header("Location: /index.php?alert=evenementtoegevoegd");
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