
<?php
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

function getTicketsByUser($mysqli, $userId) {
    $resultaat = $mysqli->query("SELECT * FROM tbltickets WHERE userID =" .$userId);
    return ($resultaat->num_rows ==0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function getEventsByEventid($mysqli, $eventId) {
    $resultaat = $mysqli -> query("SELECT * FROM evenementen WHERE evenementId=" .$eventId); 
    return ($resultaat ->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function getTicketdata($mysqli, $ticketid) {
    $resultaat = $mysqli->query("SELECT * FROM tbltickets WHERE ticketID= ".$ticketid); 
    return ($resultaat -> num_rows ==0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getzalenByID($mysqli, $zaalID) {
    $resultaat = $mysqli->query("SELECT * FROM tblzalen WHERE zaalID=".$zaalID); 
    return(($resultaat->num_rows == 0)?false:$resultaat); 
}
function getUserDataByID($mysqli, $userID) {
    $resultaat = $mysqli -> query("SELECT * FROM users WHERE id=".$userID); 
    return(($resultaat->num_rows == 0)?false:$resultaat); 
}
function getCategorieDataByID($mysqli, $tickets) {
    $resultaat = $mysqli -> query("SELECT * FROM ticket_categories WHERE id=" .$tickets); 
    return(($resultaat->num_rows == 0)?false:$resultaat); 
}
function  getEventsByUserID($mysqli,$userID) {
    $resultaat = $mysqli -> query("SELECT * FROM  evenementen WHERE userID=" . $userID); 
    return(($resultaat->num_rows == 0)?false:$resultaat); 
}