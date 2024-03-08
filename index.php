<?php
session_start();

// Retrieve form data if it's submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store form title in the session
    $_SESSION['title'] = $_POST['title'];

    // Store form prompts in the session
    $_SESSION['prompts'] = $_POST['prompts'];
    header("Location: preview_prompts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Title and Prompts</title>
</head>
<body>
    <h1>Input Title and Prompts</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Input form title -->
        <label for="title">Enter form title:</label><br>
        <input type="text" id="title" name="title" pattern="[^\d]\S*" required 
        title="Title cannot start with a number"><br><br>

        <!-- Input prompts -->
        <label for="prompts">Enter prompts separated by commas:</label><br>
        <input type="text" id="prompts" name="prompts" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

