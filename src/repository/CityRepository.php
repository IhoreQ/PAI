<?php

require_once 'Repository.php';
class CityRepository extends Repository {

    public function getCities(): array
    {
        $stmt = $this->database->connect()->prepare('SELECT cities.name FROM public.cities ORDER BY id_city');
        $stmt->execute();

        $names = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($names, $row);
        }

        return $names;
    }

}