

<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";  

global $connect;
function register($formData) {

  $firstname = $formData['firstname'];
  $lastname = $formData['lastname'];
  $email = $formData['email'];
  $username = $formData['username'];
  $password = $formData['password'];
  $passwordConfirm = $formData['passwordConfirm'];



  $data = fetchSingle('SELECT * FROM users WHERE firstname = ?', [
    'type' => 's',
    'value' => $firstname,
  ]);


  $data = fetchSingle('SELECT * FROM users WHERE lastname = ?', [
    'type' => 's',
    'value' => $lastname,
  ]);


  $data = fetchSingle('SELECT * FROM users WHERE email = ?', [
    'type' => 's',
    'value' => $email,
  ]);

  if ($data) {
    return [
      'status' => 'error',
      'message' => 'This email is already taken',
    ];
  }


$data = fetchSingle('SELECT * FROM users WHERE username = ?', [
  'type' => 's',
  'value' => $username,
]);



$data = fetchSingle('SELECT * FROM users WHERE password = ?', [
  'type' => 's',
  'value' => $password,
]);

$data = fetchSingle('SELECT * FROM users WHERE passwordConfirm = ?', [
  'type' => 's',
  'value' => $passwordConfirm,
]);

//check if passwords match if it does not match return password does not match
if ($password !== $passwordConfirm) {
  return [
    'message' => 'Password does not match',
  ];
}

//hash password
function hashPassword($password) {
  return password_hash($password, PASSWORD_DEFAULT);

}
}



//insert the data into the database
if (isset($_POST['register'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];


  $sql = "SELECT * FROM users WHERE email='$email'";
  $mysqli = new mysqli('localhost', 'root', '', 'dbticketverkoop');
  $result = mysqli_query($mysqli, $sql);
  
  if (mysqli_num_rows($result) > 0) {
      echo 'This email is already taken';
  } else {
      // Define the SQL query
      $sql = "INSERT INTO users (firstname, lastname, email, username, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";
  
      try {
          // Execute the SQL query
          $result = mysqli_query($mysqli, $sql);
          if ($result) {
              header("Location: ../index.php");
          } else {
              echo "Something went wrong";
          }
      } catch (mysqli_sql_exception $e) {
          if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
              echo 'This email is already taken';
          } else {
              // handle other exceptions
          }
      }
  }
}





  ?>
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

    <button name="register" class="btn btn-primary">Register</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link" href="../account/index">I already have an account</a>
  </div>
</div>
  </center>