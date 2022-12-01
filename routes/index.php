<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação</title>
</head>
<body>
    <h1>
    Webservice de Agenda Médica
    </h1>

    <p>
    API REST para gerenciamento de consultas de uma clinica médica, podendo gerenciar, consultas, médicos e clientes
    </p>

    <h2>As rotas disponiveis são:</h2>

    <a href="./admins.php">admins.php></a>
    <ul>
        <li>POST - Adiciona um novo administrador. Requer o body em JSON e os seguintes campos: email e password</li>
        <li>PUT - Realiza Login.  Requer o body em JSON e os seguintes campos: email e password e retorna o JWT</li>
    </ul>

    <a href="./clients.php">clients.php></a>
    <ul>
        <li>POST - Adiciona um novo cliente. Requer o body em JSON e os seguintes campos: name, email e phone. Requer Header X-Token com o valor do token JWT</li>
        <li>GET - Retorna todos os clientes cadastrados no sistema. Requer Header X-Token com o valor do token JWT</li>
        <li>DELETE - Deleta um cliente. Requer query param id com o valor do id do cliente. Requer Header X-Token com o valor do token JWT</li>
    </ul>

    <a href="./doctors.php">doctors.php></a>
    <ul>
        <li>POST - Adiciona um novo medico. Requer o body em JSON e os seguintes campos: name, email e speciality. Requer Header X-Token com o valor do token JWT</li>
        <li>GET - Retorna todos os medicos cadastrados no sistema. Requer Header X-Token com o valor do token JWT</li>
        <li>DELETE - Deleta um médico. Requer query param id com o valor do id do médico. Requer Header X-Token com o valor do token JWT</li>
    </ul>

    <a href="./appointments.php">appointments.php></a>
    <ul>
        <li>POST - Adiciona uma nova consulta. Requer o body em JSON e os seguintes campos: clientId, doctorId e date. Requer Header X-Token com o valor do token JWT</li>
        <li>GET - Retorna todas as consultas cadastradas no sistema. Requer Header X-Token com o valor do token JWT</li>
        <li>DELETE - Deleta uma consulta. Requer query param id com valor do id da consulta. Requer Header X-Token com o valor do token JWT</li>
    </ul>
</body>
</html>