<?php

class AuthMiddleware 
{
    private $adminService;

    function __construct($adminService)
    {
        $this->adminService = $adminService;
        
    }

    function validateAuth($headers) {
        echo "entrou";
        if(!isset($headers['Authorization'])){
            return false;
        }
        echo "teste";
        $token = $headers['Authorization'];
        $admin = $this->adminService->getByToken($token);
        echo $admin;
        if ($admin) return true;
        return false;
}
    
}
