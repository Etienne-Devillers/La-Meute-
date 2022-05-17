<?php 
require_once(dirname(__FILE__) . '/../utils/init.php');
require_once(dirname(__FILE__) . '/../utils/config.php');
require_once(dirname(__FILE__) . '/../models/User.php');


if (empty($_SESSION['user'])) {
    header('location: /accueil');
    exit;
} 

if (empty($_POST)) {
    
    include(dirname(__FILE__).'/../views/templates/header.php');
    include(dirname(__FILE__).'/../views/changePwd.php');
    include(dirname(__FILE__).'/../views/templates/footer.php');

} else {


    $hash = $_SESSION['user']->pwd;

    $oldPwd = $_POST['oldPwd'];
    $newPwd = $_POST['newPwd'];
    $newPwdConfirm = $_POST['newPwdConfirm'];

    if (password_verify($oldPwd, $hash) === false){
            $error['pwd'] = 'Mot de passe invalide.';
        } 

    if (!empty($newPwd) && !empty($newPwdConfirm)) {
        if ($newPwd == $newPwdConfirm) {
        $testPwd = filter_var($newPwd, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')));
            if (!$testPwd) {
                $error['pwd'] = 'Le mot de passe doit comporter au moins une majuscule, une minuscule, un caractère spécial, un chiffre et au moins 8 caractères' ;
            }
        } else {
            $error['pwd'] = 'Les mots de passe doivent être identiques.';
        }
    } else {
        $error['pwd'] = 'Remplissez les deux champs.' ;
    }

    if ($oldPwd == $newPwd) {
        $error['pwd'] = 'Vous avez saisi le même mot de passe.' ;
    }


    if (!empty($error)) {
        include(dirname(__FILE__).'/../views/templates/header.php');
        include(dirname(__FILE__).'/../views/changePwd.php');
        include(dirname(__FILE__).'/../views/templates/footer.php');
    } else {

        SessionFlash::create('Votre mot de passe a bien été modifié. Connectez vous à nouveau.');
        $newPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        User::updatePwd($_SESSION['user']->mail, $newPwd);
        unset($_SESSION['user']);
        header('location: /controllers/login-controller.php');
        exit;
    }





    include(dirname(__FILE__).'/../views/templates/header.php');
    include(dirname(__FILE__).'/../views/changePwd.php');
    include(dirname(__FILE__).'/../views/templates/footer.php');
}

