<?php
session_start();

// Check if title and prompts are available in the session
// If not, redirect to index.php
if (!isset($_SESSION['title']) || !isset($_SESSION['prompts'])) {
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
    <title>Preview Form</title>
</head>
<body>
    <!-- Display form title -->
    <h1>Title: <?php echo htmlspecialchars($_SESSION['title']); ?></h1>

    <!-- Display form prompts -->
    <h2>Prompts</h2>
    <ul>
        <?php foreach ($prompts as $prompt): ?>
            <li><?php echo htmlspecialchars(trim($prompt)); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="form.php">Go to Form</a>
</body>
</html>
