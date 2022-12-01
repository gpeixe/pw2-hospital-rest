<?php

include_once(dirname(__FILE__) . "/controller.php");

class AppointmentController extends Controller
{
    private $appointmentService;

    function __construct($appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    function getAll()
    {
        $appointments =  $this->appointmentService->getAll();
        if ($appointments && count($appointments)) return $appointments;
        return null;
    }

    function delete($params)
    {
        $error = parent::_validateRequestFields(['id'], $params);
        if ($error) return $error;
        return  $this->appointmentService->delete($params['id']);
    }

    function update($put)
    {
        return $this->appointmentService->update($put);
    }

    function create($post)
    {
        $error = parent::_validateRequestFields(['clientId', 'doctorId', 'date'], $post);
        if ($error) return $error;
        return $this->appointmentService->create($post);
    }
}
