<?php
require_once ROOT . '/Views/header.php';
require_once ROOT . '/Views/aside_left.php'; 
?>


<section>
    
    <div> 
        <h4 class="card-title">L'iridologie</h4>
        <p class="card-text">
            Chacun d'entre nous possède un iris de couleur différente. Franchement bleu, plus ou moins foncé, plutôt brun, voire noir, ou encore ni bleu, ni brun, avec des reflets verts ou jaunes, bref, la couleur de votre iris fournit déjà à l'iridologue une foule de renseignements sur votre constitution, votre tempérament, votre terrain.
        </p>
     </div>
    <p></p>
    
    
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
