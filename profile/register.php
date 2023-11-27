<?php

//insert the data into the database
if (isset($_POST['register'])) {
  include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
  global $mysqli;
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];
  $function = $_POST['function'];
  var_dump($function);



  // Check if passwords match
  if ($password !== $passwordConfirm) {
    echo "Password does not match";
    echo "<br>";
    echo "<a href='/profile/register.php'>Go back</a>";
    exit;
  }
  $password = password_hash($password, PASSWORD_ARGON2ID);


  register($_POST);


  // Define the SQL query
  $sql = "INSERT INTO users (firstname, lastname, email, username, password, function) VALUES ('$firstname', '$lastname', '$email', '$username', '$password','$function')";





  $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');
  try {
    // Execute the SQL query
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
      header("Location: ../index.php");
    } else {
      echo "Something went wrong";
    }
  } catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
  }
} else {
  include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
}


function register($data)
{

  $username = $data['username'];
  $lastname = $data['lastname'];
  $firstname = $data['firstname'];
  $email = $data['email'];
  $password = $data['password'];
  $passwordConfirm = $data['passwordConfirm'];


  $data = fetchSingle('SELECT * FROM users WHERE email = ?', [
    'type' => 's',
    'value' => $email,
  ]);

  if (!empty($data)) {
    echo "mail does already exist please choose another one";
    echo "<br>";
    echo "<a href='/profile/register.php'>Go back</a>";
    exit;
  }




  $data = fetchSingle('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);

  if (!empty($data)) {
    echo "username already exists please choose another one";
    echo "<br>";
    echo "<a href='/profile/register.php'>Go back</a>";
    exit;
  }

  // use function register($data) to check if the username and email already exist in the database



  echo "You successfully registered!";
  echo "<br>";
  echo "<a href='/profile/login.php'>Go back</a>";
  return true;
}





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

    <h1 class="md:text-center text-4xl font-bold mb-8">Create a new account</h1>
    <form action="/profile/register.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
      <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-4 md:flex-row">
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text">Firstname</span>
            </label>
            <input type="text" name="firstname" placeholder="John" class="input input-bordered w-full" required />
          </div>

          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text">Lastname</span>
            </label>
            <input type="text" name="lastname" placeholder="Doe" class="input input-bordered w-full" required />
          </div>
        </div>

        <div class="flex flex-col gap-4 md:flex-row">
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" placeholder="john.doe@gmail.com" class="input input-bordered w-full" required />
          </div>

          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text">Username</span>
            </label>
            <input type="text" name="username" placeholder="john.doe" class="input input-bordered w-full" required />
          </div>
        </div>

        <div class="flex flex-col gap-4 md:flex-row">
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full" required />
          </div>

          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text">Confirm password</span>
            </label>
            <input type="password" name="passwordConfirm" placeholder="Confirm password" class="input input-bordered w-full" required />
          </div>
        </div>
      </div>

      <div class="flex flex-col gap-4 md:flex-row">
          <div class="form-control md:flex-1">
      <label class="label">
              <span class="label-text">functie</span>
            </label>
            <select class="select select-primary w-full max-w-xs" name="function">
            <value>wat is uw functie</value>
            <option value="1" id="function">Gebruiker</option>
            <option value="2" id="function">Bedrijf</option>
            </select>
          </div>
      </div>
      <button name="register" class="btn btn-primary">Register</button>
    </form>

    <div class="w-full text-center mt-8">
      <a class="link" href="../profile/login.php">I already have an account</a>
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