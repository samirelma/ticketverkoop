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
$email = $_POST["email"];
$wachtwoord = $_POST["wachtwoord"]; 
if (checkEmail($connect, $email)) {
    if (checkWachtwoord($connect,$wachtwoord,$email)) {
        $gebruikersid = getGebruikersid($connect, $email); 
        $_SESSION["gebruikersid"] = $gebruikersid; 
        if(controleerAdmin($connect,$email)){
            $_SESSION["user"] = "admin";
            var_dump(controleerAdmin($connect,$email));
         } else if(controleerBedrijf($connect,$email)) {
            $_SESSION["user"] = "bedrijf"; 
         } else if(controleerMember($connect,$email)) {
            $_SESSION["user"] = "member";
         }
         header('Location: ../index.php');
     } else {
        
     }
 } else {
 header('location: login.php?error');
 }
} else {
echo '
<form method="post" action="login.php">
<label class="label">email</label>
<input type="text" placeholder="email" class="input input-bordered input-primary w-full max-w-xs" name="email" /> <br>  
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