<?php

class AuthMiddleware 
{
    private $adminService;

    function __construct($adminService)
    {
        $this->adminService = $adminService;
        
    }

    function validateAuth($headers) {
        if(!isset($headers['X-Token'])){
            return false;
        }
        $token = $headers['X-Token'];
        $admin = $this->adminService->getByToken($token);
        if ($admin) return true;
        return false;
}
    
}
