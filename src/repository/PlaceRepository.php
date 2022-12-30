<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Crypter.php';

class PlaceRepository extends Repository {

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


}