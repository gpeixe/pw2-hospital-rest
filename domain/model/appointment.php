<?php 

class Appointment {
    private $id;
    private $clientId;
    private $doctorId;
    private $date;

    function __construct($clientId, $doctorId, $date) {
        $this->clientId = $clientId;
        $this->doctorId = $doctorId;
        $this->date = $date;
    }

    function getId () {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getClientId () {
        return $this->clientId;
    }

    function getDoctorId () {
        return $this->doctorId;
    }

    function getDate () {
        return $this->date;
    }

    function setDate($date) {
        $this->date = $date;
    }
}

?>