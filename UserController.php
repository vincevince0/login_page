<?php
function sendMail($email,$vezNev,$kerNev){
        $mail = new PHPMailer();
        $token = $this->getNewToken();
 
        try {
 
            $mail->isSMTP();                                            
            $mail->Host       = 'localhost';                    
            $mail->SMTPAuth   = false;                                  
            $mail->Port       = 1025;                                
           
            $fullName = $vezNev." ".$kerNev;
 
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($email,$fullName);    
       
            $mail->isHTML(true);                                
            $mail->Subject = 'Raktár regisztráció';
            $mail->Body    = 'A regisztráció véglegesítésének érdekében kattintson az alábbi linkre: <a href="http://localhost:81/Raktar/Login.php?registraion-token='.$token.'">';
       
            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
 