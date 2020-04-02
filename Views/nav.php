<!--Navbar-->
<nav class="row navbar navbar-expand-lg navbar-dark bg-sandybrown sticky-top">
    <!-- Collapse button -->
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span> Natur'O Gaïa</button>
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <!-- Links -->
        <div class=" row-8 nav-style" id="btnOnTheLeft">
            <ul class="navbar-nav btn-nav-align">
                <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="home.php">Accueil</a></li>
                </div>
                <div class="btn-menu">
                <li class="btn-nav-align nav-item"><span id="pipe-bar" class="nav-link">|</span></li>
                </div>
                 <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="naturo.php">Naturopathie</a></li>
                </div>
                 <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="aroma.php">Aromathérapie</a></li>
                </div>
                 <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="iridologie.php">Iridologie</a></li>
                </div>
                <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="massage.php">Massage</a></li>
                </div>
                 <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </div>
                <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="calendrier.php">Calendrier</a></li>
                </div>
                 <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="Ateliers.php">Ateliers</a></li>
                </div>
                <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="tarifs.php">Tarifs</a></li>
                </div>
                <div class="btn-menu">
                <li class="btn-nav-align nav-item"><a class="nav-link" href="temoignages.php">Témoignages</a></li>
                </div>
            </ul>
        </div>
        <div id="btnOnTheRight">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['auth']['login'])) { ?>
                    <!--li class="nav-item"><a href="register.php" class="nav-link">Inscription</a></li-->
                    <li class="nav-item"><a href="login.php" class="nav-link">Connexion</a></li>
                <?php } else { ?>
                    <!-- Dropdown -->
                    <li class="nav-item">
                        <a class="nav-link" href="">Bonjour <?= ucfirst(strip_tags($_SESSION['auth']['lastname']))[0] ?> </a>                       
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">log out</a>                       
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Links -->
    </div>
    <!-- Collapsible content -->
</nav>
<!--/.Navbar-->