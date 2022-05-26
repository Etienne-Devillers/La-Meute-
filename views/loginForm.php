<!-------------------- Section connection -------------------->
<section class="registerSection flexColCenter">
    <h1>Connecte toi pour acceder à ton espace</h1>    
        <h5 class=><?= SessionFlash::display('message') ?? ''?></h5>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class=" formRegister flexColCenter" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    
        <label for="userName">Adresse Email ou nom d'utilisateur</label>
        <input type="email" 
        required
        name="mail" 
        id="mail" 
        class="field" 
        placeholder="<?= $error['mail'] ?? '' ?>"
        value="<?= (!isset($error['mail']) && isset($mail)) ? $mail : ''?>"
        >
        

        <label for="pwd">Mot de passe</label>
        <input type="password" 
        required
        name="pwd" 
        id="pwd" 
        class="field" 
        placeholder="<?= $error['pwd'] ?? '' ?>" 
        pattern="<?=REGEX_PASSWORD?>" 
        >

        <div class="greenWord">Mot de passe oublié ?</div>
        <input type="submit" value="Se connecter" class="" id="validForm">
    </form>
</section>