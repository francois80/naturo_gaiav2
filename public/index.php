<?php
session_start();

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once ROOT . '/Config/database.php';

//récupération des paramètres en url
$page = $_GET['p'] ?? '';
$page = explode('.', $page);
if(count($page) > 1){
    //redirection vers la bonne page
    if(file_exists(ROOT . '/Controllers/' . $page[0] ) . 'Controller.php'){
        require_once ROOT . '/Controllers/' . $page[0] . 'Controller.php';
    }
}else{
    # sinon vers accueil
    require_once ROOT . '/Views/home.php';
}
