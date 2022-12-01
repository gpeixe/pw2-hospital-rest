<?php

include_once(dirname(__FILE__) . "/controller.php");

class ClientController extends Controller
{
    private $clientService;

    function __construct($clientService)
    {
        $this->clientService = $clientService;
    }

    function getAll()
    {
        $clients =  $this->clientService->getAll();
        if ($clients && count($clients)) return $clients;
        return null;
    }

    function delete($params)
    {   
        $error = parent::_validateRequestFields(['id'], $params);
        if ($error) return $error;
        return  $this->clientService->delete($params['id']);
    }

    function update($put)
    {
        return $this->clientService->update($put);
    }

    function create($post)
    {   
        $error = parent::_validateRequestFields(['name', 'email', 'phone'], $post);
        if ($error) return $error;
        return $this->clientService->create($post);
    }
}
