<?php
session_start();

// Check if title and prompts are available in the session
if (!isset($_SESSION['title']) || !isset($_SESSION['prompts'])) {
    header("Location: index.php");
    exit();
}

// Retrieve form prompts and store them in an array
$promptArray = explode(',', $_SESSION['prompts']);

// Connect to database
include("conn.php");

//Declare variables from the form data
foreach($promptArray as $key => $prompt) {
    $columnName = strtolower(str_replace(' ', '_', trim($prompt)));
    $varName = $columnName;
    $$varName = mysqli_real_escape_string($conn, $_POST[$columnName]);
    echo "The value of $varName is: " . $$varName . "<br>";
    echo "$$varName = mysqli_real_escape_string(, $_POST[$columnName]);". "<br>";
}

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table with title as name if it doesn't exist
$tableName = strtolower(str_replace(' ', '_', trim($_SESSION['title'])));
$sql = "CREATE TABLE IF NOT EXISTS $tableName (id INT(6) AUTO_INCREMENT PRIMARY KEY,";
foreach($promptArray as $key => $prompt) {
    $columnName = strtolower(str_replace(' ', '_', trim($prompt)));
    $sql .= "$columnName VARCHAR(255) NULL,";
}
//remove last comma
$sql = rtrim($sql, ','). ")";

//Error trap the table creation
if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}else{
    echo "<br>";
    echo $sql;
}

// Write SQL to insert data into table
$insertSql = "INSERT INTO $tableName (";
//loop through prompts and add to insert SQL
foreach($promptArray as $key => $x) {
    $columnName = strtolower(str_replace(' ', '_', trim($x)));
    $insertSql .= "$columnName";
    if ($key < count($promptArray) - 1) {
        $insertSql .= ", ";
    }
}
$insertSql .= ") VALUES (";
//loop through prompts and add to insert SQL values
foreach($promptArray as $key => $x) {
    $columnName = strtolower(str_replace(' ', '_', trim($x)));
    $insertSql .= "'".${$columnName}."'"; 
    if ($key < count($promptArray) - 1) {
        $insertSql .= ", ";
    }
}
$insertSql .= ")";

echo"<br>";
echo $insertSql;
echo"<br>";

//Error trap the insert
if ($conn->query($insertSql) === FALSE) {
    echo "Error inserting data: ". $conn->error;
}else{
     foreach($promptArray as $x) {
        $columnName = strtolower(str_replace(' ', '_', trim($x)));
       echo"column name:$columnName ";
    };
    echo "<br>";
    foreach($promptArray as $x) {
        $columnName = strtolower(str_replace(' ', '_', trim($x)));
        echo"column value:$".$columnName;
    };
}
