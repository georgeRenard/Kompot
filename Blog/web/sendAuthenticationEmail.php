<?php 

require_once "../PHPMailer/PHPMailerAutoload.php";

function sendAuthenticationEmail($email,$name,$url){
    
    $smtpHost = 'smtp.gmail.com';
    $smtpAuth = true;
    $user = 'authentemails@gmail.com';
    $password = 'authenticationINC';
    $smtpEncryption = 'tls';
    $smtpPort = 587;
    
    $senderEmail = 'authentemails@gmail.com';
    $senderName = 'True Slavs Team';
    $recipient = $email;
    
    $subject = "Welcome";
    $html = "Hello, " . $name . "<br>" . "Here is your unique url: " . $url . " to activate your account. <br> We hope you have a great time !.";
    $text = "Hello, here is your unique url: " . $url;
    
    
    $mail = new PHPMailer;
    $debug = 4;

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
        return false;
    } else {
    echo ( $debug >= 1 )?'Message has been sent':'';
        return true;
    }
}
