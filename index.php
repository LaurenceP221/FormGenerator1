<?php
// Start a new PHP session.
// This is needed to store form data across pages.
session_start();

// Check if the form was submitted.
// The request method should be POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store the form title in the session.
    // The title is retrieved from the $_POST array, specifically the 'title' key.
    $_SESSION['title'] = $_POST['title'];

    // Store the form prompts in the session.
    // The prompts are retrieved from the $_POST array, specifically the 'prompts' key.
    $_SESSION['prompts'] = $_POST['prompts'];

    // Redirect the user to the preview page.
    // The user's browser will be sent a new request to the 'preview_prompts.php' page.
    header("Location: preview_prompts.php");

    // Stop the script execution after redirection.
    exit();
}

// HTML markup for the page.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Title and Prompts</title>

    <!-- Link to Bootstrap CSS file. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<section class="vh-100" style="background-color:#508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-7">
                <div class="card shadow-2-strong " style="width: 50rem; border-radius: 1rem;">
                    <div class="card-title card-body p-15">
                        <div class="card-header">
                            <h1 class="text-center mb-4">Input Title and Prompts</h1>
                        </div>
                        <br>
                        <!-- Display form title and prompts -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-5">
                            <h4 class="form-label form-label-lg" for="title">Enter your form title:</h4>
                            <input class="form-control" style="font-size: 2rem;" type="text" id="title" name="title" 
                            placeholder="Form Title" pattern="[^\d]\S*" required 
                            title="Title cannot start with a number">
                        </div>
                        <div class="mb-5">
                            <h4 for="prompts">Enter prompts separated by commas:</h4>
                            <textarea class="form-control" style="height: 200px; font-size: 2rem;" id="prompts" name="prompts" 
                            placeholder="Name, Sex, etc." required></textarea>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" style="--bs-btn-padding-y: 1rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: 2rem;" 
                            type="submit">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>