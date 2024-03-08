<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if (isset($_POST["knop2"])) {
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
    $confirmedWachtwoord = $_POST["wachtwoord2"];
    if ($wachtwoord === $confirmedWachtwoord) {
        
        updateWachtwoord($mysqli, $email, $wachtwoord);
    }
    if ($wachtwoord != $confirmedWachtwoord) {
        header('Location: passwordReset.php');
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Password Reset</title>
</head>

<body>
    <?php
  if (!isset($_POST["knop2"])) {
    ?>
        <div class="card-body">
            <div class="card-actions justify-center">
                <form method="post" action="passwordReset.php">
                    <label class="label">email</label>
                    <input type="text" placeholder="email" class="input input-bordered input-primary w-full max-w-xs" name="email" /> <br>
                    <label class="label">wachtwoord</label>
                    <input type="password" placeholder="wachtwoord" class="input input-bordered input-primary w-full max-w-xs" name="wachtwoord" /><br>
                    <label class="label">bevestig wachtwoord</label>
                    <input type="password" placeholder="wachtwoord" class="input input-bordered input-primary w-full max-w-xs" name="wachtwoord2" /><br><br>
                    <button class="btn text-blue-500" type="submit" name="knop2">verander wachtwoord</button>
            </div>
            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>