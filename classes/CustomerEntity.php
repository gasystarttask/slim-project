<?php

class CustomerEntity {
  protected $id;
  protected $first_name;
  protected $last_name;
  protected $phone;
  protected $email;
  protected $address;
  protected $city;
  protected $state;

  public function __construct(array $data) {
    if(isset($data['id'])) {
      $this->id = $data['id'];
    }

    $this->first_name = $data['first_name'];
    $this->last_name  = $data['last_name'];
    $this->phone   = $data['phone'];
    $this->email   = $data['email'];
    $this->address = $data['address'];
    $this->city  = $data['city'];
    $this->state = $data['state'];
  }

  public function getId() {
    return $this->id;
  }

  public function getFirstName() {
    return $this->first_name;
  }

  public function getLastName() {
    return $this->last_name;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getEmail() {
    return $this->email;
  }
  
  public function getAddress() {
    return $this->address;
  }

  public function getCity() {
    return $this->city;
  }

  public function getState() {
    return $this->state;
  }
}