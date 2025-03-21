<?php
$Username =$_POST['Username'];
$email =$_POST['email'];
$password =$_POST['password'];

function sendContactForm($Username, $email, $password, ) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bse";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registers (Username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Username, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}

