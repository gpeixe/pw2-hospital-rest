<?php

include_once(dirname(__FILE__) . "/controller.php");

class DoctorController extends Controller
{
    private $doctorService;

    function __construct($doctorService)
    {
        $this->doctorService = $doctorService;
    }

    function getAll()
    {
        $doctors =  $this->doctorService->getAll();
        if ($doctors && count($doctors)) return $doctors;
        return null;
    }

    function delete($params)
    {
        $error = parent::_validateRequestFields(['id'], $params);
        if ($error) return $error;
        return  $this->doctorService->delete($params['id']);
    }

    function update($put)
    {
        return $this->doctorService->update($put);
    }

    function create($post)
    {
        $error = parent::_validateRequestFields(['name', 'email', 'speciality'], $post);
        if ($error) return $error;
        return $this->doctorService->create($post);
    }
}
