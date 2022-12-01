<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Token, Authorization, X-Requested-With");

require_once "../configs/utils.php";
require_once "../configs/methods.php";
require_once "../main/factories/doctor-controller-factory.php";
require_once "../main/factories/auth-middleware-factory.php";

$middleware = makeAuthMiddleware();
$controller = makeDoctorController();



if (isMetodo("GET")) {
    try {
        $headers = apache_request_headers();
        $isValidAuth = $middleware->validateAuth($headers);
        if (!$isValidAuth) responder (401, ["Message" => "Unauthorized"]);
        $doctors = $controller->getAll();
        if ($doctors) {
            $jsonDoctors = array();
            foreach($doctors as $doctor) {
                $name = $doctor->getName();
                $email = $doctor->getEmail();
                $speciality = $doctor->getSpeciality();
                $createdAt = $doctor->getCreatedAt();
                $id = $doctor->getId();
                array_push($jsonDoctors, array("name"=>$name, "email"=>$email, "speciality"=> $speciality, "id" => $id, "createdAt" => $createdAt));   
            }
            $msg = ["doctors" => $jsonDoctors];
            responder(200, $msg);
        } else {
            responder(204, null);
        }
    } catch(Exception $e) {
        $msg = ["message" => "Internal Server Error"];
        responder(500, $e->getMessage());
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
        responder(204, null);
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