<?php

    if (!isset($_COOKIE["user_enabled"])) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }