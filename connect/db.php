
<?php
function checkEmail($mysqli, $email) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : true;
}

function checkWachtwoord($mysqli, $wachtwoord, $email) {
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    $row = $resultaat->fetch_assoc();
    return password_verify($wachtwoord, $row['password']);
}

function getGebruikersid($mysqli, $email) {
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_assoc()['id'];
}
function controleerAdmin($mysqli, $email) {
    $stmt = $mysqli->prepare("SELECT id FROM user_roles WHERE name = 'admin'");
    $stmt->execute();
    $functie = $stmt->get_result()->fetch_assoc()['id'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND function = ?");
    $stmt->bind_param("si", $email, $functie);
    $stmt->execute();
    $resultaat = $stmt->get_result();

    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}
function controleerBedrijf($mysqli, $email) {
    $stmt = $mysqli->prepare("SELECT id FROM user_roles WHERE name = 'bedrijf'");
    $stmt->execute();
    $functie = $stmt->get_result()->fetch_assoc()['id'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND function = ?");
    $stmt->bind_param("si", $email, $functie);
    $stmt->execute();
    $resultaat = $stmt->get_result();

    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}
function controleerMember($mysqli, $email) {
    $stmt = $mysqli->prepare("SELECT id FROM user_roles WHERE name = 'member'");
    $stmt->execute();
    $functie = $stmt->get_result()->fetch_assoc()['id'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND function = ?");
    $stmt->bind_param("si", $email, $functie);
    $stmt->execute();
    $resultaat = $stmt->get_result();

    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function updateWachtwoord($mysqli, $email, $wachtwoord) {
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $email2 = $stmt->get_result()->fetch_assoc()['email'];

    if ($email2 != null) {
        if ($email2 === $email) {
            $wachtwoord = password_hash($wachtwoord, PASSWORD_ARGON2ID);
            $stmt = $mysqli->prepare("UPDATE users SET password= ? WHERE email= ?");
            $stmt->bind_param("ss", $wachtwoord, $email);
            $stmt->execute();
            header("Location: ../profile/login.php");
        } else {
            header("Location: passwordReset.php");
        }   
    } else {
        header("Location: passwordReset.php");
    }  
}

function getTicketsByUser($mysqli, $userId) {
    $stmt = $mysqli->prepare("SELECT * FROM tbltickets WHERE userID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    $tickets = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);

    if($tickets) {
        foreach($tickets as $key => $ticket) {
            $purchaseId = $ticket['purchaseID'];
            $stmt = $mysqli->prepare("SELECT * FROM user_purchases WHERE purchaseID = ? AND isPaid = 1");
            $stmt->bind_param("i", $purchaseId);
            $stmt->execute();
            $purchaseResult = $stmt->get_result();
            if($purchaseResult->num_rows == 0) {
                unset($tickets[$key]);
            }
        }
    }
    return $tickets;
}

function getEventsByEventid($mysqli, $eventId) {
    $stmt = $mysqli->prepare("SELECT * FROM evenementen WHERE evenementId = ?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function getTicketdata($mysqli, $ticketid) {
    $stmt = $mysqli->prepare("SELECT * FROM tbltickets WHERE ticketID = ?");
    $stmt->bind_param("i", $ticketid);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function getzalenByID($mysqli, $zaalID) {
    $stmt = $mysqli->prepare("SELECT * FROM tblzalen WHERE zaalID = ?");
    $stmt->bind_param("i", $zaalID);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat;
}
function getUserDataByID($mysqli, $userID) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat;
}
function getCategorieDataByID($mysqli, $tickets) {
    $stmt = $mysqli->prepare("SELECT * FROM ticket_categories WHERE id = ?");
    $stmt->bind_param("i", $tickets);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat;
}
function getEventsByUserID($mysqli, $userID) {
    $stmt = $mysqli->prepare("SELECT * FROM evenementen WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat;
}
function getCategorieData($mysqli) {
    $stmt = $mysqli->prepare("SELECT id, prijs, name FROM ticket_categories");
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat;
}
function getallevents($mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM evenementen");
    $stmt->execute();
    $resultaat = $stmt->get_result();
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}
function verwijderEvent($mysqli, $eventID) {
    $stmt = $mysqli->prepare("DELETE FROM evenementen WHERE evenementID = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
}
?>