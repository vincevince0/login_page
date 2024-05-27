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


require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function getNewToken()
{
    $token = password_hash(time(), PASSWORD_DEFAULT);
    return $token;
}



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
        echo '
                <form method="post">
                <input class="loginInput" type="text" id="name" name="name" placeholder="Name" required><br>
                
              <input class="loginInput" type="email" name="email" id="email" placeholder="Email" required><br>
              <input class="loginInput" type="password" name="password1" id="password1" placeholder="Password" required><br>
              <input class="loginInput" type="password" name="password2" id="password2" placeholder="Password again" required><br>
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
        $token = getNewToken();
 
            $mail->isSMTP();                                            
            $mail->Host       = 'localhost';                    
            $mail->SMTPAuth   = false;                                  
            $mail->Port       = 1025;                                
 
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($_POST['email'],$_POST['name']);
       
            $mail->isHTML(true);                                
            $mail->Subject = 'Regisztráció';
            $mail->Body    = 'A regisztráció véglegesítésének érdekében kattintson az alábbi linkre: <a href="http://localhost:8070/LoginPage/Page.php?token='.$token.'">';
       
            $mail->send();
            //echo 'Message has been sent';
    }

    function getRequest()
    {
        if (isset($_GET[token])) {
            $token = $_GET[token];
        }
    }

    function keresEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = '$email'";
 
        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }
 
    function Registraion($email,$fullName,$password,$token)
    {
        if (empty($this->keresEmail($email))) {
            $created_at = date("Y-m-d H:i:s");
            $jelenlegi_ido = time();
            $hozzaadando_ido = 3600;
            $uj_ido = $jelenlegi_ido + $hozzaadando_ido;
 
            $jelzso = password_hash($password,PASSWORD_DEFAULT);
 
            $token_valid_until= date("Y-m-d H:i:s",$uj_ido);
            $query = "INSERT INTO user (is_active,name,email,password,token,token_valid_until,created_at) VALUES ('0','$fullName','$email','$jelzso','$token','$token_valid_until','$created_at')";
           
            if ($this->mysqli->query($query) == TRUE) {
                echo "Kattinson az emailben kapott linkre a regisztráció véglegesítéséért!";
            }
            else {
                echo " ";
            }
        }
        else {
            echo 'Ezzel az email cím már létezik 1 profil!';
        }
    }
 
    function activateToken($token)
    {
       
        $registered_at = date("Y-m-d H:i:s");
        $token_valid_until = "SELECT token_valid_until FROM user WHERE token = '$token'";
        if ($token_valid_until>=$registered_at) {
            $query="UPDATE user SET is_active=1,registered_at='$registered_at' WHERE token ='$token' ";
 
            if ($this->mysqli->query($query) == TRUE) {
                echo "Sikeres regisztráció!";
            }
            else {
                echo "Hiba az adatok feltöltése közben.". $this->mysqli->error;
            }
        }
        else{
            echo"lejárt az idő!";
        }
 
    }

?>

   

</body>
</html>

