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



  // Check if passwords match
  if (!($password !== $passwordConfirm)) {
    register($_POST);

    $password = password_hash($password, PASSWORD_ARGON2ID);

    $mysqli = new mysqli('localhost', 'samirelmazzoujisql1', 'jwVhocruvE', 'samirelmazzoujisql1');
    $stmt = $mysqli->prepare("INSERT INTO users (firstname, lastname, email, username, password, function) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $username, $password, $function);

    try {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            header("Location: ../index.php");
        } else {
            echo "Something went wrong";
        }
    } catch (mysqli_sql_exception $e) {
        echo "";
    }
  } else {
    echo '<div id="alert" role="alert" class="alert alert-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
          <span>Warning: password not the same please try again!</span>
        </div>';
    echo '<script>
          setTimeout(function() {
            var alertElement = document.getElementById("alert");
            alertElement.style.display = "none";
          }, 3000);
        </script>';

    // The setTimeout function is used to delay the execution of a function.
    // In this case, it delays the execution of the function by 3000 milliseconds (3 seconds).
    // The following line retrieves the HTML element with the id "success-alert".
    // The style.display property is used to control the visibility of an element.
    // In this case, it sets the display property of the successAlert element to "none",
    // which means the element will be hidden from view.

  }
} else {
  include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

  // This block of code will always be executed, regardless of whether an exception occurred or not
  // It includes the closing curly brace for the try block
  // It also includes the code to include the navbar.php file if the 'register' POST parameter is not set
}

function register($data)
{

  $username = $data['username'];
  $lastname = $data['lastname'];
  $firstname = $data['firstname'];
  $email = $data['email'];
  $password = $data['password'];
  $passwordConfirm = $data['passwordConfirm'];



  $emailExists = fetchSingle('SELECT * FROM users WHERE email = ?', [
    'type' => 's',
    'value' => $email,
  ]);

  $usernameExists = fetchSingle('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);
  if (!empty($emailExists) && !empty($usernameExists)) {
    echo '<div id="alert" role="alert" class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Both username and email are already in use, please choose another one.</span>
          </div>';

    echo '<script>
            setTimeout(function() {
              var alertElement = document.getElementById("alert");
              alertElement.style.display = "none";
            }, 5000);
          </script>';
 
    // This code returns the boolean value `false`
    //the return statement is used to exit a function and return a value to the caller. In this case, the value being returned is false.

    return false;
  }

  if (!empty($emailExists)) {
    echo '<div id="alert" role="alert" class="alert alert-warning">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              <span>Warning: email address already in use! please choose another one.</span>
            </div>';

    echo '<script>
              setTimeout(function() {
                var alertElement = document.getElementById("alert");
                alertElement.style.display = "none";
              }, 3000);
            </script>';
    // This code returns the boolean value `false`
    //the return statement is used to exit a function and return a value to the caller. In this case, the value being returned is false.
    return false;
  }

  if (!empty($usernameExists)) {
    echo '<div id="alert" role="alert" class="alert alert-warning">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              <span>Warning: username already exists. Please use another one.</span>
            </div>';

    echo '<script>
              setTimeout(function() {
                var alertElement = document.getElementById("alert");
                alertElement.style.display = "none";
              }, 3000);
            </script>';
    return false;
  }



  if (empty($emailExists) && empty($usernameExists)) {
    echo '<div id="success-alert" role="alert" class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>You successfully registered!</span>
          </div>';

    echo '<script>
            setTimeout(function() {
              var successAlert = document.getElementById("success-alert");
              successAlert.style.display = "none";
            }, 2000);
          </script>';
    // The setTimeout function is used to delay the execution of a function.
    // In this case, it delays the execution of the function by 2000 milliseconds (2 seconds).
    // The following line retrieves the HTML element with the id "success-alert".
    // The style.display property is used to control the visibility of an element.
    // In this case, it sets the display property of the successAlert element to "none",
    // which means the element will be hidden from view.

    return true;
  } else {
    return false;
  }
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