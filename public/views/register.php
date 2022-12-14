<!DOCTYPE html>
<?php
    if (isset($_COOKIE["user_enabled"])) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
?>
<head>
    <title>Register Page - DogOut</title>
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
            <div class="login-container register-container">
                <div class="login-inner-container">
                    <div class="logo">
                        <img src="public/img/dog-logo.png" alt="" class="dog-logo">
                    </div>
                    <form action="register" method="POST" class="register-form">
                        <div class="register-message">
                            <?php
                            if(isset($messages)) {
                                foreach($messages as $message) {
                                    echo $message;
                                }
                            }
                            ?>
                        </div>
                        <input name="name" type="text" placeholder="Name" required>
                        <input name="surname" type="text" placeholder="Surname" required>
                        <input name="email" type="text" placeholder="Email" required>
                        <input name="password" type="password" placeholder="Password" required>
                        <button type="submit" class="blue-button">Sign up</button>
                        <div class="sign-up-text">
                            Already have an account? <a href="login">Sign in</a>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    <script src="public/js/user-validation.js"></script>
</body>