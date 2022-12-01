<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../configs/utils.php";
require_once "../configs/methods.php";
require_once "../main/factories/clients-controller-factory.php";
require_once "../main/factories/auth-middleware-factory.php";

$middleware = makeAuthMiddleware();
$controller = makeClientController();


if (isMetodo("GET")) {
    try {
        
        $headers = apache_request_headers();
         var_dump($headers);
        $isValidAuth = $middleware->validateAuth($headers);
        if (!$isValidAuth) responder (401, ["Message" => "Unauthorized"]);
        $clients = $controller->getAll();
        if ($clients) {
            $jsonClients = array();
            foreach($clients as $client) {
                $name = $client->getName();
                $email = $client->getEmail();
                $phone = $client->getPhone();
                $createdAt = $client->getCreatedAt();
                $id = $client->getId();
                array_push($jsonClients, array("name"=>$name, "email"=>$email, "phone"=> $phone, "id" => $id, "createdAt" => $createdAt));   
            }
            $msg = ["clients" => $jsonClients];
            responder(200, $msg);
        } else {
            responder(204, null);
        }
    } catch(Exception $e) {
        $msg = ["message" => "Internal Server Error"];
        responder(500, $msg);
    }
}

if (isMetodo("POST")) {
    try {
        $headers = apache_request_headers();
        
        $isValidAuth = $middleware->validateAuth($headers);
        if (!$isValidAuth) responder (401, ["Message" => "Unauthorized"]);
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response = $controller->create($_POST);
        if (gettype($response) === 'string') responder(400, ["Missing Param:" => $response]);
        responder(201, null);
    } catch(Exception $e) {
        $msg = ["message" => "Internal Server Error"];
        responder(500, $e->getMessage());
    }
}

if (isMetodo("DELETE")) {
    try {
        $headers = apache_request_headers();
        $isValidAuth = $middleware->validateAuth($headers);
        if (!$isValidAuth) responder (401, ["Message" => "Unauthorized"]);
        $response = $controller->delete($_GET);
        if (gettype($response) === 'string') responder(400, ["Missing Param:" => $response]);
        if (!$response) responder(404, null);
        responder(204, null);
    } catch(Exception $e) {
        $msg = ["message" => "Internal Server Error"];
        responder(500, $e->getMessage());
    }
} 