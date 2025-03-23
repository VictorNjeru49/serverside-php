<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Accessing POST data correctly
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $appointmentdate = $_POST['appointmentdate'];
    $appointmenttime = $_POST['appointmenttime'];
    $reason = $_POST['reason'];

    // Construct the command
    $command = escapeshellcmd("python3 ./appointment.py \"$email\" \"$name\" \"$phone\" \"$reason\" \"$doctor\" \"$appointmentdate\" \"$appointmenttime\"");
    
    // Execute the command and capture output and return status
    $output = [];
    $return_var = 0;



    exec($command, $output, $return_var);
    
    // Check if the command was successful
    if ($return_var === 0) {
    echo <<<HTML
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        text-align: center;
        padding: 20px;
    }
    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 { color: #4CAF50; }
    p { color: #333; }
    </style>

    <div class="container">
    <h1>✅ Appointment Confirmed!</h1>
    <p>Thank you, <strong>{$_POST['name']}</strong>. Your appointment with <strong>{$_POST['doctor']}</strong> on <strong>{$_POST['appointmentdate']}</strong> at <strong>{$_POST['appointmenttime']}</strong> has been confirmed.</p>
    <p>Confirmation email sent to <strong>{$_POST['email']}</strong>.</p>
    <h3>Server Response:</h3>
    <pre>
  HTML;

        echo implode("\n", $output);
        echo "</pre></div>";

    } else {
    echo <<<HTML
    <style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
          }
        
          .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
          }
        
          h1, h2, h3 {
            color: #333;
          }
        
          h1 {
            font-size: 36px;
            margin-top: 0;
          }
        
          h2 {
            font-size: 24px;
            margin-top: 30px;
          }
        
          h3 {
            font-size: 18px;
            margin-top: 20px;
          }
        
          p {
            color: #555;
            line-height: 1.5;
          }
        
          .error {
            color: #F44336;
            font-weight: bold;
          }
        
          pre {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 4px;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
          }
        </style>
        
        <div class="container">
          <h1>Error Booking Appointment</h1>
          <p>There was an error processing your appointment.</p>
          <h2 class="error">❌ Error Booking Appointment</h2>
          <p><strong>Debug Info:</strong> Return status: $return_var</p>
          <h2>Error</h2>
          <p>There was an error executing the Python script.</p>
          <p>Return status: $return_var</p>
          <h2>Output:</h2>
          <pre>
HTML;
        
        echo implode("\n", $output);
        
        echo "</pre></div>";
        
    }
} else {
    echo "<h2>Error</h2><p>Invalid request method.</p>";
}
?>
