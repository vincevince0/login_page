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

<form method="post">
<button type="submit" class="loginForm-btn" name="loginForm-btn" id="loginForm-btn">Login Form</button>
</form>
<?php 

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
        echo '';
    }

    if(isset($_POST['registration-btn']))
    {
        echo '<input class="loginInput" type="email" placeholder="Name" required><br>
              <input class="loginInput" type="text" placeholder="Email" required><br>
              <input class="loginInput" type="password" placeholder="Password" required><br>
              <input class="loginInput" type="password" placeholder="Password again" required>';
    }

    if(isset($_POST['login-btn']))
    {
        echo '';
    }

?>

   

</body>
</html>

