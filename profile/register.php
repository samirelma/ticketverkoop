<?php
//include navbar
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

?>


<?php
//show error message form ?error=password
if (isset($_GET['error'])) {
    if ($_GET['error'] == "password") {
      echo '<div id="alert" role="alert" class="alert alert-warning">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
      <span>Warning: password not the same please try again!</span>
    </div>';
echo '<script>
      setTimeout(function() {
        var alertElement = document.getElementById("alert");
        alertElement.style.display = "none";
      }, 3000);
    </script>';    }
}

//show error message form ?error=both
if (isset($_GET['error'])) {
    if ($_GET['error'] == "both") {
      echo '<div id="alert" role="alert" class="alert alert-warning">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
      <span>Warning: email address and username already in use! please choose another one.</span>
    </div>';
echo '<script>
      setTimeout(function() {
        var alertElement = document.getElementById("alert");
        alertElement.style.display = "none";
      }, 3000);
    </script>';    }  
}
//show error message form ?error=email
if (isset($_GET['error'])) {
    if ($_GET['error'] == "email") {
      echo '<div id="alert" role="alert" class="alert alert-warning">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
      <span>Warning: email address already in use! please choose another one.</span>
    </div>';
echo '<script>
      setTimeout(function() {
        var alertElement = document.getElementById("alert");
        alertElement.style.display = "none";
      }, 3000);
    </script>';    }
}
//show error message form ?error=username
if (isset($_GET['error'])) {
    if ($_GET['error'] == "username") {
      echo '<div id="alert" role="alert" class="alert alert-warning">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
      <span>Warning: username already in use! please choose another one.</span>
    </div>';
echo '<script>
      setTimeout(function() {
        var alertElement = document.getElementById("alert");
        alertElement.style.display = "none";
      }, 3000);
    </script>';    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>

  <center>

    <h1 class="md:text-center text-4xl font-bold mb-8">Maak een nieuw account aan</h1>
    <form action="/profile/register-code.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
      <div class="flex flex-col gap-4">
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Voornaam</span>
        </label>
        <input type="text" name="firstname" placeholder="John" class="input input-bordered w-full" required />
        </div>

        <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Achternaam</span>
        </label>
        <input type="text" name="lastname" placeholder="Doe" class="input input-bordered w-full" required />
        </div>
      </div>

      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">E-mail</span>
        </label>
        <input type="email" name="email" placeholder="john.doe@gmail.com" class="input input-bordered w-full" required />
        </div>

        <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Gebruikersnaam</span>
        </label>
        <input type="text" name="username" placeholder="john.doe" class="input input-bordered w-full" required />
        </div>
      </div>

      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Wachtwoord</span>
        </label>
        <input type="password" name="password" placeholder="Wachtwoord" class="input input-bordered w-full" required />
        </div>

        <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Bevestig wachtwoord</span>
        </label>
        <input type="password" name="passwordConfirm" placeholder="Bevestig wachtwoord" class="input input-bordered w-full" required />
        </div>
      </div>
      </div>

      <div class="flex flex-col gap-4 md:flex-row">
      <div class="form-control md:flex-1">
        <label class="label">
        <span class="label-text">Functie</span>
        </label>
        <select class="select select-pri  mary w-full max-w-xs" name="function">
        <value>Wat is uw functie</value>
        <option value="1" id="function">Gebruiker</option>
        <option value="2" id="function">Bedrijf</option>
        </select>
      </div>
      </div>
      <button name="register" class="btn btn-primary">Registreren</button>
    </form>

    <div class="w-full text-center mt-8">
      <a class="link" href="../profile/login.php">Ik heb al een account</a>
    </div>
    </div>

</body>

</html>


</div>
</center>

</body>

</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>