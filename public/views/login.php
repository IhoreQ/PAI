<!DOCTYPE html>
<?php
    if (isset($_COOKIE["user_enabled"])) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
?>
<head>
    <title>Login Page - DogOut</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/css/phone-style.css" type="text/css">
    <link rel="shortcut icon" href="public/img/favico.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/02c4ba91de.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-container">        
        <div class="app-container">
            <div class="app-cover">
                <div class="app-cover-container">
                    <div class="app-cover-header">
                        <div class="app-cover-close invisible">
                        </div>
                        <div class="app-cover-title">
                            <h1>Password recovery</h1>
                        </div>
                        <div class="app-cover-close" onclick="turnOff()">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    <div class="app-cover-inner-container">
                        <p>Enter your email address in the box below<br>
                            to get the link
                            to reset your password.</p>
                        <form action="">
                            <input name="email-recovery" type="text" placeholder="Email">
                            <button class="app-cover-blue-button">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="login-container">
                <div class="login-inner-container">
                    <div class="logo">
                        <img src="public/img/dog-logo.png" alt="" class="dog-logo">
                    </div>
                        <form action="login" method="POST" class="login-form">
                        <div class="login-message">
                        <?php
                        if(isset($messages)) {
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                        </div>
                            <div class="input-div">
                                <i class="fa-solid fa-user"></i>
                                <input name="email" type="text" placeholder="Email" required>
                            </div>
                            <div class="input-div">
                                <i class="fa-solid fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="forgot-password-text-container">
                                <a class="forgot-password-text" onclick="turnOn()">Forgot password</a>
                            </div>
                            <button type="submit" class="blue-button">Log in</button>
                            <div class="sign-up-text">
                                Don't have an account? <a href="register">Sign up</a>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/cover-functions.js"></script>
</body>