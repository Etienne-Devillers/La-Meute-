<!-------------------- Section connection -------------------->
<section class="registerSection flexColCenter">
    <h1>Connecte toi pour acceder à ton espace</span></h1>    
    
    <form action="" class=" formRegister flexColCenter" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    
        <label for="userName">Adresse Email ou nom d'utilisateur</label>
        <input type="text" 
        required
        name="userName" 
        id="userName" 
        class="field" 
        placeholder="<?= $error['email'] ?? '' ?>"
        value="<?= (!isset($error['email']) && isset($email)) ? $email : ''?>"
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