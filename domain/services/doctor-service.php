<?php

include_once(dirname(__FILE__) . "../../model/doctor.php");

class DoctorService 
{
    private $doctorRepository;

    function __construct($doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    function getAll()
    {
        $doctorsFromDb = $this->doctorRepository->getAll();
        $doctors = array();
        foreach ($doctorsFromDb as $doctorFromDb) {
            $doctor = $this->_mapDoctorFromDbToModel($doctorFromDb);
            array_push($doctors, $doctor);
        }
        return $doctors;
    }

    function getOne($doctorId)
    {
        $doctorFromDb = $this->doctorRepository->getOne($doctorId);
        if (!$doctorFromDb) return null;
        $doctor = $this->_mapDoctorFromDbToModel($doctorFromDb);
        return $doctor;
    }

    function delete($id)
    {
        return $this->doctorRepository->delete($id);
    }

    function update($put)
    {
        try {
            $id = $put['id'];
            $name = $put['name'];
            $email = $put['email'];
            $speciality = $put['speciality'];
            $doctor = new Doctor($name, $email, $speciality);
            $doctor->setId($id);
            return $this->doctorRepository->update($doctor);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function create($post)
    {
        try {
            $name = $post['name'];
            $email = $post['email'];
            $speciality = $post['speciality'];
            $doctor = new Doctor($name, $email, $speciality);
            return $this->doctorRepository->create($doctor);
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function _mapDoctorFromDbToModel($doctorFromDb)
    {
        $doctor = new Doctor($doctorFromDb['name'], $doctorFromDb['email'], $doctorFromDb['speciality']);
        $doctor->setId($doctorFromDb['id']);
        $doctor->setCreatedAt($doctorFromDb['createdat']);
        return $doctor;
    }
}
