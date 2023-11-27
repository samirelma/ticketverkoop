<?php

function getUserDataByUsername($username) {
    $conn = mysqli_init();
    $conn->real_connect("127.0.0.1", "root", "", "dbticketverkoop");
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM users where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return False;
}

function getProductById($id) {
    $conn = mysqli_init();
    $conn->real_connect("127.0.0.1", "root", "", "dbticketverkoop");
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM tickets where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return False;
}

function getProducts() {
    $conn = mysqli_init();
    $conn->real_connect("127.0.0.1", "root", "", "dbticketverkoop");
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM tickets";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->free_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $products = [];
        while ($row = $result->fetch_assoc())
        {
            $products[] = $row;
        }
        return $products;
    }
    return False;
}

function getProductsByCategory($category) {
    $conn = mysqli_init();
    $conn->real_connect("");
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM tickets where category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->free_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $products = [];
        while ($row = $result->fetch_assoc())
        {
            $products[] = $row;
        }
        return $products;
    }
    return False;
}

function checkEmail($mysqli, $email) {
    $resultaat = $mysqli -> query("SELECT * FROM users WHERE email = '". $email ."'"); 
    return ($resultaat -> num_rows == 0) ? false : true; 
}

function checkWachtwoord($mysqli,$wachtwoord, $email){
    $resultaat = $mysqli->query("SELECT * FROM users WHERE email = '".$email."'");
    return (password_verify($wachtwoord,$resultaat->fetch_assoc()['password']))?true:false;
}

function getGebruikersid($mysqli, $email) {
    $resultaat = $mysqli->query("SELECT * FROM users where email = '".$email."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['id'];   
}
function controleerAdmin($mysqli,$email){
    $result = $mysqli->query("SELECT id FROM user_roles WHERE name= 'admin'");
    $functie = $result ->fetch_assoc()['id'];
    $resultaat = $mysqli->query("SELECT * FROM users where email = '".$email."' and function=".$functie);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function controleerBedrijf($mysqli,$email){
    $result = $mysqli->query("SELECT id FROM user_roles WHERE name= 'bedrijf'");
    $functie = $result ->fetch_assoc()['id'];
    $resultaat = $mysqli->query("SELECT * FROM users where email = '".$email."' and function=".$functie);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function controleerMember($mysqli,$email){
    $result = $mysqli->query("SELECT id FROM user_roles WHERE name= 'member'");
    $functie = $result ->fetch_assoc()['id'];
    $resultaat = $mysqli->query("SELECT * FROM users where email = '".$email."' and function=".$functie);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}

function updateWachtwoord($mysqli, $email, $wachtwoord) {
    $email2 = $mysqli->query("SELECT email FROM users WHERE email = '".$email."'");
    $email2 = $email2->fetch_assoc()['email'];
    if ($email2 != null) {
        if ($email2 === $email) {
            $wachtwoord = password_hash($wachtwoord, PASSWORD_ARGON2ID);
            $resultaat = $mysqli->query("UPDATE users SET password= '".$wachtwoord."' WHERE email='".$email."'");
               header("Location: ../profile/login.php"); 


        } else {
              header("Locations: passwordReset.php"); 
        }   
    } else {
        header("Location: passwordReset.php");
    }
  
}