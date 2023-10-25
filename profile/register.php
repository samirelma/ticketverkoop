<?php

include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
include $_SERVER['DOCUMENT_ROOT'] . "/hashing/hash.php";
include $_SERVER['DOCUMENT_ROOT'] . "/front-end/register.php";

function register($data) {
  var_dump($data);
  exit;
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
    echo "Email already exists";
    echo "<br>";
    echo "<a href='/profile/register.php'>Go back</a>";
    exit;
  }

  $data = fetchSingle('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);

  if ($data) {
    echo "Username already exists";
    echo "<br>";
    echo "<a href='/profile/register.php'>Go back</a>";
    exit;
  }

  $initialized = insertUser($username, hashPassword($password), $email, $firstname, $lastname);

  if ($initialized) {
    echo "You have successfully registered!";
    echo "<br>";
    echo "<a href='/profile/login.php'>Go back</a>";
    exit;
  } else {
    echo "Something went wrong";
  }
      // Check if passwords match
      if ($password !== $passwordConfirm) {
        echo "Password does not match";
        echo "<br>";
        echo "<a href='/profile/register.php'>Go back</a>";
        exit;
    }
}
if (isset($_POST['register'])) {
  register($_POST);
}
function insertUser($username, $password, $email, $firstname, $lastname) {
  global $connect;
  $userData = insert(
    'INSERT INTO users (username, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)',
    ['type' => 's', 'value' => $username],
    ['type' => 's', 'value' => $password],
    ['type' => 's', 'value' => $email],
    ['type' => 's', 'value' => $firstname],
    ['type' => 's', 'value' => $lastname],
  );


  $connect = new mysqli('localhost', 'root', '', 'dbticketverkoop');


  $userProfileData = insert(
    'INSERT INTO user_profile (userid, profilePictureUrl, about) VALUES (?, ?, ?)',
    ['type' => 'i', 'value' => '$userId'],
    [
        'type' => 's',
        'value' => 'https://avatars.githubusercontent.com/u/64209400?v=4',
    ],
    ['type' => 's', 'value' => 'test!']
  );

  try {
    // Execute the SQL query
    $result = mysqli_query($connect, $userData);
    if ($result) {
      header("Location: ../index.php");
    } else {
      echo "Something went wrong";
    }
  } catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
  }

  try {
    // Execute the SQL query
    $result = mysqli_query($connect, $userProfileData);
    if (!$result) {
      echo "Something went wrong";
    }
  } catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
  }

  return $userData && $userProfileData;
}

function hashPassword($password) {
  return password_hash($password, PASSWORD_DEFAULT);
}
