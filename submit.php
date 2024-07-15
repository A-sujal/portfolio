<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate and sanitize input (you can expand this as needed)
    $name = htmlspecialchars($name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($message);

    // Define the path to your Excel file
    $file = 'contacts.xlsx';

    // Check if the file exists, if not, create it and add headers
    if (!file_exists($file)) {
        $header = "Name\tEmail\tMessage\n"; // Column headers
        file_put_contents($file, $header);
    }

    // Append new data to the Excel file
    $data = "$name\t$email\t$message\n";
    file_put_contents($file, $data, FILE_APPEND);

    // Redirect back to the contact page or wherever you want after submission
    header("Location: index.html");
    exit();
}
include('index.html');
?>
