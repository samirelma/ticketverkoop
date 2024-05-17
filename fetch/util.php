<?php
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";

// This function fetches a single row of data from the database based on the provided query and parameters
function fetchSingle($query, ...$params) {
  global $mysqli; // Access the global $mysqli object, assuming it's defined elsewhere

  $stmt = $mysqli->prepare($query); // Prepare the query statement

  if (!empty($params)) { // Check if there are any parameters provided
    $paramTypes = ''; // Initialize an empty string to store the parameter types
    $paramValues = []; // Initialize an empty array to store the parameter values

    foreach ($params as $param) { // Loop through each parameter
      $paramTypes .= $param['type']; // Append the parameter type to the $paramTypes string
      $paramValues[] = $param['value']; // Add the parameter value to the $paramValues array
    }

    $stmt->bind_param($paramTypes, ...$paramValues); // Bind the parameters to the prepared statement
  }

  if (!$stmt->execute()) { // Execute the prepared statement
    $stmt->close(); // Close the statement
    $mysqli->close(); // Close the database connection
    return false; // Return false if execution fails
  }

  $result = $stmt->get_result(); // Get the result set from the executed statement
  $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows from the result set as an associative array

  $stmt->close(); // Close the statement

  return $data; // Return the fetched data
}




function fetchAll($query, ...$params) {
  global $mysqli; // Access the global $mysqli object

  $stmt = $mysqli->prepare($query); // Prepare the SQL query

  if (!empty($params)) { // Check if there are any parameters passed
    $paramTypes = ''; // Initialize an empty string to store parameter types
    $paramValues = []; // Initialize an empty array to store parameter values

    foreach ($params as $param) { // Loop through each parameter
      $paramTypes .= $param['type']; // Append the parameter type to $paramTypes
      $paramValues[] = $param['value']; // Add the parameter value to $paramValues
    }

    $stmt->bind_param($paramTypes, ...$paramValues); // Bind the parameters to the prepared statement
  }

  if (!$stmt->execute()) { // Execute the prepared statement
    $stmt->close(); // Close the statement
    $mysqli->close(); // Close the database connection
    return false; // Return false if execution fails
  }

  $result = $stmt->get_result(); // Get the result set from the executed statement
  $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows from the result set as an associative array

  $stmt->close(); // Close the statement

  return $data; // Return the fetched data
}




// This function is named 'execute' and takes a query string and variable number of parameters
function execute($query, ...$params) {
  // Access the global variable $mysqli, which should be a MySQLi database connection
  global $mysqli;
  
  // Check if the $mysqli variable is not set or null
  if (!$mysqli) {
    // If it is not set or null, output an error message and terminate the script
    die("Error: Could not connect to database");
  }

  // Prepare the query by creating a prepared statement using the $mysqli object
  $stmt = $mysqli->prepare($query);
  
  // Execute the prepared statement
  $stmt->execute();

  // Check if there are any parameters passed to the function
  if (!empty($params)) {
    // If there are parameters, initialize variables to store the parameter types and values
    $paramTypes = '';
    $paramValues = [];

    // Iterate over each parameter and append its type to the $paramTypes string
    // and add its value to the $paramValues array
    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    // Bind the parameters to the prepared statement using the bind_param method
    // The $paramTypes string specifies the types of the parameters
    // The $paramValues array contains the actual values of the parameters
    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  // Check if the prepared statement execution was successful
  if (!$stmt->execute()) {
    // If it was not successful, close the statement and the database connection
    // and return false to indicate failure
    $stmt->close();
    $mysqli->close();
    return false;
  }

  // Close the prepared statement
  $stmt->close();

  // Return true to indicate successful execution of the query
  return true;
}





// This function is named 'insert' and takes a query string and variable number of parameters.
function insert($query, ...$params) {
  // Access the global variable $mysqli which represents the database connection.
  global $mysqli;
  
  // Check if the database connection is available.
  if (!$mysqli) {
    // If the connection is not available, display an error message and stop the script execution.
    die("Error: Could not connect to database");
  }

  // Prepare the query statement using the $mysqli object.
  $stmt = $mysqli->prepare($query);
  
  // Execute the query statement.
  $stmt->execute();

  // Check if there are any parameters passed to the function.
  if (!empty($params)) {
    // Initialize variables to store the parameter types and values.
    $paramTypes = '';
    $paramValues = [];

    // Iterate through each parameter and append its type to $paramTypes and its value to $paramValues.
    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    // Bind the parameters to the prepared statement using the bind_param method.
    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  // Check if the execution of the prepared statement was successful.
  if (!$stmt->execute()) {
    // If the execution failed, close the statement and the database connection, and return false.
    $stmt->close();
    $mysqli->close();
    return false;
  }

  // Close the statement and return true to indicate successful execution.
  $stmt->close();
  return true;
}