<?php 

class ClientRepository {
    private $sqlConnection;

    function __construct($sqlConnection) {
        $this->sqlConnection = $sqlConnection;
    }

    function delete($id) {
        $query = "DELETE FROM client WHERE id = ?";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute([intval($id)]);
        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    function getAll() {
        $query = "SELECT * FROM client";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        return $clients;
    }

    function getOne($id) {
        $query = "SELECT * FROM client WHERE id = ?";
        $stmt = $this->sqlConnection->prepare($query);
        $stmt->execute([$id]);
        $client = $stmt->fetchAll()[0];
        return $client;
    }

    function update($client) {
        try {
            $clientName = $client->getName();
            $clientEmail = $client->getEmail();
            $clientId = $client->getId();
            $phone = $client->getPhone();
            $query = "UPDATE client SET nome = ?, email = ?, phone = ? WHERE id = ?;";
            $stmt =  $this->sqlConnection->prepare($query);
            $stmt->execute([$clientName, $clientEmail, $phone, $clientId]);
            if ($stmt->rowCount() > 0) return true;
        else return false;
        } catch (Exception $e) {
            throw new ErrorException('Email já cadastrado.');
        }
    }

    function create($client) {
        try {
            $name = $client->getName();
            $email = $client->getEmail();
            $phone = $client->getPhone();
            $query = "INSERT INTO client (name, email, phone, createdat) VALUES (?, ?, ?, NOW())";
            $stmt =  $this->sqlConnection->prepare($query);
            $stmt->execute([$name, $email, $phone]);
            if ($stmt->rowCount() > 0) return true;
            else return false;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}

?>