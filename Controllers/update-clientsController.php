<?php
session_start();
require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/User.php';

if (empty($_GET['idPatient']) || !filter_input(INPUT_GET, 'idPatient', FILTER_VALIDATE_INT)) {
    header('location: liste-patients.php');
    exit();
}
else{
  $id_user  = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
}
    
//Accès à la page update via un get
$idPatient = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
$nameRegex = '/\w+/';
//$TelRegex = "/^[0-9]{2}(\.[0-9]{2}){4}$/";
$TelRegex = "/^[0-9]{10}$/";
//$AgeRegex = "/^[0-9]{10}$/";
$AgeRegex = "/^([0-9]{4})(\-{1})([0-9]{2})(\-{1})([0-9]{2})$/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmit = true;
    //vérif nom
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    if (empty($lastname) || !preg_match($nameRegex, $lastname)) {
        $errors['lastname'] = 'Le nom est invalide !';
    }
    //vérif prénom
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    if (empty($firstname) || !preg_match($nameRegex, $firstname)) {
        $errors['firstname'] = 'Le prénom est invalide !';
    }
    //vérif âge
    $age = trim(filter_input(INPUT_POST, 'age', FILTER_SANITIZE_STRING));
    if (empty($age) || !preg_match($AgeRegex, $age)) {
        $errors['age'] = 'La date de naissance est invalide !';
    }
    ////vérif téléphone
    $phone = trim(htmlspecialchars($_POST['phone']));
    if (empty(phone) || !preg_match($TelRegex, $phone)) {
        $errors['phone'] = 'Le téléphone est invalide !';
    }
    //vérif email
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    if (empty($email) || !filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Le mail est invalide !';
    }
    //vérif question
//    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));
//    if (empty($message) || !preg_match($nameRegex, $message)) {
//        $errors['message'] = 'La réponse à la question n\'est pas valide!';
//    }
}


   $user = new User();
if ($isSubmit && count($errors) == 0) {
    $user->id_user = intval($id_user);
    $user->firsname = $firstname;
    $user->lastname = $lastname;
    $user->birthdate = $age;
    $user->phone = intval($phone);
    $user->email = $email;
    //$user->update();
    var_dump($user);
    if ($user->update()) {
        $success = true;
        $sleep = 1;
        header('Refresh:' . $sleep . ';http://www.naturogaia.com/liste-patients.php');
    }
    else{
        die('not ok');
        require_once ROOT . '/Views/errors/503.php';
        exit();
    }


}

$idPatient = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['idPatient'])) {
    if (!filter_input(INPUT_POST, 'idPatient', FILTER_VALIDATE_INT) || $_POST['idPatient'] <= 0) {
        $errors['idPatient'] = 'Ce patient n\'existe pas';
    }
}
//On instance patient pour afficher l'utilisateur avec getOne()
$patient = new User();
$patient->id_user = filter_input(INPUT_GET, 'idPatient', FILTER_SANITIZE_NUMBER_INT);

$patient->getOne();

require_once ROOT . '/Views/update-clients.php';

