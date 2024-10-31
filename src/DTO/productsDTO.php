<?php

namespace App\DTO;

class productsDTO
{
    public $id;
    public $title;
    public $categories;
    public $priceWithDiscount;
    public $price;
    public $description;
    public $discount;
    public $image;

    public function __construct( int $id,
    string $title,
    string $categories,
    float $priceWithDiscount,
    float $price,
    string $description,
    bool $discount,
    string $image)
    {
        $this->id = $id;
        $this->title= $title;
        $this->categories =$categories;
        $this->priceWithDiscount = $priceWithDiscount;
        $this->price = $price;
        $this->description = $description;
        $this->discount = $discount;
        $this->image = $image;
    }
    public function getTitle() { return $this->title; }
    public function getCategories() { return $this->categories; }
    public function getPriceWithDiscount() { return $this->priceWithDiscount; }
    public function getPrice() { return $this->price; }
    public function getDescription() { return $this->description; }
    public function getDiscount() { return $this->discount; }
    public function getImageName() { return $this->image; }
}?>
    