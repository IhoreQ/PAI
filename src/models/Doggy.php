<?php

class Doggy {
    private $name;
    private $age;
    private $breed;
    private $gender;
    private $size;
    private $description;
    private $photo;

    public function __construct($name, $age, $breed, $gender, $size, $description, $photo)
    {
        $this->name = $name;
        $this->age = $age;
        $this->breed = $breed;
        $this->gender = $gender;
        $this->size = $size;
        $this->description = $description;
        $this->photo = $photo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age)
    {
        $this->age = $age;
    }

    public function getBreed(): string
    {
        return $this->breed;
    }

    public function setBreed(string $breed)
    {
        $this->breed = $breed;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size)
    {
        $this->size = $size;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }


}