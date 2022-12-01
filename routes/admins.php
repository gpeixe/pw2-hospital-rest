<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Token");

require_once "../configs/utils.php";
require_once "../configs/methods.php";
require_once "../main/factories/admin-controller-factory.php";
require_once "../main/factories/auth-middleware-factory.php";

$middleware = makeAuthMiddleware();
$controller = makeAdminController();

if (isMetodo("POST")) {
    try {
        $headers = apache_request_headers();
        $isValidAuth = $middleware->validateAuth($headers);
        if (!$isValidAuth) responder (401, ["Message" => "Unauthorized"]);
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response = $controller->create($_POST);
        if (gettype($response) === 'string') responder(400, ["Missing Param:" => $response]);
        responder(204, null);
    } catch(Exception $e) {
        $msg = ["message" => "Internal Server Error"];
        responder(500, $e->getMessage());
    }
}

if (isMetodo("PUT")) {
    try {
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $response = $controller->login($_PUT);
        if (gettype($response) === 'boolean' && !$response) responder(401, ["Error" => "Password or wrong email."]);
        responder(200, ["jwt" => $response]);
    } catch(Exception $e) {
        $msg = ["message" => "Internal Server Error"];
        responder(500, $e->getMessage());
    }
}

