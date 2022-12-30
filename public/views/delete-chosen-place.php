<?php

    if (isset($_COOKIE['chosen_place'])) {
        setcookie("chosen_place", "", time() - 3600);
    }