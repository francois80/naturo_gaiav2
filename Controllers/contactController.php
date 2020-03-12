<?php

require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/User.php';

$errors = [];
$nameRegex = '/\w+/';
//$TelRegex = "/^[0-9]{2}(\.[0-9]{2}){4}$/"; // (06.11.22.33.44)
$TelRegex = "/^[0-9]{10}$/"; // (0322445566)
//$AgeRegex = "/^[0-9]{10}$/";
$AgeRegex = "/^([0-9]{4})(\-{1})([0-9]{2})(\-{1})([0-9]{2})$/"; // format américain 1987-11-26
$passwordRegex = '/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])?[\w!@#$%^&*]{8,}$/'; //Maj ou chiffres + minuscule ou caractère spéciaux
$password = '';

// Vérification que l'email n'existe pas déja dans la base
if (isset($_POST['checkmail'])) {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $user = new User();
        $user->email = $email;
        if ($user->checkemail()) {
            exit('notOk');
        }
        exit('ok');
    }
}

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

    if (count($errors) == 0) {
        
        $user = new User('', '', $firstname, $lastname, $age, $phone, $email, 2);

        try {
            if ($user->checkemail()) {  //vérification pas email dans la table
                 $sleep = 1;
                 header('Refresh:' . $sleep . ';http://www.naturogaia.com/home.hp');
            }
            else{
               $user->create();
            }
            
        } catch (PDOException $ex) {
            //var_dump($ex);
            echo 'La création du compte a échouée !' . $ex->getMessage();
            die();
        }
    }
   
}
require_once ROOT . '/Views/contact.php';
