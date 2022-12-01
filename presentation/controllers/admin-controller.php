<?php

include_once(dirname(__FILE__) . "/controller.php");

class AdminController extends Controller
{
    private $adminService;

    function __construct($adminService)
    {
        $this->adminService = $adminService;
    }

    function create($post)
    {
        $error = parent::_validateRequestFields(['email', 'password'], $post);
        if ($error) return $error;
        return $this->adminService->create($post);
    }

    function login($post)
    {
        $error = parent::_validateRequestFields(['email', 'password'], $post);
        if ($error) return $error;
        return $this->adminService->login($post);
    }
}
