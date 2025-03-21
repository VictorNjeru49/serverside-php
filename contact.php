<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name =$_POST[$name];
    $email = $_POST[$email];
    $phone = $_POST[$phone];
    $message = $_POST[$message];

     $command = "python3 /contact.py $email $name $phone $message";
    
    
    $output = shell_exec($command);
    
   if($output){ 
    echo $output;
   }else{
    echo "";
   }
   
    if ($return_var !== 0) {
        echo "Error executing Python script.";
    }
   
}
?>
