<?php

include_once(dirname(__FILE__) . "../../model/admin.php");

class AdminService
{
    private $adminRepository;
    private $jwtGenerator;

    function __construct($adminRepository, $jwtGenerator)
    {
        $this->adminRepository = $adminRepository;
        $this->jwtGenerator = $jwtGenerator;
    }

    function create($post)
    {   
        $password = $post["password"];
        $email = $post["email"];
        $hashed_password = crypt($password, 12);
        $admin = new Admin($email, $hashed_password);
        return $this->adminRepository->create($admin);
    }

    function login($post)
    {   
        $password = $post["password"];
        $email = $post["email"];
        $admin = $this->getOne($email);
        if(!$admin) return false;
        $hashedPassword = $admin->getPassword();
        $result = hash_equals($hashedPassword, crypt($password, $hashedPassword));
        if (!$result) return $result;
        $token = $this->jwtGenerator->generateToken($admin->getId());
        $this->adminRepository->updateToken($email, $token);
        return $token;
    }

    function getOne($email)
    {  
        $adminFromDb = $this->adminRepository->getOne($email);
        if(!$adminFromDb) return null; 
        $admin = $this->_mapAdminFromDbToModel($adminFromDb);
        return $admin;
    }

    function getByToken($token)
    {  
        $adminFromDb = $this->adminRepository->getByToken($token);
        if(!$adminFromDb) return null; 
        $admin = $this->_mapAdminFromDbToModel($adminFromDb);
        return $admin;
    }

    private function _mapAdminFromDbToModel($adminFromDb)
    {
        $admin = new Admin($adminFromDb['email'], $adminFromDb['password']);
        $admin->setId($adminFromDb['id']);
        $admin->setToken($adminFromDb['token']);
        return $admin;
    }
}
