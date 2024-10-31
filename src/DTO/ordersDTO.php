<?php

namespace App\DTO;

class ordersDTO
{
    public $id;
    public $states;
    public $isCreatedAt;

    public function __construct( int $id,
    string $states,
    object $isCreatedAt,
    )
    {
        $this->id = $id;
        $this->states= $states;
        $this->isCreatedAt =$isCreatedAt;
    }
    public function getId() { return $this->id; }
    public function getStates() { return $this->states; }
    public function getIsCreatedAt() { return $this->isCreatedAt; }

}?>
    