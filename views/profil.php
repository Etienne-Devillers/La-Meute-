<?php
var_dump($_SESSION['user'])?>

<section id="profil">
    <div class="profilHeader positionProfil">
        <div class="categoryTitle">Mon compte</div>

    </div>
    <div class="coachingContainer positionProfil">
        <div class="categoryTitle">Mes coachings</div>

    </div>
    <div class="profilContainer positionProfil">
        <div class="categoryTitle">Informations personnelles</div>
        <div class="personnalInformationContainer">
            <div class="leftSideInfo">
                <div>
                    <img src="/assets/img/circle-user-solid.svg" alt="">
                    <div>inscris depuis le 01/10/1008</div>
                </div>
                <span >Mettre à jour les informations personnelles</span>
                
            </div>
            <div class="rightSideInfo">
                <form action="" class="formInfo">
                    
                    <label for="">Username</label>
                    <input type="text" class="formField" placeholder="<?=(!empty($_SESSION['user']->username)) ?$_SESSION['user']->username : 'non renseigné';?>" disabled>

                    <label for="">Adresse e-mail</label>
                    <input type="text" class="formField" placeholder="<?=(!empty($_SESSION['user']->mail)) ?$_SESSION['user']->mail : 'non renseigné';?>" disabled>

                    <label for="">Nom</label>
                    <input type="text" class="formField" placeholder="<?=(!empty($_SESSION['user']->lastname)) ?$_SESSION['user']->lastname : 'non renseigné';?>" disabled>

                    <label for="">Prénom</label>
                    <input type="text" class="formField" placeholder="<?=(!empty($_SESSION['user']->firstname)) ?$_SESSION['user']->firstname : 'non renseigné';?>" disabled>

                    <label for="">N° de Téléphone</label>
                    <input type="text" class="formField" placeholder="<?=(!empty($_SESSION['user']->phonenumber)) ?$_SESSION['user']->phonenumber : 'non renseigné';?>" disabled>

                </form>
            </div>
        </div>
    </div>
</section>