<?php 

class AdminRepository {
    private $sqlConnection;

    function __construct($sqlConnection) {
        $this->sqlConnection = $sqlConnection;
    }

    function getOne($email) {
        $query = "SELECT * FROM admin WHERE email = ?";
        $stmt = $this->sqlConnection->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) return null;
        return $result[0];
    }

    function getByToken($token) {
        $query = "SELECT * FROM admin WHERE token = ?";
        $stmt = $this->sqlConnection->prepare($query);
        $stmt->execute([$token]);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) return null;
        return $result[0];
    }

    function updateToken($email, $token) {
        $query = "UPDATE admin SET token = ? WHERE email = ?";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute([$token, $email]);
        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    function create($admin) {
        try {
            $email = $admin->getEmail();
            $password = $admin->getPassword();
            $query = "INSERT INTO admin (email, password, createdat) VALUES ( ?, ?, NOW())";
            $stmt =  $this->sqlConnection->prepare($query);
            $stmt->execute([$email, $password]);
            if ($stmt->rowCount() > 0) return true;
            else return false;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}

?>