<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Crypter.php';
require_once __DIR__.'/../models/Place.php';

class PlaceRepository extends Repository {

    public function getPlace() {

        $crypter = new Crypter();
        $place_id = $crypter->decryptUserID($_COOKIE['chosen_place']);

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.places WHERE id_place = :id');
        $stmt->bindParam(":id", $place_id, PDO::PARAM_INT);
        $stmt->execute();

        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$place) {
            return null;
        }

        return new Place($place['name']);
    }

    public function getPlaceID(string $placeName) {

        $crypter = new Crypter();
        $placeName .= "%";

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.places WHERE photo LIKE :name');
        $stmt->bindParam(":name", $placeName);
        $stmt->execute();

        $place = $stmt->fetch(PDO::FETCH_ASSOC);


        $placeID = $crypter->encryptUserID($place['id_place']);
        echo json_encode($placeID);
    }

    public function getDogsHere() {
        $crypter = new Crypter();

        $place_id = $crypter->decryptUserID($_COOKIE['chosen_place']);

        $stmt = $this->database->connect()->prepare(
            'SELECT d.name AS dog_name, db.name AS dog_breed, ds.name AS dog_size, age, gender
                    FROM dogs d
                        JOIN dogs_breed db on d.id_breed = db.id_dog_breed
                        JOIN dogs_sizes ds on db.id_dog_size = ds.id_dog_size
                        JOIN users u on d.id_user = u.id_user
                        JOIN users_details ud on u.id_user = ud.id_user
                        JOIN active_walks aw on aw.id_active_walk = ud.id_active_walk
                            WHERE aw.id_place = :id;');

        $stmt->bindParam(":id", $place_id);
        $stmt->execute();

        $dogs = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($dogs, $row);
        }

        return $dogs;
    }
}