<?php
// protection de la page par la session auth
if(!isset($_SESSION['auth']['login'])){
    header('Location:login.php');
    exit();
}
require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/User.php';

$user = new User(); //appel class User
$userList = $user->getAll(); //récupération toutess infos patients
// affichage 3 par page
$page = 1;
if (!empty($_GET['page']) && filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT)) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
}
$totalPatients = $user->totalPatients();
$perPage = 3;
$numberOfPages = ceil($totalPatients / $perPage);
$begin = $perPage * ($page - 1);
$usersList = $user->patientsPerPage($perPage, $begin);

if (isset($_POST['search-submit'])) {
    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    if (!empty($search)) {
        $hidePaginate = true;
        $usersList = $user->findPatient($search);
    }
}

require_once ROOT . '/Views/liste-patients.php';