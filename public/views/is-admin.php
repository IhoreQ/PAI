<?php
    $userRepo = new UserRepository();
    $value = $userRepo->getRole();

    if ($value != 2) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }