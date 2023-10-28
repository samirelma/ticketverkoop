<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";


function register($data) {

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

  if ($data) {
    echo "mail does not match";
    echo "<br>";
    echo "<a href='/profile/register.php'>Go back</a>";
    exit;
  }
  
  $data = fetchSingle('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);
  
  if ($data) {
    echo "username does not work";
        echo "<br>";
        echo "<a href='/profile/register.php'>Go back</a>";
        exit;
  }
  

  
  echo "You successfully registered!";
  echo "<br>";
  echo "<a href='/profile/login.php'>Go back</a>";
  exit;


}



//insert the data into the database
if (isset($_POST['register'])) {
  global $connect;
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];

    // Check if passwords match
    if ($password !== $passwordConfirm) {
      echo "Password does not match";
      echo "<br>";
      echo "<a href='/profile/register.php'>Go back</a>";
      exit;
  }
  $password = password_hash($password, PASSWORD_ARGON2ID);
  $passwordConfirm = password_hash($passwordConfirm, PASSWORD_ARGON2ID);

   
// insert userprofile data  

  $userId = mysqli_insert_id($connect);

  // Define the SQL query
  $sql = "INSERT INTO users (firstname, lastname, email, username, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";

  // Execute the SQL query
  $result = mysqli_query($connect, $sql);

  if ($result) {
    // Get the ID of the last inserted row
    $userId = mysqli_insert_id($connect);

    // Define the user profile data query
    $userProfileData = "INSERT INTO user_profile (userid, profilePictureUrl, about) VALUES ('$userId', 'https://avatars.githubusercontent.com/u/64209400?v=4', 'test!')";

    // Execute the user profile data query
    $result = mysqli_query($connect, $userProfileData);

    if ($result) {
      header("Location: ../index.php");
    } else {
      echo "Something went wrong";
    }
  } else {
    echo "Something went wrong";
  }

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
  
