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
    <title>Prompts</title>
</head>
<body>
    <h1>Prompts</h1>
    <ul>
        <?php foreach ($prompts as $prompt): ?>
            <li><?php echo htmlspecialchars(trim($prompt)); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="form.php">Go to Form</a>
</body>
</html>
