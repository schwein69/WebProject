<?php

require_once 'bootstrap.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);      
if(isset($_POST["email"])){
    try {
        $mail->isSMTP(); // using SMTP protocol                                     
        $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
        $mail->SMTPAuth = true;  // enable smtp authentication                             
        $mail->Username = 'guojiahao707@gmail.com';  // sender gmail host              
        $mail->Password = 'hypjncamzcglrikv'; // sender gmail host password                          
        $mail->SMTPSecure = 'tls';  // for encrypted connection                           
        $mail->Port = 587;   // port for SMTP     
    
        $mail->setFrom('guojiahao707@gmail.com', "Sender"); // sender's email and name
        $mail->addAddress('guojiahao707@gmail.com', "Receiver");  // receiver's email and name
    
        $mail->Subject = 'Test subject';
        $mail->Body    = 'Test body';
    
        $mail->send();
        echo '<script>
        alert("Message has been sent!");
        window.location.href="login.php";
        </script>';
    } catch (Exception $e) { // handle error.
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    } 
}

$templateParams["content"] = "recovery-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
   

require '../template/base.php';
echo '<script src="../javascript/registrationchecker.js" type="text/javascript"></script>'

?>