<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $problem = htmlspecialchars($_POST['problem']);

    // Format the data
    $data = "Name: $name\nEmail: $email\nProblem: $problem\n-------------------------\n";

    // Define the file path
    $filePath = 'problems/problems.txt';

    // Write the data to the file
    if (file_put_contents($filePath, $data, FILE_APPEND)) {
        echo "Your problem has been sent successfully!";
        header('Refresh: 5; url=index.php');
    } else {
        echo "There was an error sending your problem. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>