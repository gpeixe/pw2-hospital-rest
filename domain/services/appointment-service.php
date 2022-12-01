<?php

include_once(dirname(__FILE__) . "../../model/appointment.php");

class AppointmentService
{
    private $appointmentRepository;

    function __construct($appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    function getAll()
    {
        $appointmentsFromDb = $this->appointmentRepository->getAll();
        $appointments = array();
        foreach ($appointmentsFromDb as $appointmentFromDb) {
            $appointment = $this->_mapAppointmentFromDbToModel($appointmentFromDb);
            $id = $appointment->getId();
            $doctorId = $appointment->getDoctorId();
            $clientId = $appointment->getClientId();
            $date = $appointment->getDate();
            $doctorName = $appointmentFromDb['doctorname'];
            $clientName = $appointmentFromDb['clientname'];
            $clientEmail = $appointmentFromDb['clientemail'];
            $doctorEmail = $appointmentFromDb['doctoremail'];
            $appointmentDTO = [
                "id" => $id, 
                "doctorId" => $doctorId, 
                "clientId" => $clientId, 
                "date" => $date, 
                "doctorName" => $doctorName, 
                "clientName" => $clientName,
                "doctorEmail" => $doctorEmail,
                "clientEmail" => $clientEmail
            ];
            array_push($appointments, $appointmentDTO);
        }
        return $appointments;
    }

    function getOne($appointmentId)
    {
        $appointmentFromDb = $this->appointmentRepository->getOne($appointmentId);
        if (!$appointmentFromDb) return null;
        $appointment = $this->_mapAppointmentFromDbToModel($appointmentFromDb);
        return $appointment;
    }

    function delete($id)
    {
        return $this->appointmentRepository->delete($id);
    }

    function update($put)
    {
        try {
            $id = $put['id'];
            $clientId = $put['clientId'];
            $doctorId = $put['doctorId'];
            $date = $put['date'];
            $appointment = new Appointment($clientId, $doctorId, $date);
            $appointment->setId($id);
            return $this->appointmentRepository->update($appointment);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function create($post)
    {
        try {
            $clientId = $post['clientId'];
            $doctorId = $post['doctorId'];
            $date = $post['date'];
            $appointment = new Appointment($clientId, $doctorId, $date);
            return $this->appointmentRepository->create($appointment);
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function _mapAppointmentFromDbToModel($appointmentFromDb)
    {
        $appointment = new Appointment($appointmentFromDb['clientid'], $appointmentFromDb['doctorid'], $appointmentFromDb['date']);
        $appointment->setId($appointmentFromDb['id']);
        return $appointment;
    }
}
