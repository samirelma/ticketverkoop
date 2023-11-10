<?php
include $_SERVER['DOCUMENT_ROOT'] . "../connect/connect.php";



function fetchSingle($query, ...$params) {
 global $connect;
 if (!$connect) {
  die("Error: Could not connect to database");
}
  $stmt = $connect->prepare($query);
  $stmt->execute();

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connect->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_assoc();

  $stmt->close();

  return $data;
}


function fetchAll($query, ...$params) {
  global $connect;

  $stmt = $connect->prepare($query);
  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connect->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $data;

}


function execute($query, ...$params) {
  global $connect;
  if (!$connect) {
    die("Error: Could not connect to database");
  }

  $stmt = $connect->prepare($query);
  $stmt->execute();


  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connect->close();
    return false;
  }

  $stmt->close();

  return true;
}



function insert($query, ...$params) {
  global $connect;
  if (!$connect) {
    die("Error: Could not connect to database");
  }

  $stmt = $connect->prepare($query);
  $stmt->execute();


  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connect->close();
    return false;
  }

  $stmt->close();
  return true;
}