<?php
session_start();

// Check if title and prompts are available in the session
if (!isset($_SESSION['title']) || !isset($_SESSION['prompts'])) {
    header("Location: index.php");
    exit();
}
// Retrieve form prompts and store them in an array
$prompts = explode(',', $_SESSION['prompts']);

include("conn.php");

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table with title as name if it doesn't exist
$tableName = strtolower(str_replace(' ', '_', trim($_SESSION['title'])));
$sql = "CREATE TABLE IF NOT EXISTS $tableName (id INT(6) AUTO_INCREMENT PRIMARY KEY,";
foreach($prompts as $key => $prompt) {
    $columnName = strtolower(str_replace(' ', '_', trim($prompt)));
    $sql .= "$columnName VARCHAR(255) NOT NULL,";
}
$sql = rtrim($sql, ','). ")";

//Error trap the table creation
if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}

// Insert data into table
$insertSql = "INSERT INTO $tableName (";
foreach($prompts as $key => $prompt) {
    $columnName = strtolower(str_replace(' ', '_', trim($prompt)));
    $insertSql .= "$columnName,";
}
$insertSql = rtrim($insertSql, ',') . ") VALUES (";
foreach($prompts as $key => $prompt) {
    $columnName = strtolower(str_replace(' ', '_', trim($prompt)));
    $insertSql .= "?,";
}
$insertSql = rtrim($insertSql, ',') . ")";

//Run the insert
$stmt = $conn->prepare($insertSql);
$postValues = array_values($_POST);
$stmt->bind_param(str_repeat("s", count($prompts)), ...$postValues);

// Close connection
$conn->close();
?>

