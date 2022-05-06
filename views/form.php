<!-------------------- Section register -------------------->
<section class="registerSection flexColCenter">
    <h1>Rejoins <span class="greenWord">la meute</span></h1>    
    <h5>Crée ton compte et commence dès aujourd'hui</h5>
    <form class=" formRegister flexColCenter" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    
        <label for="email">Adresse Email</label>
        <input type="email" 
        required
        name="email" 
        id="email" 
        class="field mailBorder" 
        placeholder="<?= $error['mail'] ?? '' ?>"
        value="<?= (!isset($error['mail']) && isset($mail)) ? $mail : ''?>"
        >
        

        <label for="username">Nom d'utilisateur</label>
        <input type="text"
        required 
        name="username" 
        id="username" 
        class="field" 
        placeholder="<?= $error['username'] ?? '' ?>"
        pattern="<?=REGEX_USERNAME?>"
        value="<?= (!isset($error['username']) && isset($username))? $username : ''?>" 
        >

        <label for="pwd">Mot de passe</label>
        <input type="password" 
        required
        name="pwd"
   
        id="pwd" 
        class="field border" 
        placeholder="<?= $error['pwd'] ?? '' ?>" 
        pattern="<?=REGEX_PASSWORD?>" 
        >

        <label for="confirmPwd">Confirmation Mot de passe</label>
        <input type="password" 
        required
        name="confirmPwd" 
        id="confirmPwd" 
        class="field border" 
        placeholder="<?= $error['pwd'] ?? '' ?>" 
        pattern="<?=REGEX_PASSWORD?>"  
        >
        

        <input type="submit" value="S'inscrire" class="" id="validForm">
    </form>
</section>