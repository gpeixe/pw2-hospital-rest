<?php 

include_once(dirname(__FILE__) . "../../../infra/connection/MySqlConnection.php");
include_once(dirname(__FILE__) . "../../../infra/repositories/admin-repository.php");
include_once(dirname(__FILE__) . "../../../domain/services/admin-service.php");
include_once(dirname(__FILE__) .  "../../../presentation/middlewares/auth-middleware.php");
include_once(dirname(__FILE__) .  "../../../infra/jwt/jwt-adapter.php");

function makeAuthMiddleware() {
    $connection = MySqlConnection::getConnection();
    $repo = new AdminRepository($connection);
    $jwtGenerator = new JwtAdapter("chaveSecreta123");
    $service = new AdminService($repo, $jwtGenerator);
    $middleware = new AuthMiddleware($service);
    return $middleware;
}


?>