<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if(isset($_POST["overdragen"])) {
    $ticketid = $_POST["ticketID"]; 
    $userid = $_SESSION["gebruikersid"];
    $overdraagEmail = $_POST["acountEmail"]; 
    $evenementID = $_POST["evenementID"];
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $overdraagEmail);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    ($resultaat->num_rows == 0) ? false : $resultaat;
    foreach ($resultaat as $overdraagID); 
    $stmt = $mysqli->prepare("INSERT INTO tbloverdraagnotifications (overdragerID, ontvangerID, evenementID, ticketID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $userid, $overdraagID["id"], $evenementID, $ticketid);
    $stmt->execute();
    header("Location: ../profile/mijnTickets.php");
} else {
    $ticketid = $_GET["ticketID"]; 
    $evenementID = $_GET["evenementID"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ticket overdragen</title>
</head>
<body>
    <form method="post", action="ticketOverdragen.php">
    <input type="hidden" name="ticketID" value="<?php echo $ticketid?>"/>
    <input type="hidden" name="evenementID" value="<?php echo $evenementID ?>"/>
    <input type="text" placeholder="email" class="input w-full max-w-xs" name="acountEmail"/>
    <button name="overdragen" class="btn btn-primary">Overdragen</button>
    </form>
</body>
</html>
<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>