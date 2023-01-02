<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Crypter.php';
require_once __DIR__.'/../models/Walk.php';
require_once __DIR__.'/../repository/CityRepository.php';
require_once __DIR__.'/../repository/PlaceRepository.php';
require_once __DIR__.'/../repository/DoggyRepository.php';

class WalkController extends AppController {

    private $placeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->placeRepository = new PlaceRepository();
    }


    public function goForAWalk() {

        if (!$this->isPost()) {
            return $this->render("place");
        }

        $walkTime = $_POST['walk-time'];

        $crypter = new Crypter();
        $userID = $crypter->decryptUserID($_COOKIE['user_enabled']);
        $placeID = $crypter->decryptUserID($_COOKIE['chosen_place']);

        $doggyRepo = new DoggyRepository();
        $dog = $doggyRepo->getDoggy();

        if (!$dog) {
            return $this->render("place", ['messages' => ["You don't have a dog!"]]);
        }

        if (!$userID || !$placeID || !$walkTime) {
            return $this->render("place", ['messages' => ['User or place not found!']]);
        }

        $user = $this->placeRepository->isUserOnAWalk($userID);

        if ($user) {
            return $this->render("place", ['messages' => ['You are already on a walk!']]);
        }

        $this->placeRepository->goForAWalk(new Walk($userID, $placeID, $walkTime));

        $url = "http://$_SERVER[HTTP_HOST]";

        header("Location: {$url}/home");
    }

    public function getPlaceID(string $placeName) {
        $this->placeRepository->getPlaceID($placeName);
        http_response_code(200);
    }

    public function isUserOnAWalk() {
        $crypter = new Crypter();
        $userID = $crypter->decryptUserID($_COOKIE['user_enabled']);

        $onAWalk = $this->placeRepository->isUserOnAWalk($userID);

        if ($onAWalk) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

        http_response_code(200);
    }

    public function getPlacePhoto() {
        $this->placeRepository->getPlacePhoto();
        http_response_code(200);
    }

    public function endTheWalk() {
        $this->placeRepository->endTheWalk();
        http_response_code(200);
    }

    public function newPlaceIdea() {

        if (!$this->isPost()) {
            return $this->render("home");
        }

        $place = new Place($_POST['place-idea-name']);
        $place->setCity($_POST['place-idea-city']);
        $place->setStreet($_POST['place-idea-street']);

        $this->placeRepository->addNewPlaceIdea($place);

        $url = "http://$_SERVER[HTTP_HOST]";

        header("Location: {$url}/home");
    }

}