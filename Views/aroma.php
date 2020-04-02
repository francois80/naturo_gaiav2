<?php
require_once ROOT . '/Views/header.php';
require_once ROOT . '/Views/aside_left.php'; 
?>


<section>
    
    <div> 
        <h4 class="card-title">Qu’est-ce que l’aromathérapie ?</h4>
        <p class="card-text">
            Le terme “aromathérapie” est utilisé pour la première fois en 1928 par un biochimiste français, René-Maurice Gattefossé.
        </p>
        <p>
           L’aromathérapie est l’utilisation d’huiles essentielles issues de plantes aromatiques pour traiter les pathologies, améliorer la santé et le bien-être. Elles sont utilisées pour renforcer le processus naturel de guérison. En agissant sur le terrain, l’aromathérapie vise à rétablir l’équilibre de l’organisme dans sa globalité. 
        </p>
        <p>
            C’est une méthode naturelle, qui repose sur l’activité biochimiques des molécules composant les huiles essentielles.
        </p>
     </div>
    <div>
        <h4 class="card-title">Qu’est ce qu’une huile essentielle ?</h4>
        <p class="card-text">
            Une huile essentielle est un extrait liquide, obtenu par distillation, par entrainement à la vapeur d’eau, de plantes aromatiques ou d’organe de plante (fleur, feuille, bois, racine, écorce, fruit … ) Elle est composée d’une centaine de molécules aromatiques particulièrement actives et originales.
        </p>
        <p>
           La structure d’une huile essentielle est complexe, ce qui permet des synergies et des potentialisations d’action. Elle ne possède ainsi jamais une seule propriété thérapeutique mais  plusieurs. 
        </p>
        <p>
            Très concentrées, biochimiquement définies, les huiles essentielles possèdent un très large spectre d’action dans de nombreux domaines 
        </p>
        <p>
            Leurs propriétés sont variées : antiseptiques, antivirales, antimicrobiennes, anti-inflammatoires, antiparasitaires, analgésiques, calmantes, stimulantes, anti-spasmodiques, diurétiques, laxatives, anti-hypertenseurs, vasopresseuses, immunostimulantes… Elles présentent également des vertus apaisantes et équilibrantes du système nerveux.
        </p>
        <p>
          Elles peuvent être utilisées pures ou diluées dans une huile végétale, une crème… en diffusion, en olfaction, par voie cutanée, par voie orale…  
        </p>
        <p>
           L’utilisation des huiles essentielles à bon escient peut être très efficace. A l’inverse, comme toute substance très active, même naturelle, elles peuvent exposer à des incidents plus ou moins graves si elles ne sont pas utilisées avec vigilance. Elles sont parfois dangereuses chez la femme enceinte ou allaitante, chez l’enfant ou en cas de certaines pathologies. 
        </p>
    </div>
    <div>
       <h4 class="card-title">Qu’est ce que la gemmothérapie ?</h4>
        <p class="card-text">
            La gemmothérapie est l’utilisation des bourgeons et des jeunes pousses d’arbres et d’arbustes. Cette technique fait appel au capital énergétique des extraits embryonnaires riches en vitamines, minéraux, oligoéléments, enzymes, hormones… Ces bourgeons fraîchement cueillis seront mis à macérer dans un milieu glycériné (eau, alcool, glycérine). Le naturopathe pourra conseiller certains macérants seuls ou en association avec d’autres techniques naturopathiques.
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
