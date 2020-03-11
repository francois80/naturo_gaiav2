<?php
session_start();
require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/User.php';

$patient = new User(); //appel class User
$patientsList = $patient->getAll(); //réccupération infos patients

$page = 1;
if (!empty($_GET['page']) && filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT)) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
}
$totalPatients = $patient->totalPatients();
$perPage = 3;
$numberOfPages = ceil($totalPatients / $perPage);
$begin = $perPage * ($page - 1);
$patientsList = $patient->patientsPerPage($perPage, $begin);

if (isset($_POST['search-submit'])) {
    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    if (!empty($search)) {
        $hidePaginate = true;
        $patientsList = $patient->findPatient($search);
    }
}

require_once ROOT . '/Views/liste-patients.php';