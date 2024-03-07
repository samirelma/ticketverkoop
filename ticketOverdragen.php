<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if(isset($_POST["overdragen"])) {
    $ticketid = $_POST["ticketID"]; 
    $userid = $_SESSION["gebruikersid"];
    $overdraagID = $_POST["acountID"]; 
    $sql = ("INSERT INTO tbloverdraagnotifications (overdragerID, ontvangerID, ticketID) VALUES (".$userid.",".$overdraagID.",".$ticketid.")"); 
    $mysqli -> query($sql); 
    header("Location: ../profile/mijnTickets.php");
} else {
    $ticketid = $_GET["ticketID"]; 
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
    <input type="text" placeholder="accountId" class="input w-full max-w-xs" name="acountID"/>
    <button name="overdragen" class="btn btn-primary">Overdragen</button>
    </form>
</body>
</html>
<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>