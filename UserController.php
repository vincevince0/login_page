<?php

class UserController
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "loginpage");
        $this->mysqli->set_charset("utf8mb4");
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getNewToken()
    {
        $token = password_hash(time(), PASSWORD_DEFAULT);
        return $token;
    }   
    public function sendMail($email,$vezNev,$kerNev)
    {
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

    public function keresEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = '$email'";
 
        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }
 
    public function Registration($email,$fullName,$password,$token)
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
 
    public function activateToken($token)
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

    public function newUser($id, $is_active, $name, $email, $password, $token, $token_valid_until, $created_at, $registered_at, $picture, $deleted_at, $logged_in)
{
    $sql = "INSERT INTO `users` (id, is_active, name, email, password, token, token_valid_until, created_at, registered_at, picture, deleted_at, logged_in) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param("iissssssssss", $id, $is_active, $name, $email, $password, $token, $token_valid_until, $created_at, $registered_at, $picture, $deleted_at, $logged_in);
    $stmt->execute();
    $stmt->close();
}


}