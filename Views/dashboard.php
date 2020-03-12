<?php 
    require_once ROOT . '/Utils/Database.php';
    require_once ROOT . '/Models/User.php';
    require_once ROOT . '/Views/header.php';
    require_once ROOT . '/Views/nav.php';
    var_dump($_SESSION);
    
?>
<div>
    <h2>Bienvenue dans votre espace personnel</h2>
    <h2 class="text-center my-4">Liste des Clients</h2>
    <div class="justify-content-between  row">
        <a href="liste-patients.php" class="bouton bg-bouton bg-primary">Tous cients</a>
        <a class="bouton bg-bouton bg-primary" class="">1 cliens</a>
        <a class="bouton bg-bouton bg-primary" class="">RDV ddu mois</a>
    </div>
    <div class="justify-content-between row">
        <a class="bouton bg-bouton bg-primary">RDV du jour</a>
        <a class="bouton bg-bouton bg-primary">RDV de la semaine</a>
        <a  class="bouton bg-bouton bg-primary">RDV ddu mois</a>
    </div>
</div>
<?php
require_once ROOT . '/Views/footer.php'; 