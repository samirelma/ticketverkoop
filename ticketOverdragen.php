<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
$ticketid = $_GET["ticketID"]; 
if(isset($_POST["overdragen"])) {

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ticket overdragen</title>
</head>
<body>
    <form method="$_POST", action="ticketOverdragen.php">
    <input type="hidden" name="ticketID" value="<?php echo $ticketid?>"/>
    <input type="text" placeholder="account id" class="input w-full max-w-xs" name="acountID"/>
    <button name="overdragen" class="btn btn-primary">Overdragen</button>
    </form>
</body>
</html>
<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>