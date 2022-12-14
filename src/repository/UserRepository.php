<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email) {

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.users WHERE email = :email'
        );

        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM users u JOIN users_details ud ON u.id_user_details = ud.id_user_details WHERE u.id_user = :id;'
        );

        $userDetailsID = $user['id_user'];

        $statement->bindParam(':id', $userDetailsID, PDO::PARAM_INT);
        $statement->execute();

        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);


        if (!$user || !$userDetails) {
            // TODO rzucenie wyjątku zamiast null
            return null;
        }

        return new User($userDetails['email'], $userDetails['password'], $userDetails['name'], $userDetails['surname']);
    }


}