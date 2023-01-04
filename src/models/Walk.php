<?php

class Walk {

    private $userID;
    private $placeID;
    private $approximateTime;
    private $timeLeft;
    private $placeName;

    public function __construct($userID, $placeID, $approximateTime)
    {
        $this->userID = $userID;
        $this->placeID = $placeID;
        $this->approximateTime = $approximateTime;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getPlaceID()
    {
        return $this->placeID;
    }

    public function getApproximateTime()
    {
        return $this->approximateTime;
    }

    public function setTimeLeft($timeLeft) {
        $this->timeLeft = $timeLeft;
    }

    public function getTimeLeft()
    {
        return $this->timeLeft;
    }

    public function getPlaceName()
    {
        return $this->placeName;
    }

    public function setPlaceName($placeName)
    {
        $this->placeName = $placeName;
    }



}