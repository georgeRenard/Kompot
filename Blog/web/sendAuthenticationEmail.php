<?php

require_once "../PHPMailer/PHPMailerAutoload.php";

function sendAuthenticationEmail($email,$name,$url){

    /* $mail = new PHPMailer;
    
    //Enable SMTP debugging. 
    $mail->SMTPDebug = 1;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = 'smtp.gmail.com';
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
    
    $mail->isHTML(true);
    
    $mail->Subject = "Email Verification";
    $mail->Body = "Hello, " . $name . '<br>' . "Thank you for signing up for our website. Here is your unique activation link " . $url
        . '<br>' . "We hope you have great time. Peace!" . '<br>' . "Team TRUE Slavs |||";
    //$mail->AltBody = "This is the plain text version of the email content";
    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
    } */
    
    $smtpHost = 'smtp.gmail.com';
    $smtpAuth = true;
    $user = 'goshoan';
    $password = 'belongyou';
    $smtpEncryption = 'tls';
    $smtpPort = 465;
    
    $senderEmail = 'goshoan@abv.com';
    $senderName = 'Nqkvo ime';
    $recipient = $email;
    
    $subject = "Welcome";
    $html = "Hello!";
    $text = "Hello Text!";
    
    
    $mail = new PHPMailer;
    $debug = 1;

    ( $debug === 3 )?$mail->SMTPDebug = 3:null;      // Enable verbose debug output

    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = $smtpHost;      // 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = $smtpAuth;                 // Enable SMTP authentication
    $mail->Username = $user;      // 'user@example.com';                 // SMTP username
    $mail->Password = $password;     // 'secret';                           // SMTP password
    $mail->SMTPSecure = $smtpEncryption;   // 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $smtpPort;      // 587;                                    // TCP port to connect to

    $mail->setFrom($senderEmail,$senderName);       //('from@example.com', 'Mailer'); 
    $mail->addAddress($recipient);               // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $html;
    $mail->AltBody = $text;

    if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    echo ( $debug >= 1 )?'Message has been sent':'';
    }
}
