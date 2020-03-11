<?php
session_start();
// protection de la page par la session auth
if(!isset($_SESSION['auth']['login'])){
    header('Location:login.php');
    exit();
}

require_once '../Models/User.php';
//$patient = new User();
//$patientsList = $patient->getAll();
//var_dump($patientsList);
//if (count($patientsList) > 0) {
//   foreach ($patientsList AS $key => $patient_info){
//    echo $patient_info['lastname']. ' '. $patient_info['firstname']. ' '. $patient_info['date de naissance']. '<br>';
//   }
//}       

require_once ROOT . '/Views/dashboard.php';