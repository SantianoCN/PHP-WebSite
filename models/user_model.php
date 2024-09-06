<?php

class User {
    public $clientid;
    public $name;
    public $email;
    public $address;
    public function __construct($name, $email, $address){
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;

        $this->clientid = uniqid();
    }
}