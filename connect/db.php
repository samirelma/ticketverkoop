<?php

function getUserDataByUsername($username) {
    $conn = mysqli_init();
    $conn->real_connect("127.0.0.1", "root", "", "ticketverkoop");
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
    $conn->real_connect("127.0.0.1", "root", "", "ticketverkoop");
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
    $conn->real_connect("127.0.0.1", "root", "", "ticketverkoop");
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









