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

    $stmt = $mysqli->prepare("INSERT INTO users (firstname, lastname, email, username, password, function) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $username, $password, $function);

    try {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            header("Location: ../index.php?error=register");
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
  }

  if (!empty($emailExists)) {
    header("Location: /profile/register.php?error=email");

  }

  if (!empty($usernameExists)) {
    header("Location: /profile/register.php?error=username");

  }



  if (empty($emailExists) && empty($usernameExists)) {
    header("Location: ../index.php?error=register");
  
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