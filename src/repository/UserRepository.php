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
            'SELECT * FROM users u JOIN users_details ud ON u.id_user = ud.id_user WHERE u.id_user = :id;'
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

    public function addUser(User $user) {

        $conn = $this->database->connect();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare('INSERT INTO public.users (email, password) VALUES (?, ?)');
            $stmt->execute([$user->getEmail(), $user->getPassword()]);
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            return null;
        }

        $userID = $this->getUserID($user->getEmail());

        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare('INSERT INTO public.users_details (name, surname, id_user) VALUES (?, ?, ?)');
            $stmt->execute([$user->getName(), $user->getSurname(), $userID]);
            $conn->commit();
        } catch(PDOException $e) {
            $conn->rollBack();
        }

    }

    public function getUserID(string $email) {
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return $user['id_user'];
    }

    public function hasDog(int $user_id): bool {

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.users WHERE id_user = :id');
        $stmt->bindParam(":id", $user_id);
        $stmt->execute();

        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        return $userInfo['has_dog'];
    }

}