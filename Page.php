<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>


<?php 



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

    echo '<form method="post">
            <button type="submit" class="loginForm-btn" name="loginForm-btn" id="loginForm-btn">Login Form</button>
          </form>';

    if (isset($_POST['loginForm-btn'])) {
        
        echo '<table class="loginForm">';

        echo '<tr><td><div class="loginText">Log In</div></td></tr>';

        echo '<tr><td>';
        echo '<input class="loginInput" type="email" placeholder="Email" required><br>';
        echo '<input class="loginInput" type="password" placeholder="Password" required>';
        echo '</tr></td>';

        echo '<tr><td>';
        echo '<form method="post">
                    <button type="submit" class="forgotPassword-btn" name="forgotPassword-btn" id="forgotPassword-btn">Forgot password</button>';
        echo '      <button type="submit" class="registration-btn" name="registration-btn" id="registration-btn">Registration</button>
              </form><br>';
        echo '</td></tr>';

        echo '<tr><td>';
        echo '<form method="post">
                    <button type="submit" class="login-btn" name="login-btn" id="login-btn">Login</button>
             </form>';
        echo '</td></tr>';

        echo'</table>';
    }

    if(isset($_POST['forgotPassword-btn']))
    {
        echo '<input class="loginInput" type="text" placeholder="Email" required><br>
              <form method="post">
                    <button type="submit" class="finalizeRegistration-btn" name="newPass-btn" id="newPass-btn">Create New Password</button>
              </form>';
    }

    if(isset($_POST['registration-btn']))
    {
        echo '<input class="loginInput" type="email" id="name" placeholder="Name" required><br>
              <input class="loginInput" type="text" id="email" placeholder="Email" required><br>
              <input class="loginInput" type="password" id="password1" placeholder="Password" required><br>
              <input class="loginInput" type="password" id="password2" placeholder="Password again" required>
              <form method="post">
                    <button type="submit" class="finalizeRegistration-btn" name="finalizeRegistration-btn" id="finalizeRegistration-btn">Registration</button>
              </form>';
    }

    if(isset($_POST['login-btn']))
    {
        echo 'Logged in successfully!';
    }

    if(isset($_POST['finalizeRegistration-btn']))
    {
        $mail = new PHPMailer();
        //$token = $this->getNewToken();
 
            $mail->isSMTP();                                            
            $mail->Host       = 'localhost';                    
            $mail->SMTPAuth   = false;                                  
            $mail->Port       = 1025;                                
           
            $fullName = $vezNev." ".$kerNev;
 
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($email,$fullName);    
       
            $mail->isHTML(true);                                
            $mail->Subject = 'Regisztráció';
            $mail->Body    = 'A regisztráció véglegesítésének érdekében kattintson az alábbi linkre: <a href="http://localhost:8070/LoginPage/Page.php?registraion-token='.$token.'">';
       
            $mail->send();
            //echo 'Message has been sent';
    }

?>

   

</body>
</html>

