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

    public function getUserPassword() {

        $userID = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare('SELECT password FROM public.users WHERE id_user = :id');
        $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return $user['password'];
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

    public function getRole() {

        $userID = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare('SELECT r.id_role FROM public.users JOIN roles r on users.id_role = r.id_role WHERE id_user = :id');
        $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return $user['id_role'];
    }

    public function changePassword($newPassword) {

        $userID = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $conn = $this->database->connect();

        try {
            $conn->beginTransaction();

            $stmt = $conn->prepare('UPDATE public.users SET password = :newPassword WHERE id_user = :id');
            $stmt->bindParam(":newPassword", $newPassword);
            $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
            $stmt->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
        }
    }
}