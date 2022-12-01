<?php

include_once(dirname(__FILE__) . "../../model/client.php");
class ClientService
{
    private $clientRepository;

    function __construct($clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    function getAll()
    {
        $clientsFromDb = $this->clientRepository->getAll();
        $clients = array();
        foreach ($clientsFromDb as $clientFromDb) {
            $client = $this->_mapClientFromDbToModel($clientFromDb);
            array_push($clients, $client);
        }
        return $clients;
    }

    function getOne($clientId)
    {
        $clientFromDb = $this->clientRepository->getOne($clientId);
        if (!$clientFromDb) return null;
        $client = $this->_mapClientFromDbToModel($clientFromDb);
        return $client;
    }

    function delete($id)
    {
        return $this->clientRepository->delete($id);
    }

    function update($put)
    {
        try {
            $id = $put['id'];
            $name = $put['name'];
            $email = $put['email'];
            $phone = $put['phone'];
            $client = new Client($name, $email, $phone);
            $client->setId($id);
            return $this->clientRepository->update($client);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function create($post)
    {
        try {
            $name = $post['name'];
            $email = $post['email'];
            $phone = $post['phone'];
            $client = new Client($name, $email, $phone);
            return $this->clientRepository->create($client);
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function _mapClientFromDbToModel($clientFromDb)
    {
        $client = new Client($clientFromDb['name'], $clientFromDb['email'], $clientFromDb['phone']);
        $client->setId($clientFromDb['id']);
        $client->setCreatedAt($clientFromDb['createdat']);
        return $client;
    }
}
