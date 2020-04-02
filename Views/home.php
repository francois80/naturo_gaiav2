<?php
require_once ROOT . '/Views/header.php';
require_once ROOT . '/Views/aside_left.php'; 
?>


<section>
    
    <div> 
        <h4 class="card-title">ETRE ACTEUR DE SA SANTE</h4>
        <p class="card-text">
            Bienvenue sur le site DE NATURO GAIA<br>
            Selon l'Organisation Mondiale de la Santé "la naturopathie est un ensemble de méthodes de soins visant à renforcer les défenses de l'organisme par des moyens considérés comme naturels et biologiques".
        </p>
     </div>
    <p></p>
    <div>
        <h4>Mes outils pour vous accompagner</h4>
    </div>
    <div id="sommaire" class="row">
        <p><img src="../assets/images/alim_pyramide.png" class="img_small img-fluid" alt="nature">ALIMENTATION</p>
        <p><img src="../assets/images/bougies.jpeg" class="img_small img-fluid" alt="nature">RELATION AIDE RELAXATION</p>
        <p><img src="../assets/images/bourgeon.jpeg" class="img_small img-fluid" alt="nature">MASSAGE BIEN ETRE</p>
        <p><img src="../assets/images/fleurs.jpeg" class="img_small img-fluid" alt="nature">AROMATHERAPIE/GEMMOTHERAPIE</p>
        <p><img src="../assets/images/head.jpg" class="img_small img-fluid" alt="nature">IRIDOLOGIE</p>
        <p><img src="../assets/images/cerises.jpeg" class="img_small img-fluid" alt="nature">FLEURS DE BACH/BOL AIR JACQUIER</p>
        <p><img src="../assets/images/nature.jpg" class="img_small img-fluid" alt="nature">ATELIERS</p>
    </div>
    
</section>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
/**
 * Animation de la fusée avec Javascript
**/
jQuery(document).ready(function($){
    // Stockage des références des différents éléments dans des variables
    rocket     = $('#asideLeft');
    
    // Calcul de la marge entre le haut du document et #rocket_mobile
    fixedLimit = rocket.offset().top - parseFloat(rocket.css('marginTop').replace(/auto/,10));
 
    // On déclenche un événement scroll pour mettre à jour le positionnement au chargement de la page
    $(window).trigger('scroll');
 
    $(window).scroll(function(event){
        // Valeur de défilement lors du chargement de la page
        windowScroll = $(window).scrollTop();
 
        // Mise à jour du positionnement en fonction du scroll
        if( windowScroll >= fixedLimit ){
            rocket.addClass('fixed');
        } else {
            rocket.removeClass('fixed');
        }
    });
});
</script>
<?php
require_once ROOT . '/Views/footer.php';
