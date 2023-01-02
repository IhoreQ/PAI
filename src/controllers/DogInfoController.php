<?php

require_once 'AppController.php';
require_once 'WalkController.php';
require_once __DIR__.'/../models/Doggy.php';
require_once __DIR__.'/../repository/DoggyRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/CityRepository.php';
require_once __DIR__.'/../repository/PlaceRepository.php';

class DogInfoController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $doggyRepository;

    public function __construct() {
        parent::__construct();
        $this->doggyRepository = new DoggyRepository();
    }

    public function addDog() {

        if (!$this->isPost()) {
            return $this->render("home");
        }

        if (is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']) && !$this->hasDog()) {

            $nameRegex = "/^(?=.{1,256}$)[A-ZĆŁŚŻŹa-ząćęńóśżź\\p{L}]+['\-]?[A-ZĆŁŚŻŹa-ząćęńóśżź]+/";

            if (!preg_match($nameRegex, $_POST['new-dog-name'])) {
                return $this->render("home", ['messages' => ["Name is incorrect!"]]);
            }

            //$doggyName = ucfirst(strtolower($_POST['new-dog-name'])); // JAKBY NIE DZIAŁAŁO TO PONIŻEJ
            $doggyName = $_POST['new-dog-name'];

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $doggy = new Doggy($doggyName, $_POST['new-dog-age'],
                                $_POST['new-dog-breed'], $_POST['new-dog-gender'],
                                $_POST['new-dog-size'], $_POST['new-dog-description'], $_FILES['file']['name']);

            $this->doggyRepository->addDoggy($doggy);
        }

        $url = "http://$_SERVER[HTTP_HOST]";

        header("Location: {$url}/home");
    }

    private function validate(array $file): bool {

        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = "File is too large for destination file system.";
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = "File type is not supported.";
            return false;
        }

        return true;
    }

    private function hasDog(): bool {
        $crypter = new Crypter();
        $user_id = $crypter->decryptUserID($_COOKIE['user_enabled']);


        $userRepository = new UserRepository();

        if ($userRepository->hasDog($user_id)) {
            $this->messages[] = "You already have a doggy!";
            return true;
        }

        return false;
    }

    public function getUserDogPhoto() {
        $this->doggyRepository->getUserDogPhoto();
        http_response_code(200);
    }

    public function getIfUserHasDog() {
        $this->doggyRepository->getIfUserHasDog();
        http_response_code(150);
    }

    public function removeDog() {
        $this->doggyRepository->removeDog();
        http_response_code(200);
    }
}