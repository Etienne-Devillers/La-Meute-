
<section class="changePwd">

<div class="profilContainer positionProfil resetPwdContainer">
        <div class="categoryTitle">Changer le mot de passe</div>
        <div class="errorMsg"> <?=$error['pwd'] ?? ''?></div>
        <div class="personnalInformationContainer">
        <form action="/changer-mot-de-passe" class="formInfo" method="post">
            <label for="oldPwd" class="">Ancien mot de passe</label>
            <input type="password" name="oldPwd" id="oldPwd"  class="formField">

            <label for="newPwd" class="">Nouveau mot de passe</label>
            <input type="password" name="newPwd" id="newPwd"  class="formField">

            <label for="newPwdConfirm" class="">Confirmation nouveau mot de passe</label>
            <input type="password" name="newPwdConfirm" id="newPwdConfirm"  class="formField">
            
            <input type="submit" class="submitBtnPwd">
        </form>
        </div>
    </div>
</section>