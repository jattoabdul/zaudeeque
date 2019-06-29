<?php
$name_error = $email_error = "";
$name = $email = $message = $success = "";
if($_POST){

    if (empty($_POST["name"])) {
        $name_error = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $name_error = "Only letters and white space allowed"; 
        }
    }
    
    if (empty($_POST["email"])) {
        $email_error = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format"; 
        }
    }
    
    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }
    print_r($name_error, $email_error);

    if ($name_error == '' and $email_error == '' ){
        // $message_body = '';
        // unset($_POST['submit']);
        // foreach ($_POST as $key => $value){
        //     $message_body .=  "$key: $value\n";
        // }
        
        $to = 'pregnito@gmail.com';
        $subject = '$name';
        $headers = 'From: $email' . "\r\n" .
        'Reply-To: $email' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if (mail($to, $subject, $message, $headers)){
            $success = "Message sent, thank you for contacting us!";
            $name = $email = $message = '';
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
