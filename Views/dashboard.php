<?php 
    require_once ROOT . '/Utils/Database.php';
    require_once ROOT . '/Models/User.php';
    require_once ROOT . '/Views/header.php';
    require_once ROOT . '/Views/nav.php';
?>

<h2>Bienvenue dans votre espace personnel</h2>
<div class="col">
    <div>
        Sélection
        <a class="bouton bg-bouton bg-primary">RDV du jour</a>
        <a class="bouton bg-bouton bg-primary">RDV de la semaine</a>
        <a  class="bouton bg-bouton bg-primary">RDV ddu mois</a>
    </div>


    <div>
    sélection
    <a href="liste-patients.php" class="bouton bg-bouton bg-primary">Tous cients</a>
    <a class="bouton bg-bouton bg-primary" class="">1 cliens</a>
    <a class="bouton bg-bouton bg-primary" class="">RDV ddu mois</a>
    </div>
</div>




<?php
require_once ROOT . '/Views/footer.php'; 