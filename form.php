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

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.signature.css">

    <style>
        .kbw-signature {
            width: 400px;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
        
        hr.dotted {
            border-top: 3px dotted #bbb;
            }
    </style>
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

        <div class="">
            <label class="" for="">Signature:  </label>
            <br />
            <div class="container-fluid" id="sig"></div>
            <br />

            <textarea id="signature64" name="signature" style="display: none" required></textarea>
            <div class="col-sm-12">
                <button class="btn btn-lg btn-warning" id="clear">&#x232B; Clear Signature</button>
            </div>
            <div class="invalid-feedback">
                Please put your signature.
            </div>
        </div>

        <button type="submit">Submit</button>
    </form>
    <script src="js\script.js"></script>
</body>
</html>