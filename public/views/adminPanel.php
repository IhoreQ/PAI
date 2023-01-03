<!DOCTYPE html>
<?php
include('is-user-enabled.php');
include('is-admin.php');
?>
<head>
    <title>Time for a walk! - DogOut</title>
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
        <div class="admin-container">
            <div class="admin-header">
                <div class="admin-return-box invisible">
                </div>
                <div class="admin-header-title">
                    Admin Panel
                </div>
                <div class="admin-return-box">
                    <a href="home">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
            <div class="admin-content">
                <div class="new-places-ideas-container">
                    <div class="new-places-ideas-header">New places ideas</div>
                    <div class="new-places-ideas-content">
                        <ul class="new-places-idea-list-header">
                            <li>Place Name</li>
                            <li>Street</li>
                            <li>City</li>
                        </ul>
                        <?php
                        $placeRep = new PlaceRepository();
                        $placeIdeas = $placeRep->getPlacesIdeas();
                        foreach ($placeIdeas as $placeIdea) {?>
                            <ul class="new-places-idea-list">
                                <li><?php echo $placeIdea['name']?></li>
                                <li><?php echo $placeIdea['street']?></li>
                                <li><?php echo $placeIdea['city']?></li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>