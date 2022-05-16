

<section id="profil">
    <div class="profilHeader positionProfil">
        <div class="categoryTitle">Mon compte</div>
        <span><?=SessionFlash::display('message') ?? ''?></span>

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
                    <div><a href="/changer-mot-de-passe" class="resetPwd">Changer le mot de passe</a></div>
                </div>
                <div class="btnProfilContainer">
                    <span class="deleteProfil">Supprimer le compte</span>
                    <span class="updateProfil">Mettre à jour les informations personnelles</span>
                </div>
            </div>
            <div class="rightSideInfo">
                <form action="/controllers/update-controller.php" method="post" class="formInfo">

                    <label for="username">Username</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($_SESSION['user']->username)) ?$_SESSION['user']->username : 'non renseigné';?>"
                        name="username" disabled>
                        <span class="errorMsg"><?=$error['username'] ?? ''?> </span>

                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="formField"
                        placeholder="<?=(!empty($_SESSION['user']->mail)) ?$_SESSION['user']->mail : 'non renseigné';?>"
                        name="email" disabled>
                        

                    <label for="lastname">Nom</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($_SESSION['user']->lastname)) ?$_SESSION['user']->lastname : 'non renseigné';?>"
                        name="lastname" disabled>
                        <span class="errorMsg"><?=$error['lastname'] ?? ''?> </span>

                    <label for="firstname">Prénom</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($_SESSION['user']->firstname)) ?$_SESSION['user']->firstname : 'non renseigné';?>"
                        name="firstname" disabled>
                        <span class="errorMsg"><?=$error['firstname'] ?? ''?> </span>

                    <label for="phoneNumber">N° de Téléphone</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($_SESSION['user']->phonenumber)) ?$_SESSION['user']->phonenumber : 'non renseigné';?>"
                        name="phoneNumber" disabled>
                        <span class="errorMsg"><?=$error['phoneNumber'] ?? ''?> </span>

                    <input type="hidden" value="<?=(!empty($_SESSION['user']->id)) ?$_SESSION['user']->id : '';?>" name="id">

                    <input type="submit" class="submitBtn">
                </form>
            </div>
        </div>
    </div>
</section>