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
<label class="label">gebruikersnaam</label>
<input type="text" placeholder="gebruikersnaam" class="input input-bordered input-primary w-full max-w-xs" /> <br>  
<label class="label">wachtwoord</label>
<input type="password" placeholder="wachtwoord" class="input input-bordered input-primary w-full max-w-xs" /><br>



<a href="../profile/register.php">registreren</a>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>