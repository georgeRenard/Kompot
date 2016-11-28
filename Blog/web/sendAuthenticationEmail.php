<?php

require_once "../PHPMailer/PHPMailerAutoload.php";

function sendAuthenticationEmail($email,$name,$url){

    $mail = new PHPMailer;

    //Enable SMTP debugging. 
    $mail->SMTPDebug = 3;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = gethostbyname('tls://smtp.gmail.com');
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                          
    //Provide username and password     
    $mail->Username = "authentemails@gmail.com";                 
    $mail->Password = "authenticationINC";                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";                           
    //Set TCP port to connect to 
    $mail->Port = 587;                                   

    $mail->From = "authentemails@gmail.com";
    $mail->FromName = "True Slavs Team |||";

    $mail->addAddress($email, $name);

    $mail->isHTML(false);

    $mail->Subject = "Email Verification";
    $mail->Body = "Hello, " . $name . PHP_EOL . "Thank you for signing up for our website. Here is your unique activation link " . $url
        . PHP_EOL . "We hope you have great time. Peace!" . PHP_EOL . "Team TRUE Slavs |||";
    //$mail->AltBody = "This is the plain text version of the email content";
    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
    }
}



?>
