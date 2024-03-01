<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if (isset($_POST["knopResetWachtwoord"])) {
    header("Location: passwordReset.php");
}
if (isset($_POST["knop"])) {
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
    if (checkEmail($mysqli, $email)) {
        if (checkWachtwoord($mysqli, $wachtwoord, $email)) {
            $gebruikersid = getGebruikersid($mysqli, $email);
            $_SESSION["gebruikersid"] = $gebruikersid;
            if (controleerAdmin($mysqli, $email)) {
                $_SESSION["user"] = "admin";
            } else if (controleerBedrijf($mysqli, $email)) {
                $_SESSION["user"] = "bedrijf";
            } else if (controleerMember($mysqli, $email)) {
                $_SESSION["user"] = "member";
            }
            header('Location: ../index.php');
        }
    } else {
        header('location: login.php?');
    }
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


 if (!isset($_POST["knop"])) {
    echo '
<div class="card-body">
<div class="card-actions justify-center">
<form  method="post" action="login.php">
<label class="label">email</label>
<input type="text" placeholder="email" class="input input-bordered input-primary w-full max-w-xs" name="email" /> <br>  
<label class="label">wachtwoord</label>
<input type="password" placeholder="wachtwoord" class="input input-bordered input-primary w-full max-w-xs" name="wachtwoord" /><br><br>
<button class="btn text-blue-500" type="submit" name="knop">login</button>
<button class="btn text-blue-500" type="submit" name="knopResetWachtwoord">wachtwoord vergeten</button><br>
</div>
</form>
</div>
<div class="flex justify-center mt-2">
<a href="../profile/register.php" >klik hier om te Registreren </a>
</div>
';
}
    ?>
    </body>

    </html>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>