<!DOCTYPE html>
<?php
if (!isset($_COOKIE["user_enabled"])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
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
        <div class="place-container">
            <?php 
                // TODO pobieranie danych o miejscu z ID place'a
                // Porównanie w bazie z nazwą z id z diva
            ?>
            <div class="place-header">
                <div class="place-return-box invisible">
                </div>
                <div class="place-name">
                    Błonia
                </div>
                <div class="place-return-box">
                    <a href="home">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
            <div class="place-dogs-container">
                <div class="dog-count-header">
                    Dogs here:
                </div>
                <div class="dogs-here-container">
                    <div class="dogs-here-content">
                        <ul class="dog-list-header">
                            <li>Name</li>
                            <li>Breed</li>
                            <li>Size</li>
                            <li>Age</li>
                            <li>Gender</li>
                        </ul>    

                        <?php 
                            // Foreach po psach tutaj
                        ?>
                        <ul class="dog-list">
                            <li>Binia</li>
                            <li>Mongrel</li>
                            <li>Small</li>
                            <li>12</li>
                            <li>Female</li>
                        </ul>                        
                    </div>
                </div>
            </div>
            <div class="place-form">
                <form action="goForAWalk" method="POST">
                    <div class="walk-box">
                        <label class="walk-time">Approximate time of a walk:</label>
                        <select name="walk-time" class="walk-select" id="">
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60">1 hour</option>
                        </select>
                    </div>
                    <button type="submit" class="blue-button">Going there!</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


</body>