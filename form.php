<?php
session_start();

// Check if prompts are available in the session
if (!isset($_SESSION['prompts'])) {
    header("Location: index.php");
    exit();
}

$prompts = explode(',', $_SESSION['prompts']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form</title>
</head>
<body>
    <h1>Dynamic Form</h1>
    <form action="submit-form.php" method="post">
        <?php foreach ($prompts as $prompt): ?>
            <label for="<?php echo strtolower(str_replace(' ', '_', trim($prompt))); ?>"><?php echo htmlspecialchars(trim($prompt)); ?>:</label><br>
            <input type="text" id="<?php echo strtolower(str_replace(' ', '_', trim($prompt))); ?>" name="<?php echo strtolower(str_replace(' ', '_', trim($prompt))); ?>"><br><br>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
