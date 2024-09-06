<?php

class Product{
    public $id;
    public $title;
    public $img;
    public $price;
    public $description;

    public function __construct($id, $title, $img, $price, $description)
    {
        $this->id = $id;

        $this->title = $title;
        $this->img = $img;
        $this->price = $price;
        $this->description = $description;
    }
}