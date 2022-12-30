<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/CityRepository.php';
require_once __DIR__.'/../repository/PlaceRepository.php';

class WalkController extends AppController {

    private $placeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->placeRepository = new PlaceRepository();
    }


    public function goForAWalk() {

    }

    public function getPlaceID(string $placeName) {
        $this->placeRepository->getPlaceID($placeName);
        http_response_code(200);
    }

}