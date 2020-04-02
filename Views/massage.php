<?php

require_once ROOT . '/Views/header.php';
require_once ROOT . '/Views/aside_left.php';
?>


<section>

    <div> 
        <h4 class="card-title">Les Massages</h4>
        <p class="card-text">
            Les Massages Bien-Être contribuent à une meilleure hygiène de vie et ils ont ainsi toute leur place dans l’accompagnement global que nous proposons en naturopathie.
        </p>
        <p>
            Ils aident à dénouer les tensions du corps et à apaiser le mental. Ils contribuent à une meilleure perception du corps, relancent la circulation et contribuent à un meilleur drainage des toxines.
        </p>
        <h4 class="card-title">Le Chi Nei Tsang</h4>
        <p class="card-text">
            Le Chi Nei Tsang est une approche holistique du massage.
        </p>
        <p>
            Originaire des montagnes de la Chine taoïste, il intègre les aspects physiques, mentaux, émotionnels et spirituels. 
        </p>
        <p>
            Le Chi Nei Tsang signifie littéralement :<br>
            travailler l'énergie des organes internes ou transformation du Chi des organes internes.
        </p>
        <p>
            Ces pratiques traditionnelles intéresseront toute personne en recherche de mieux être dans son corps.
        </p>
    </div>
    <div>
        <h4 class="card-title">Le ventre, le deuxième cerveau.</h4>
        <p class="card-text">
            Avec le Chi Nei Tsang, je suis convaincue que, chacun étant responsable de sa propre santé, la guérison vient de l'intérieur.
        </p>
        <p>
            La réflexologie fait partie des techniques naturelles utilisées en naturopathie pour aider à évacuer les toxines, pour soulager le système nerveux et pour retrouver un équilibre.
        </p>
        <p>
            C’est un moment pour se détendre, pour se relâcher, pour évacuer le stress et les tensions.<br>
            Elle permet de : 
        </p>
        <ul>
            <li>Dynamiser le corps,</li>
            <li>Retrouver de d’énergie,</li>
            <li>Renfoncer les défenses naturelles du corps,</li>
            <li>Drainer les toxines,</li>
            <li>Soulager certains troubles : améliorer la circulation sanguine, soulager des douleurs précises, améliorer le sommeil, décontracter les muscles, soulager les troubles digestifs, les migraines, la rétention d’eau, les jambes lourdes….</li>
        </ul>
        <h4>Déroulement d’une séance de réflexologie plantaire :</h4>
        <p>
            Une séance de réflexologie dure en moyenne 45 minutes à 1 heure.
        </p>
        <p>
            Nous démarrons par un échange, afin de connaître vos attentes et de déterminer les huiles essentielles utilisées durant la séance.
        </p>
        <p>
            Puis confortablement installé dans une ambiance relaxante, nous démarrons la séance.
        </p>
    </div>
    <div>
        <h4 class="card-title">La réflexologie ?</h4>
    </div>
    <p></p>

</section>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    /**
     * Animation de la fusée avec Javascript
     **/
    jQuery(document).ready(function ($) {
        // Stockage des références des différents éléments dans des variables
        rocket = $('#asideLeft');

        // Calcul de la marge entre le haut du document et #rocket_mobile
        fixedLimit = rocket.offset().top - parseFloat(rocket.css('marginTop').replace(/auto/, 10));

        // On déclenche un événement scroll pour mettre à jour le positionnement au chargement de la page
        $(window).trigger('scroll');

        $(window).scroll(function (event) {
            // Valeur de défilement lors du chargement de la page
            windowScroll = $(window).scrollTop();

            // Mise à jour du positionnement en fonction du scroll
            if (windowScroll >= fixedLimit) {
                rocket.addClass('fixed');
            } else {
                rocket.removeClass('fixed');
            }
        });
    });
</script>
<?php

require_once ROOT . '/Views/footer.php';


