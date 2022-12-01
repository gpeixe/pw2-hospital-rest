<?php

require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;

class JwtAdapter {
    private $secret;

    function __construct($secret) {
        $this->secret =  $secret;
    }

    function generateToken($email) {
        $now = new DateTimeImmutable();
        $exp = $now->modify("+60 minutes")->getTimestamp();
        $claims = [
            "iat" => $now->getTimestamp(),
            "iss" => "localhost",
            "nbf" => $now->getTimestamp(),
            "exp" => $exp,
            "sub" => $email
            ];
        $token = JWT::encode($claims, $this->secret, 'HS512');
        return $token;
    }

}

?>