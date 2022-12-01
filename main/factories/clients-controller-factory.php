<?php 

include_once(dirname(__FILE__) . "../../../infra/connection/MySqlConnection.php");
include_once(dirname(__FILE__) . "../../../infra/repositories/client-repository.php");
include_once(dirname(__FILE__) . "../../../domain/services/client-service.php");
include_once(dirname(__FILE__) .  "../../../presentation/controllers/client-controller.php");

function makeClientController() {
    $connection = MySqlConnection::getConnection();
    $repo = new ClientRepository($connection);
    $service = new ClientService($repo);
    $controller = new ClientController($service);
    return $controller;
}


?>