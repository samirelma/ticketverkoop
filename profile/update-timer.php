<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<?php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if id and datum are set
        if (isset($_POST['id'], $_POST['datum'])) {
            $id = $_POST['id'];
            $datum = $_POST['datum'];
    
            // Convert the submitted date to a DateTime object
            $submittedDate = new DateTime($datum);
    
            // Get the current date
            $currentDate = new DateTime();
    
            // Compare the submitted date with the current date
            if ($submittedDate < $currentDate) {
                echo '<div class="bg-red-200 text-red-800 p-4 mb-4">The date cannot be in the past.</div>';
                echo '<br>';
                echo '<a href="/profile/tijd-aanpassen.php" class="btn btn-primary">Back</a>';
                exit; // Stop the execution
                
            }
    
            // Connect to the database
            include $_SERVER['DOCUMENT_ROOT'] . "/components/connection.php";
    
            // Check the connection
            if ($mysqli->connect_error) {
                die('Connection failed: ' . $mysqli->connect_error);
            }
    
            // Prepare the SQL statement
            $stmt = $mysqli->prepare('UPDATE evenementen SET datum = ? WHERE evenementID = ?');
    
            // Bind the parameters
            $stmt->bind_param('si', $datum, $id);
    
            // Execute the statement
            if ($stmt->execute()) {
                echo '<div class="bg-green-200 text-green-800 p-4 mb-4">Event time updated successfully.</div>';
                echo '<br>';
                echo '<a href="/profile/tijd-aanpassen.php" class="btn btn-primary">Back</a>';
            } else {
                echo '<div class="bg-red-200 text-red-800 p-4 mb-4">Failed to update event time. Error: ' . $stmt->error . '</div>';
            }
            
    
            // Close the statement
            $stmt->close();
    
            // Close the connection
            $mysqli->close();
        }
    }
    ?>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>