<?php
    require '../PHPMailer/PHPMailerAutoload.php';


    function sendAuthenticationEmail($email,$name,$url)
    {

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'authentemails@gmail.com';                 // SMTP username
        $mail->Password = 'authenticationINC';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('authentEmail@gmail.com', 'True Slavs Team');
        $mail->addAddress($email, $name);     // Add a recipient
        // Name is optional
    
        $mail->isHTML(false);                                  // Set email format to HTML

        $mail->Subject = "Email Verification";
        $mail->Body    = <<< EOF
        Hey $name,
        Thank you for signing up at our website!
        Please go to $url to activate your account. Enjoy!
        Team True Slavs |||. 
        EOF;

        if(!$mail->send()) {
            
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            
        }else {
            
            echo 'Message has been sent';
        }
    }

?>