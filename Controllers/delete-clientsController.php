<?php
// protection de la page par la session auth
if(!isset($_SESSION['auth']['login'])){
    header('Location:login.php');
    exit();
}
require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/User.php';
require_once ROOT . '/Models/Appointment.php';

if (empty($_GET['idPatient']) || !filter_input(INPUT_GET, 'idPatient', FILTER_VALIDATE_INT)) {
    header('location: liste-patients.php');
    exit();
}
if(!empty(filter_input(INPUT_GET, 'hourBegin', FILTER_SANITIZE_STRING))){
    $appointment = new Appointments();
    $appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
    $appointment->hourBegin = filter_input(INPUT_GET, 'hourBegin', FILTER_SANITIZE_STRING);
    if($appointment->delete()){
       
    }  
}
 
if(!empty($_GET['allInfo'])){
    $appointment = new Appointments();
    $user = new User();
    $appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
    $user->id_user = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
    //$appointment->hourBegin = filter_input(INPUT_GET, 'hourBegin', FILTER_SANITIZE_STRING);
    //$appointment->deleteAllAppointment(); 
    //$appointment->deletePatientAppointment();
    
    
    try {
    $user->db->beginTransaction();
    $appointment->deleteAllAppointment();
    $user->delete();
    $appointment->db->commit();
    $_SESSION['deletePatient']['success'] = true;
    $_SESSION['deletePatient']['name'] = $patient->firstname. ' '. $patient->lastname;
  } catch (PDOException $e){
    $appointment->db->rollBack();
    $user->db->rollBack();
    $_SESSION['deletePatient']['success'] = false;
  }
  header('Location: liste-patients.php');
  exit();
       
    
}

//On instance patient pour afficher l'utilisateur avec getOne()
$user = new User();
$appointment = new Appointments();
$user->id_user = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$user->getOne();
$appointment->idUser = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$userAppointment =  $appointment->getAllByUser();

    

require_once ROOT . '/Views/delete-clients.php';