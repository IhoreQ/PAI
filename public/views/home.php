<!DOCTYPE html>
<head>
    <title>DogOut</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/css/phone-style.css" type="text/css">
    <link rel="stylesheet" href="public/css/places-style.css" type="text/css">
    <link rel="shortcut icon" href="public/img/favico.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/02c4ba91de.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-container">
        <div class="main-app-container">
            <div class="app-cover">
                <div class="app-cover-container">
                    <div class="app-cover-header">
                        <div class="app-cover-close invisible">
                        </div>
                        <div class="app-cover-title">
                            <h1>New place idea</h1>
                        </div>
                        <div class="app-cover-close" onclick="turnOff()">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    <div class="app-cover-inner-container new-place-idea-form">
                        <form action="">
                            <input name="place-idea-city" type="text" placeholder="City">
                            <input name="place-idea-name" type="text" placeholder="Name">
                            <input name="place-idea-street" type="text" placeholder="Street">
                            <button class="app-cover-blue-button">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="app-wrapper">
                <div class="menu-container">
                    <div class="menu-logo">
                        <hr class="separate-bar invisible">
                        <div class="menu-logo-inner">
                            <img src="public/img/dog-logo.png" alt="" class="menu-dog-logo">
                        </div>
                        <hr class="separate-bar">
                        <div class="menu-burger">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <div class="menu-bar">
                        <ul class="menu-bar-list">
                            <li class="menu-bar-element" id="home">
                                <a href="#home">
                                    <i class="fa-solid fa-house"></i>
                                    Home
                                </a>
                            </li>
                            <li class="menu-bar-element" id="places">
                                <a href="#places">
                                    <i class="fa-solid fa-tree-city"></i>
                                    Places
                                </a>
                            </li>
                            <li class="menu-bar-element" id="my-doggy">
                                <a href="#my-doggy">
                                    <i class="fa-solid fa-paw"></i>
                                    My doggy
                                </a>
                            </li>
                            <li class="menu-bar-element" id="settings">
                                <a href="#settings">
                                    <i class="fa-solid fa-gear"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="log-out-button" id="log-out">
                                <a href="login">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="app-content-container">

                    <div class="home-container" id="home-container">
                        <div class="home-content">
                            <div class="active-walk-header">
                                <h1 class="active-walk-text">No active walk.</h1>
                            </div>
                            <div class="active-walk-container">
                                <div class="active-walk-box">
                                        <div class="active-walk-box-header">
                                            <p class="invisible active-walk-symmetric-p">Ends in: <span class="active-walk-left-time">59:47</span></p>
                                            <h1 class="active-walk-name">Błonia - Kraków</h1>
                                            <p>Ends in: <span class="active-walk-left-time">59:47</span></p>
                                        </div>
                                        <div class="active-walk-finish">
                                            <h1>Finish</h1>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="friends-container">
                            <div class="friends-header">
                                <hr class="friends-separate-bar invisible">
                                <div class="friends-title">
                                    <h1>Friends</h1>
                                    <i class="fa-solid fa-chevron-up"></i>
                                </div>
                                <hr class="friends-separate-bar">
                            </div>
                            <div class="friends-bar">
                                <!-- TODO dodać friendsów jako ul > li -->
                            </div>
                            <div class="new-friends">
                                Add new friends
                            </div>
                        </div>
                    </div>

                    <div class="places-container" id="places-container">
                        <div class="places-content">
                            <div class="place-box" id="krakow-mlynowka">
                                <a href="#" class="place-text-box">
                                    Młynówka
                                </a>
                            </div>
                            <div class="place-box" id="krakow-blonia">
                                <a href="#" class="place-text-box">
                                    Błonia
                                </a>
                            </div>
                            <div class="place-box" id="krakow-lasek-wolski">
                                <a href="#"  class="place-text-box">
                                    Lasek Wolski
                                </a>
                            </div>
                            <div class="place-box" id="krakow-park-krowoderski">
                                <a href="#"  class="place-text-box">
                                    Park Krowoderski
                                </a>
                            </div>
                            <div class="places-footer-ideas">
                                <span id="places-ideas">Send your ideas about places here!</span>
                            </div>                            
                        </div>
                    </div>

                    <div class="my-doggy-container" id="my-doggy-container">
                        <div class="new-dog-content" id="no-dog">
                            <!-- <div class="new-dog-info">
                                <p>You have not added your doggo to the app yet.</p>
                                <a onclick="showAddingPage()" class="blue-button" href="#my-doggy-form">Do it now!</a>
                            </div> -->
                            <div class="new-dog-add-page" id="my-doggy-form">
                                <div class="new-dog-paw">
                                    <i class="fa-solid fa-paw"></i>
                                </div>
                                <h1>Adding form</h1>
                                <form action="addDog" class="new-dog-form" method="POST" enctype="multipart/form-data">
                                    <div class="adding-dog-message">
                                        <?php
                                        if(isset($messages)) {
                                            foreach($messages as $message) {
                                                echo $message;
                                            }
                                        }
                                        ?>
                                    </div>
                                    <input type="text" name="new-dog-name" placeholder="Name">
                                    <input type="number" name="new-dog-age" placeholder="Age">
                                    <input type="text" name="new-dog-breed" placeholder="Breed">
                                    <select name="new-dog-gender" id="">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <select name="new-dog-size">
                                        <option value="small">Small</option>
                                        <option value="medium">Medium</option>
                                        <option value="big">Big</option>
                                    </select>
                                    <textarea name="new-dog-description" class="new-dog-textarea" cols="30" rows="10" placeholder="Description"></textarea>
                                    <input id="file-upload" type="file" name="new-dog-file" hidden>
                                    <label for="file-upload" class="dog-photo-upload">
                                        <i class="fa fa-cloud-upload"></i>
                                        <span id="file-chosen">Upload dog photo</span>
                                    </label>
                                    <button type="submit" class="blue-button">Add doggy</button>
                                </form>
                            </div>
                        </div>
                        <div class="my-doggy-content" id="my-doggy-content-container">
                            <div class="doggy-name-container">
                                <h1 id="dog-name">Binka</h1>
                            </div>
                            <div class="doggy-info-container">
                                <div class="left-dog-info">
                                    <div class="dog-size-box">
                                        <div class="upper-box">
                                            Size
                                        </div>
                                        <div class="lower-box">
                                            <p id="dog-size">Small</p>
                                        </div>
                                    </div>
                                    <div class="dog-breed-box">
                                        <div class="upper-box">
                                            Breed
                                        </div>
                                        <div class="lower-box">
                                            <p id="dog-breed">Mongrel</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dog-photo-box">
                                    <div class="dog-photo"></div>
                                </div>
                                <div class="right-dog-info">
                                    <div class="dog-age-box">
                                        <div class="upper-box">
                                            Age
                                        </div>
                                        <div class="lower-box">
                                            <p id="dog-age">12</p>
                                        </div>
                                    </div>
                                    <div class="dog-gender-box">
                                        <div class="upper-box">
                                            Gender
                                        </div>
                                        <div class="lower-box">
                                            <p id="dog-gender">Female</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doggy-description-container">
                                <div class="description-box">
                                    <div class="description-upper-box">
                                        Description
                                    </div>
                                    <div class="description-lower-box">
                                        <p id="dog-description">Binia to piękny piesek kochający czekoladę. 🎂</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-container" id="settings-container">
                        <div class="settings-content">
                            <div class="password-change-container">
                                <h1>Change password</h1>
                                <hr class="separate-bar">
                                <form action="" class="password-change-form">
                                    <input type="text" placeholder="Current password">
                                    <input type="text" placeholder="New password">
                                    <input type="text" placeholder="Repeat new password">
                                    <button class="blue-button">Change</button>
                                </form>
                            </div>
                            <div class="city-change-container">
                                <h1>Change city</h1>
                                <hr class="separate-bar">
                                <form action="" class="city-change-form">
                                    <select name="city-select" id="">
                                        <option value="krakow">Kraków</option>
                                    </select>
                                    <button class="blue-button">Change</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="public/js/menu-bar.js"></script>
    <script src="public/js/cover-functions.js"></script>
    <script src="public/js/content-saver.js"></script>
</body>