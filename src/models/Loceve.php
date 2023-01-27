<?php

namespace models;

class Loceve
{
    private $name;
    private $description;
    private $image;
    private $website;
    private $price;
    private $rating;
    private $event;
    private $iWasThere = false;

    public function __construct($name, $description, $image, $website, $price, $rating, $event, $iWasThere = false)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->website = $website;
        $this->price = $price;
        $this->rating = $rating;
        $this->event = $event;
        $this->iWasThere = $iWasThere;
    }


    public function getName() :string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getDescription() :string
    {
        return $this->description;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public function getImage() :string
    {
        return $this->image;
    }


    public function setImage(string $image): void
    {
        $this->image = $image;
    }


    public function getWebsite() :string
    {
        return $this->website;
    }


    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }


    public function getPrice() :int
    {
        return $this->price;
    }


    public function setPrice(int $price): void
    {
        $this->price = $price;
    }


    public function getRating() :float
    {
        return $this->rating;
    }


    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    public function getEvent(): bool
    {
        return $this->event;
    }

    public function setEvent(bool $event): void
    {
        $this->event = $event;
    }


    public function getIWasThere(): bool
    {
        return $this->iWasThere;
    }


    public function setIWasThere(bool $iWasThere): void
    {
        $this->iWasThere = $iWasThere;
    }





}