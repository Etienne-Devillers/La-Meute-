<!-------------------- Section register -------------------->
<section class="registerSection flexColCenter">
    <h1>Rejoins <span class="greenWord">la meute</span></h1>    
    <h5>Crée ton compte et commence dès aujourd'hui</h5>
    <form action="" class=" formRegister flexColCenter" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    
        <label for="email">Adresse Email</label>
        <input type="email" 
        required
        name="email" 
        id="email" 
        class="field" 
        placeholder="<?= $error['email'] ?? '' ?>"
        value="<?= (!isset($error['email']) && isset($email)) ? $email : ''?>"
        >
        

        <label for="userName">Nom d'utilisateur</label>
        <input type="text"
        required 
        name="userName" 
        id="userName" 
        class="field" 
        placeholder="<?= $error['userName'] ?? '' ?>"
        pattern="<?=REGEX_USERNAME?>"
        value="<?= (!isset($error['userName']) && isset($userName))? $userName : ''?>" 
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

        <label for="confirmPwd">Confirmation Mot de passe</label>
        <input type="password" 
        required
        name="confirmPwd" 
        id="confirmPwd" 
        class="field" 
        placeholder="<?= $error['pwd'] ?? '' ?>" 
        pattern="<?=REGEX_PASSWORD?>"  
        >
        

        <input type="submit" value="S'inscrire" class="" id="validForm">
    </form>
</section>