<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Crypter.php';
require_once __DIR__ . '/../models/Place.php';
require_once __DIR__ . '/../models/Walk.php';

class PlaceRepository extends Repository
{

    public function getPlace() {
        $place_id = $this->crypter->decryptID($_COOKIE['chosen_place']);

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.places WHERE id_place = :id');
        $stmt->bindParam(":id", $place_id, PDO::PARAM_INT);
        $stmt->execute();

        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$place) {
            return null;
        }

        return new Place($place['name']);
    }

    public function goForAWalk(Walk $walk) {

        $conn = $this->database->connect();

        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare('INSERT INTO active_walks (id_place, time_of_walk, id_user) VALUES (?, ?, ?)');
            $stmt->execute([$walk->getPlaceID(), $walk->getApproximateTime(), $walk->getUserID()]);
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            return null;
        }
    }

    public function isUserOnAWalk(int $userID): bool
    {
        $stmt = $this->database->connect()->prepare('SELECT * FROM active_walks WHERE id_user = :id');
        $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
        $stmt->execute();

        $walk = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($walk)
            return true;
        else
            return false;
    }

    public function getPlaceID(string $placeName) {
        $placeName .= "%";

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.places WHERE photo LIKE :name');
        $stmt->bindParam(":name", $placeName);
        $stmt->execute();

        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        $placeID = $this->crypter->encryptID($place['id_place']);

        echo json_encode($placeID);
    }

    public function getDogsHere(): array {

        $place_id = $this->crypter->decryptID($_COOKIE['chosen_place']);

        $stmt = $this->database->connect()->prepare(
            "SELECT aw.id_active_walk, aw.time_of_walk, aw.started_at, time 'now()' as now, d.name AS dog_name, db.name AS dog_breed, ds.name AS dog_size, age, gender
                    FROM dogs d
                        JOIN dogs_breed db on d.id_breed = db.id_dog_breed
                        JOIN dogs_sizes ds on ds.id_dog_size = db.id_dog_size
                        JOIN users u on d.id_user = u.id_user
                        JOIN active_walks aw on u.id_user = aw.id_user
                            WHERE aw.id_place = :id");

        $stmt->bindParam(":id", $place_id);
        $stmt->execute();

        $dogs = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $timeLeft = date("H:i:s", strtotime($row['time_of_walk']) - (strtotime($row['now']) - strtotime($row['started_at'])));

            if ($row['time_of_walk'] < $timeLeft) {
                $this->deleteActiveWalk($row['id_active_walk']);
            } else {
                array_push($dogs, $row);
            }
        }

        return $dogs;
    }

    public function getPlacePhoto() {
        $user_id = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare('SELECT photo FROM active_walks JOIN places p on p.id_place = active_walks.id_place WHERE id_user = :id');
        $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$place) {
            return null;
        }

        echo json_encode($place['photo']);
    }

    public function getActiveWalk() {
        $userID = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare("SELECT p.name, p.id_place, time_of_walk, started_at, time 'now()' as now FROM places p JOIN active_walks aw on p.id_place = aw.id_place WHERE id_user = :id");
        $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
        $stmt->execute();

        $activeWalk = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$activeWalk) {
            return null;
        }

        $timeLeft = date("H:i:s", strtotime($activeWalk['time_of_walk']) - (strtotime($activeWalk['now']) - strtotime($activeWalk['started_at'])));


        if ($activeWalk['time_of_walk'] < $timeLeft) {
            $deleteStmt = $this->database->connect()->prepare('DELETE FROM active_walks WHERE id_user = :id');
            $deleteStmt->bindParam(":id", $userID, PDO::PARAM_INT);
            $deleteStmt->execute();
            return null;
        }

        $walk = new Walk($userID, $activeWalk['id_place'], $activeWalk['time_of_walk']);

        $walk->setPlaceName($activeWalk['name']);
        $walk->setTimeLeft($timeLeft);

        return $walk;
    }

    public function endTheWalk() {
        $userID = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $stmt = $this->database->connect()->prepare("DELETE FROM public.active_walks WHERE id_user = :id");
        $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function deleteActiveWalk(int $walkID) {
        $deleteStmt = $this->database->connect()->prepare('DELETE FROM active_walks WHERE id_active_walk = :id');
        $deleteStmt->bindParam(":id", $walkID, PDO::PARAM_INT);
        $deleteStmt->execute();
    }

    public function addNewPlaceIdea(Place $place) {
        $userID = $this->crypter->decryptID($_COOKIE['user_enabled']);

        $conn = $this->database->connect();

        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare('INSERT INTO new_places_ideas (city, name, street, id_user) VALUES (?, ?, ?, ?)');
            $stmt->execute([$place->getCity(), $place->getName(), $place->getStreet(), $userID]);
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
        }
    }

    public function getPlacesIdeas(): array
    {

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.new_places_ideas');
        $stmt->execute();

        $places = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($places, $row);
        }

        return $places;
    }

}