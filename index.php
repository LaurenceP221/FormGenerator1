<?php
session_start();

// Retrieve form data if it's submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['prompts'] = $_POST['prompts'];
    header("Location: prompts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Prompts</title>
</head>
<body>
    <h1>Input Prompts</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="prompts">Enter prompts separated by commas:</label><br>
        <input type="text" id="prompts" name="prompts" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
