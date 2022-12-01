<?php 

include_once(dirname(__FILE__) . "../../../infra/connection/MySqlConnection.php");
include_once(dirname(__FILE__) . "../../../infra/repositories/doctor-repository.php");
include_once(dirname(__FILE__) . "../../../domain/services/doctor-service.php");
include_once(dirname(__FILE__) .  "../../../presentation/controllers/doctor-controller.php");

function makeDoctorController() {
    $connection = MySqlConnection::getConnection();
    $repo = new DoctorRepository($connection);
    $service = new DoctorService($repo);
    $controller = new DoctorController($service);
    return $controller;
}


?>