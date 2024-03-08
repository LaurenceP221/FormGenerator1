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
    <title><?php echo htmlspecialchars($_SESSION['title']); ?></title>
</head>
<body>
    <!-- Display form title -->
    <h1><?php echo htmlspecialchars($_SESSION['title']); ?></h1>

    <!-- Display form proper -->
    <form action="submit-form.php" method="post">
        <?php foreach ($prompts as $prompt): ?>
            <label for="<?php echo strtolower(str_replace(' ', '_', trim($prompt))); ?>">
                <?php echo htmlspecialchars(trim($prompt)); ?>:
            </label><br>
            <input type="text" id="<?php echo strtolower(str_replace(' ', '_', trim($prompt))); ?>"
             name="<?php echo strtolower(str_replace(' ', '_', trim($prompt))); ?>"><br><br>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>