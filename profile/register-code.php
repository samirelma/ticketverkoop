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


//insert the data into the database
if (isset($_POST['register'])) {
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

    $stmt = $mysqli->prepare("INSERT INTO users (firstname, lastname, email, username, password, function, profilePicture) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $firstname, $lastname, $email, $username, $password, $function, $profilePicture);

    $profilePicture = "no_profile_picture.jpg";

    try {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            header("Location: ../index.php?success=register");
        } else {
            echo "Something went wrong";
        }
    } catch (mysqli_sql_exception $e) {
        echo "";
    }
  } else {
    header("Location: /profile/register.php?error=password");
  }
} else {

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
    header("Location: /profile/register.php?error=both");
    return false;
  }

  if (!empty($emailExists)) {
    header("Location: /profile/register.php?error=email");
    return false;

  }

  if (!empty($usernameExists)) {
    header("Location: /profile/register.php?error=username");
    return false;
  }



  if (empty($emailExists) && empty($usernameExists)) {
    header("Location: ../index.php?success=register");

    return true;
  } else {
    return false;
  }
}

?>