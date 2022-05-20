
<section id="profil">
    <div class="profilHeader positionProfil">
        <div class="categoryTitle"><?=$userProfil->mail?> - <?=$userProfil->role?></div>
        

    </div>

    <div class="profilContainer positionProfil">
        <div class="categoryTitle">Informations personnelles</div>
        <div class="personnalInformationContainer">
            <div class="leftSideInfo">
                <div>
                    <img src="/assets/img/circle-user-solid.svg" alt="" class="userImg">
                    <div class="registered_at dateTimeInfo">inscris depuis le <?=$userProfil->registered_at?></div>
                    <div class="validated_at dateTimeInfo"><?=(!empty($userProfil->validated_at)) ? 'Compte validé le '.$userProfil->validated_at : 'Ce compte n\'est pas validé.';?></div>
                    <div class="connected_at dateTimeInfo"><?=(!empty($userProfil->connected_at)) ? 'Dernière connexion le '.$userProfil->connected_at : 'Pas de dernière connexion connue.';?></div>
                </div>
                <div class="btnProfilContainer">
                    <?= ($userProfil->id_role !=1 ) ?'<a class="deleteProfil" href="/controllers/admin/delete-user-controller.php?id='.$userProfil->id.'">Archiver le compte</a>' : ' ' ;?>
                    <!-- <span class="updateProfil">Mettre à jour les informations personnelles</span> -->
                </div>
            </div>
            <div class="rightSideInfo">
                <form action="/controllers/update-controller.php" method="post" class="formInfo">

                    <label for="username">Username</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($userProfil->username)) ?$userProfil->username : 'non renseigné';?>"
                        name="username" disabled>
                        <span class="errorMsg"><?=$error['username'] ?? ''?> </span>

                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="formField"
                        placeholder="<?=(!empty($userProfil->mail)) ?$userProfil->mail : 'non renseigné';?>"
                        name="email" disabled>
                        

                    <label for="lastname">Nom</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($userProfil->lastname)) ?$userProfil->lastname : 'non renseigné';?>"
                        name="lastname" disabled>
                        <span class="errorMsg"><?=$error['lastname'] ?? ''?> </span>

                    <label for="firstname">Prénom</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($userProfil->firstname)) ?$userProfil->firstname : 'non renseigné';?>"
                        name="firstname" disabled>
                        <span class="errorMsg"><?=$error['firstname'] ?? ''?> </span>

                    <label for="phoneNumber">N° de Téléphone</label>
                    <input type="text" class="formField"
                        placeholder="<?=(!empty($userProfil->phonenumber)) ?$userProfil->phonenumber : 'non renseigné';?>"
                        name="phoneNumber" disabled>
                        <span class="errorMsg"><?=$error['phoneNumber'] ?? ''?> </span>

                    <input type="hidden" value="<?=(!empty($userProfil->id)) ?$userProfil->id : '';?>" name="id">

                    <input type="submit" class="submitBtn">
                </form>
            </div>
        </div>
    </div>
</section>