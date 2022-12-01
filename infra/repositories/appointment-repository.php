<?php 

class AppointmentRepository {
    private $sqlConnection;

    function __construct($sqlConnection) {
        $this->sqlConnection = $sqlConnection;
    }

    function delete($appointmentId) {
        $query = "DELETE FROM appointment WHERE id = ?";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute([$appointmentId]);
        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    function getAll() {
        $query = "SELECT appointment.id as id, clientid, doctorid, date, client.name AS clientname, doctor.name AS doctorname, client.email as clientemail, doctor.email as doctoremail, doctor.speciality as doctorspeciality, client.phone as clientphone
         FROM appointment INNER JOIN client ON client.id = appointment.clientid INNER JOIN doctor ON doctor.id = appointment.doctorid";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute();
        $appointments = $stmt->fetchAll();
        return $appointments;
    }

    function create($appointment) {
        $clientId = $appointment->getClientId();
        $doctorId = $appointment->getDoctorId();
        $date = $appointment->getDate();
        $query = "INSERT INTO appointment (clientid, doctorid, date) VALUES (?, ?, ?)";
        $stmt =  $this->sqlConnection->prepare($query);
        $stmt->execute([$clientId, $doctorId, $date]);
        if ($stmt->rowCount() > 0) return true;
        else return false;
    }
}

?>