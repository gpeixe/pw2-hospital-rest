<?php 

class DoctorRepository {
    private $sqlConnection;

    function __construct($sqlConnection) {
        $this->sqlConnection = $sqlConnection;
    }

    function delete($id) {
        $query = "DELETE FROM doctor WHERE id = ?";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    function getAll() {
        $query = "SELECT * FROM doctor";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute();
        $doctors = $stmt->fetchAll();
        return $doctors;
    }

    function getOne($id) {
        $query = "SELECT * FROM doctor WHERE id = ?";
        $stmt = $this->sqlConnection->prepare($query);
        $stmt->execute([$id]);
        $doctor = $stmt->fetchAll()[0];
        return $doctor;
    }

    function update($doctor) {
        try {
            $doctorName = $doctor->getName();
            $doctorEmail = $doctor->getEmail();
            $doctorId = $doctor->getId();
            $speciality = $doctor->getSpeciality();
            $query = "UPDATE doctor SET nome = ?, email = ?, speciality = ? WHERE id = ?;";
            $stmt =  $this->sqlConnection->prepare($query);
            $stmt->execute([$doctorName, $doctorEmail, $speciality, $doctorId]);
            if ($stmt->rowCount() > 0) return true;
        else return false;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function create($doctor) {
        try {
            $name = $doctor->getName();
            $email = $doctor->getEmail();
            $speciality = $doctor->getSpeciality();
            $query = "INSERT INTO doctor (name, email, speciality, createdat) VALUES (?, ?, ?, NOW())";
            $stmt =  $this->sqlConnection->prepare($query);
            $stmt->execute([$name, $email, $speciality]);
            if ($stmt->rowCount() > 0) return true;
            else return false;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}

?>