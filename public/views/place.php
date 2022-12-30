<!DOCTYPE html>
<?php
    include('is-user-enabled.php');
    include('is-chosen-place.php');
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
        <div class="place-container">
            <?php 
                $placeRep = new PlaceRepository();
                $place = $placeRep->getPlace();
            ?>
            <div class="place-header">
                <div class="place-return-box invisible">
                </div>
                <div class="place-name">
                    <?= $place->getName() ?>
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
                            $dogs = $placeRep->getDogsHere();
                            foreach ($dogs as $dog) {?>
                        <ul class="dog-list">
                            <li><?php echo $dog['dog_name']?></li>
                            <li><?php echo $dog['dog_breed']?></li>
                            <li><?php echo $dog['dog_size']?></li>
                            <li><?php echo $dog['age']?></li>
                            <li><?php
                                if ($dog['gender'] == 1) {
                                    echo "Male";
                                } else {
                                    echo "Female";
                                } ?>
                            </li>
                        </ul>
                        <?php } ?>
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