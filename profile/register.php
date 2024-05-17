<?php
//include navbar
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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