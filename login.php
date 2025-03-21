<?php
$Username =$_POST['Username'];
$password =$_POST['password'];

function sendContactForm($Username, $password, ) {
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
    $stmt = $conn->prepare("INSERT INTO logins (Username, password) VALUES (?, ?)");
    $stmt->bind_param("sss", $Username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "login successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}

