<?php 

class Doctor {
    private $id;
    private $name;
    private $email;
    private $createdAt;
    private $speciality;


    function __construct($name, $email, $speciality) {
        $this->name = $name;
        $this->setEmail($email);
        $this->speciality = $speciality;
    }

    function setCreatedAt ($createdAt) {
        $this->createdAt = $createdAt;
    }

    function setSpeciality($speciality) {
        $this->speciality = $speciality;
    }

    function setId ($id) {
        $this->id = $id;
    }

    function getId () {
        return $this->id;
    }

    function getName () {
        return $this->name;
    }

    function getEmail () {
        return $this->email;
    }

    function getCreatedAt () {
        return $this->createdAt;
    }

    function getSpeciality() {
        return $this->speciality;
    }

    
    function setName ($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($isValidEmail) {
            $this->email = $email;
        } else {
            throw new ErrorException('O campo email deve ser um e-mail válido.');
        }
    }
}

?>