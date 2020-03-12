<?php
session_start();
require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/User.php';
require_once ROOT . '/Models/Appointment.php';

if (empty($_GET['idPatient']) || !filter_input(INPUT_GET, 'idPatient', FILTER_VALIDATE_INT)) {
    header('location: liste-patients.php');
    exit();
}
else{
  $id_user  = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
  $hourBegin = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_STRING);  
}

if(!empty(filter_input(INPUT_GET, 'hourBegin', FILTER_SANITIZE_STRING))){
    $appointment = new Appointments();
    $appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
    $appointment->hourBegin = filter_input(INPUT_GET, 'hourBegin', FILTER_SANITIZE_STRING);
    if($appointment->delete()){
       
    }  
    
}

if(!empty($_GET['allinfo'])){
    $appointment = new Appointments();
    $user = new User();
    $appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
    //$appointment->hourBegin = filter_input(INPUT_GET, 'hourBegin', FILTER_SANITIZE_STRING);
    $appointment->delete();
    $appointment->deletePatientAppointment();
    
    
    try {
    $user->db->beginTransaction();
    $appointment->delete();
    $user->delete();
    $appointment->db->commit();
    //$_SESSION['deletePatient']['success'] = true;
    //$_SESSION['deletePatient']['name'] = $patient->firstname. ' '. $patient->lastname;
  } catch (PDOException $e){
    $appointment->db->rollBack();
    $user->db->rollBack();
   // $_SESSION['deletePatient']['success'] = false;
  }
  header('Location: liste-patientsController.php');
  exit();
       
    
}

//Accès à la page update via un get
$idPatient = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);


//On instance patient pour afficher l'utilisateur avec getOne()
$user = new User();
$appointment = new Appointments();
$user->id_user = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$appointment->id_user = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$user->getOne();
$appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$userAppointment =  $appointment->getAllByUser();

    

require_once ROOT . '/Views/delete-clients.php';