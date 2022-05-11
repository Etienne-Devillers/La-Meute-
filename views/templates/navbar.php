
<!----------- Section Navbar ----------->
<header>
    <div class="sideNavBarContainer">
    </div>
    <div class="sideNavBar">
        <ul class="sideNavBarList">
            <li><a href="https://www.google.com">Comment ça marche</a></li>
            <li><a href="https://www.google.com">Qui sommes nous</a></li>
            <li><a href="https://www.google.com">FAQ</a></li>
        </ul>
    </div>
    <nav class="navBar">

        <div class="navBarLeftSide">
            <a href="/accueil"><img src="/assets/img/MDMjib.png" alt="Logo de la Meute" class="logoNavBar"></a>
            <h5 class="navTitle">La Meute</h5>
        </div>
        <div class="navBarRightSide">
            <img src="assets/img/bars-solid.svg" alt="menu burger" class="burgerMenu">
            <ul class="navBarLinks">
                <li><a href="https://www.google.com">Comment ça marche</a></li>
                <li><a href="https://www.google.com">Qui sommes nous</a></li>
                <li><a href="https://www.google.com">FAQ</a></li>
            </ul>

        <?php   if (empty($_SESSION['user'])) { ?>
            <ul class="loggingInputs">
                <li><a href="/inscription">S'inscrire</a></li>
                <li><a href="/connexion" class="connectBtn">Se connecter</a></li>
            </ul>
        <?php } else { ?> 
            <ul class="connectedNav">
                <li><a href="/profil"><span><?=$_SESSION['user']->username?></span><img class="navImg" src="/assets/img/circle-user-solid.svg" alt="pictogramme qui représente un portrait"></a></li>
                <li><a href="/controllers/logout-controller.php">Déconnexion</a></li>
            </ul>
        <?php } ?>
            
        </div>
    </nav>
</header>