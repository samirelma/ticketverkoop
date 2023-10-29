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
if (isset($_POST["knop"])){

} else {
echo '
<form method="post" action="login.php">
<label class="label">gebruikersnaam</label>
<input type="text" placeholder="gebruikersnaam" class="input input-bordered input-primary w-full max-w-xs" name="gebruikersnaam" /> <br>  
<label class="label">wachtwoord</label>
<input type="password" placeholder="wachtwoord" class="input input-bordered input-primary w-full max-w-xs" name="wachtwoord" /><br>
<button class="btn" type="submit" name="knop">login</button><br>
</form>


<a href="../profile/register.php" >als je nog geen account hebt, <br> klik hier om te Registreren </a>
';
}
?>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>