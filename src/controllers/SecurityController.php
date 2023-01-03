<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Crypter.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    public function register() {

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $nameRegex = "/^(?=.{1,256}$)[A-ZĆŁŚŻŹa-ząćęńóśżź\\p{L}]+['\-]?[A-ZĆŁŚŻŹa-ząćęńóśżź]+/";
        $emailRegex = "/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";
        $passwordRegex = "/(?=.{8,}).*/";

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!preg_match($nameRegex, $name) || !preg_match($nameRegex, $surname)) {
            return $this->render('register', ['messages' => ['Name or surname is incorrect!']]);
        }

        if (!preg_match($emailRegex, $email)) {
            return $this->render('register', ['messages' => ['Email is incorrect!']]);
        }

        if (!preg_match($passwordRegex, $password)) {
            return $this->render('register', ['messages' => ['Password must contain at least 8 characters!']]);
        }

        $name = ucfirst(strtolower($name));
        $surname = ucfirst(strtolower($surname));

        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $userRepository = new UserRepository();

        $existingUser = $userRepository->getUser($email);
        if ($existingUser) {
            return $this->render('register', ['messages' => ['This email is already taken!']]);
        }

        $user = new User($email, $password, $name, $surname);
        $userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";

        header("Location: {$url}/login");
    }

    public function login() {

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }   

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        $userPassword = $user->getPassword();
        if (!password_verify($password, $userPassword)) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $crypter = new Crypter();

        $cookie_name = "user_enabled";
        $cookie_value = $crypter->encryptUserID($userRepository->getUserID($user->getEmail()));
        setcookie($cookie_name, $cookie_value, 0, '/');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function checkRole() {
        $userRepository = new UserRepository();
        echo json_encode($userRepository->getRole());
        http_response_code(200);
    }

    public function changePassword() {

        if (!$this->isPost()) {
            return $this->render("home");
        }

        $passwordRegex = "/(?=.{8,}).*/";

        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $repeatedNewPassword = $_POST['repeatedNewPassword'];

        if (!preg_match($passwordRegex, $newPassword)) {
            return $this->render('home', ['messages' => ['Password must contain at least 8 characters!']]);
        }

        if ($newPassword != $repeatedNewPassword) {
            return $this->render("home", ['messages' => ["Passwords are not the same!"]]);
        }

        $userRepo = new UserRepository();
        $userPassword = $userRepo->getUserPassword();

        if (!password_verify($currentPassword, $userPassword)) {
            return $this->render('home', ['messages' => ['Current password is wrong!']]);
        }

        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 10]);

        $userRepo->changePassword($newPassword);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
}