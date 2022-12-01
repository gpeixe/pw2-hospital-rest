<?php 

class Client {
    private $id;
    private $name;
    private $email;
    private $phone;
    private $createdAt;

    function __construct($name, $email, $phone) {
        $this->name = $name;
        $this->setEmail($email);
        $this->setPhone($phone);
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function getPhone() {
        return $this->phone;
    }

    function setCreatedAt ($createdAt) {
        $this->createdAt = $createdAt;
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