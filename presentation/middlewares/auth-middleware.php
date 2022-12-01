<?php

class AuthMiddleware 
{
    private $adminService;

    function __construct($adminService)
    {
        $this->adminService = $adminService;
        
    }

    function validateAuth($headers) {
        if(!isset($headers['Authorization'])){
            return false;
        }
        $token = $headers['Authorization'];
        $admin = $this->adminService->getByToken($token);
        if ($admin) return true;
        return false;
}
    
}
