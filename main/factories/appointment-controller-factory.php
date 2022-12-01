<?php 

include_once(dirname(__FILE__) . "../../../infra/connection/MySqlConnection.php");
include_once(dirname(__FILE__) . "../../../infra/repositories/appointment-repository.php");
include_once(dirname(__FILE__) . "../../../domain/services/appointment-service.php");
include_once(dirname(__FILE__) .  "../../../presentation/controllers/appointment-controller.php");

function makeAppointmentController() {
    $connection = MySqlConnection::getConnection();
    $repo = new AppointmentRepository($connection);
    $service = new AppointmentService($repo);
    $controller = new AppointmentController($service);
    return $controller;
}


?>