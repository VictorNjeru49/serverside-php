<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username =$_POST['username'];
    $email =$_POST['email'];
    $password =$_POST['password'];

    $command = escapeshellcmd("python3 ./register.py \"$email\" \"$Username\" \"$password\"");

    $output = [];
    $return_var = 0;



exec($command, $output, $return_var);

if ($return_var === 0) { 
    echo <<<HTML
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
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
        <h1 class="success">✅ Registration Successful!</h1>
        <p>Welcome, <strong>User</strong>!</p>
        <p>Your account has been successfully created.</p>
        <button class="btn" onclick="window.location.href='index.html'">Go to Login</button>
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
    <title>Registration Failed</title>
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
        <h1 class="error">❌ Registration Failed</h1>
        <p>There was an error creating your account.</p>
        <p>Please try again or contact support if the problem persists.</p>
        <button class="btn" onclick="window.location.href='register.html'">Go Back to Register</button>
    </div>
</body>
</html>

HTML;
    echo "Error executing Python script. Return status: $return_var<br>";
    echo "Output: " . implode("\n", $output);
}

}
?>

