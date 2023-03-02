<?php

use LDAP\Result;

session_start();

include('connection.php');


if(isset($_SESSION["user"])){

  header('Location: welcome.php');
    
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        header('Location: index.php?error=Username is Required');
            exit();
    }
    elseif(empty($password)){
        header('Location:  index.php?error=Password is Required');
        exit();
    }
    else{
        $result = $mysqli->query("SELECT * FROM user WHERE email = '" . $email . "' AND password = '" . $password . "'") or die($mysqli->error);
        $users = mysqli_fetch_array($result);
    
        if ($users['email']===$email && $users['password']===$password) {
            $_SESSION['user'] = $users;
            header('refresh:1;url= ./welcome.php');
        }
        else{
            header('Location:  index.php?error=Wrong Password or Invalid Username');
        }
    }

}

if(isset($_POST['save'])){
  $name = $_POST['name'];
  $email = $_POST['emailSignUp'];
  $password = $_POST['passwordSignUp'];
  $cpassword = $_POST['cpassword'];

  if($password === $cpassword){
    $mysqli->query("INSERT INTO user (name, email, password) VALUES('$name', '$email', '$password')") or die($mysqli->error);
  }else{
    
    echo '<script> alert("password not match") </script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login System</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
.error {
    background: #F2DEDE;
    color: #a94442;
    padding: 12px;
    width: 100%;
    text-align: center;
    border-radius: 5px;
    margin: 20px auto;
    visibility: visible;
}
</style>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="index.php" method="POST">

                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="name">
                <input type="email" placeholder="Email" name="emailSignUp">
                <input type="password" id="password" placeholder="Password" name="passwordSignUp">
                <input type="password" id="c-password" placeholder="Password" name="cpassword">
                <input type="checkbox" id="togglePassword"> Show Password
                <button name="save">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="index.php" method="POST">
                <?php if(isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error'];?></p>
                <?php }?>
                <h1>Sign in</h1>

                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <a href="#">Forgot your password?</a>
                <button type="submit" name="save">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome To Simple Login</h1>
                    <p>
                        The function are created by PHP and sql
                    </p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>I hope you like it</h1>
                    <p>Try to Login using the account you created</p>
                    <button class="ghost" id="signUp" type="submit">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const signUpButton = document.getElementById("signUp");
    const signInButton = document.getElementById("signIn");
    const container = document.getElementById("container");

    signUpButton.addEventListener("click", () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener("click", () => {
        container.classList.remove("right-panel-active");
    });
    </script>
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const cpassword = document.querySelector('#c-password');
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        const type2 = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
        cpassword.setAttribute('type', type2);
        // toggle the eye slash icon
    });
    </script>
</body>

</html>