<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Accessing POST data correctly
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Construct the command
    $command = escapeshellcmd("python3 ./contact.py \"$email\" \"$name\" \"$phone\" \"$message\"");
    
    // Execute the command and capture output and return status
    $output = [];
    $return_var = 0;



    exec($command, $output, $return_var);
    
    // Check if the command was successful
    if ($return_var === 0) { 
        echo <<<HTML
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submitted</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    text-align: center;
    padding: 50px;
}

.container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #4CAF50;
}

p {
    font-size: 18px;
    color: #333;
}

.success {
    color: #4CAF50;
    font-weight: bold;
}

.btn {
    margin-top: 20px;
    padding: 10px 15px;
    font-size: 16px;
    background-color: #008CBA;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #005f75;
}

    </style>
</head>
<body>
    <div class="container">
        <h1 class="success">✅ Message Sent Successfully!</h1>
        <p>Thank you for reaching out to us.</p>
        <p>We will get back to you as soon as possible.</p>
        <button class="btn" onclick="window.location.href='index.html'">Return to Home</button>
    </div>
</body>
</html>

HTML;
        echo implode("\n", $output);
        echo "</pre></div>";
    } else {
        echo <<<HTML

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submission Failed</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    text-align: center;
    padding: 50px;
}

.container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #F44336;
}

p {
    font-size: 18px;
    color: #333;
}

.error {
    color: #F44336;
    font-weight: bold;
}

.btn {
    margin-top: 20px;
    padding: 10px 15px;
    font-size: 16px;
    background-color: #d9534f;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #c9302c;
}

    </style>
</head>
<body>
    <div class="container">
        <h1 class="error">❌ Message Submission Failed</h1>
        <p>We encountered an issue while sending your message.</p>
        <p>Please try again later or contact support.</p>
        <button class="btn" onclick="window.location.href='contact.html'">Go Back to Contact Form</button>
    </div>
</body>
</html>


HTML;
        echo "Error executing Python script. Return status: $return_var<br>";
        echo "Output: " . implode("\n", $output);
    }
}
?>


