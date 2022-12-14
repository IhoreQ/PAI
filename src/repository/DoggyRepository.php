<?php

class DoggyRepository extends Repository {

    public function getDoggy(int $id) {

        // Pobranie psa
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.dogs WHERE id_dog = :id'
        );
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $doggy = $statement->fetch(PDO::FETCH_ASSOC);

        // Pobranie rasy psa
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.dogs_breed WHERE id_dog_breed = :id'
        );
        $statement->bindParam(':id', $doggy['id_breed'], PDO::PARAM_INT);
        $statement->execute();
        $doggy_breed = $statement->fetch(PDO::FETCH_ASSOC);

        // Pobranie wielkości psa
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.dogs_sizes WHERE id_dog_size = :id'
        );
        $statement->bindParam(':id', $doggy_breed['id_dog_size'], PDO::PARAM_INT);
        $statement->execute();
        $doggy_size = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$doggy || !$doggy_breed) {
            // TODO rzucenie wyjątku zamiast null
            return null;
        }

        return new Doggy($doggy['name'], $doggy['age'], $doggy_breed['name'], $doggy['gender'], $doggy_size['name'], $doggy['description'], $doggy['photo']);
    }

    public function addDoggy(Doggy $doggy) {

        $statement = $this->database->connect()->prepare(
          'SELECT * FROM dogs_breed WHERE name = :param_name'
        );

        if ($doggy->getGender() == "Male")
            $gender = true;
        else
            $gender = false;

        $breed = $doggy->getBreed();

        $statement->bindParam(':param_name', $breed);
        $statement->execute();
        $breed_id = $statement->fetch(PDO::FETCH_ASSOC);

        // TODO pobieranie z sesji
        $user_id = 1;

        $statement = $this->database->connect()->prepare(
            'INSERT INTO dogs (name, age, id_breed, gender, description, photo, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $statement->execute([$doggy->getName(), $doggy->getAge(), $breed_id, $gender, $doggy->getDescription(), $doggy->getPhoto(), $user_id]);

    }

}