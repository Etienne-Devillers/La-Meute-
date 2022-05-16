<?php
require_once(dirname(__FILE__).'/../utils/init.php');
require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../models/User.php');

if (!empty($_SESSION['user'])) {
    header('location: /accueil');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){


    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
    
    if (empty($mail)) {
        
        $error['mail'] = 'Veuillez saisir une adresse mail de connexion.';
    } 

    $pwd = $_POST['pwd'];

    if (empty($pwd)) {
        $error['pwd'] = 'Veuillez saisir un mot de passe.';
    }

    if (empty($error)) {
        $user = User::login($mail);
        if (empty($user)) {

            $error['mail'] = 'le mail saisi n\est pas valide.';

        } else {

        $hash = $user->pwd;
        if (password_verify($pwd, $hash) === false){
            $error['pwd'] = 'Mot de passe invalide.';
        } else {
            $_SESSION['user'] = $user;
            header('location:/accueil');
            exit;
        }
    }
    }

}


include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/loginForm.php');
include(dirname(__FILE__).'/../views/templates/footer.php');