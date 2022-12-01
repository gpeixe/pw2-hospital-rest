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
        echo "aqui";
        $admin = $this->adminService->getByToken($token);
        echo "a";
        if ($admin) return true;
        echo "b";
        return false;
}
    
}
