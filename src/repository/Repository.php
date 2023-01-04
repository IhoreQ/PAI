<?php

require_once __DIR__.'/../../Database.php';
require_once __DIR__.'/../models/Crypter.php';

class Repository {

    protected $database;
    protected $crypter;

    public function __construct()
    {
        $this->database =  new Database();
        $this->crypter = new Crypter();
    }


}