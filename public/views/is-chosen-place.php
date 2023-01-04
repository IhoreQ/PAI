<?php
    if (!isset($_COOKIE["chosen_place"])) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
