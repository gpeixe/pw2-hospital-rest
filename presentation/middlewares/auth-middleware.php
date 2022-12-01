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
        if(!isset($headers['X-Token'])){
            return false;
        }
        echo "teste";
        $token = $headers['X-Token'];
        $admin = $this->adminService->getByToken($token);
        echo $admin;
        if ($admin) return true;
        return false;
}
    
}
