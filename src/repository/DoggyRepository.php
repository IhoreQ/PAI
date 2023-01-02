<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Doggy.php';
require_once __DIR__.'/../models/Crypter.php';

class DoggyRepository extends Repository {

    public function getDoggy() {

        // Pobranie psa
        $crypter = new Crypter();
        $user_id = $crypter->decryptUserID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE id_user = :id');
        $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['has_dog'] == 1) {
            $statement = $this->database->connect()->prepare(
                'SELECT d.name AS dog_name, db.name AS breed_name, ds.name AS size_name, age, gender, description, photo FROM dogs d JOIN dogs_breed db on d.id_breed = db.id_dog_breed JOIN dogs_sizes ds on db.id_dog_size = ds.id_dog_size WHERE d.id_user = :id;'
            );
            $statement->bindParam(':id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            $doggy = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$doggy) {
                // TODO rzucenie wyjątku zamiast null
                return null;
            }

            if ($doggy['gender'] == 1) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }

            return new Doggy($doggy['dog_name'], $doggy['age'], $doggy['breed_name'], $gender, $doggy['size_name'], $doggy['description'], $doggy['photo']);
        } else {
            return false;
        }
    }

    public function addDoggy(Doggy $doggy) {

        if ($doggy->getGender() == "male")
            $gender = 1;
        else
            $gender = 0;

        $breed = ucfirst($doggy->getBreed());

        $statement = $this->database->connect()->prepare('SELECT * FROM dogs_breed WHERE name = :param_name');
        $statement->bindParam(':param_name', $breed);
        $statement->execute();
        $breed_info = $statement->fetch(PDO::FETCH_ASSOC);

        $crypter = new Crypter();
        $user_id = $crypter->decryptUserID($_COOKIE['user_enabled']);

        $statement = $this->database->connect()->prepare(
            'INSERT INTO dogs (name, age, id_breed, gender, description, photo, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $statement->execute([$doggy->getName(), $doggy->getAge(), $breed_info['id_dog_breed'], $gender, $doggy->getDescription(), $doggy->getPhoto(), $user_id]);

        $this->updateUserDog($user_id);
    }

    public function getBreeds(): array
    {
        $stmt = $this->database->connect()->prepare('SELECT dogs_breed.name FROM public.dogs_breed ORDER BY id_dog_breed');
        $stmt->execute();

        $names = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($names, $row);
        }

        return $names;
    }

    private function updateUserDog(int $user_id) {
        $statement = $this->database->connect()->prepare('UPDATE users SET has_dog = true WHERE id_user = :id');
        $statement->bindParam(':id', $user_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getUserDogPhoto() {
        $crypter = new Crypter();
        $user_id = $crypter->decryptUserID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare('SELECT * FROM dogs WHERE id_user = :id');
        $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $dog = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dog) {
            return null;
        }

        echo json_encode($dog['photo']);
    }

    public function getIfUserHasDog() {
        $crypter = new Crypter();
        $user_id = $crypter->decryptUserID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE id_user = :id');
        $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        echo json_encode($user['has_dog']);
    }
}