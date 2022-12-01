<?php 

class Admin {
    private $id;
    private $email;
    private $password;
    private $createdAt;
    private $token;

    function __construct($email, $password) {
        $this->setEmail($email);
        $this->password = $password;
    }

    function setCreatedAt ($createdAt) {
        $this->createdAt = $createdAt;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function getToken() {
        return $this->token;
    }

    function setId ($id) {
        $this->id = $id;
    }

    function getId () {
        return $this->id;
    }


    function getEmail () {
        return $this->email;
    }

    function getCreatedAt () {
        return $this->createdAt;
    }

    
    function getPassword () {
        return $this->password;
    }


    function setPassword($password) {
        $this->password = $password;
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