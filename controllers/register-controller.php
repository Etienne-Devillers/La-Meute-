<?php

require_once(dirname(__FILE__) . '/../utils/init.php');
require_once(dirname(__FILE__) . '/../utils/config.php');
require_once(dirname(__FILE__) . '/../models/User.php');


if ($_SERVER["REQUEST_METHOD"] == 'POST') {


    
   //===================== email : Nettoyage et validation =======================
        $mail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        if (!empty($mail)) {
            $testMail = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if (!$testMail) {
                $error['mail'] = 'L\'adresse email n\'est pas au bon format !';
            }
            if(User::isMailExists($mail)){
                $error['mail'] = 'Ce mail existe déjà';
            }
        } else {
            $error['mail'] = 'L\'adresse mail est obligatoire !';
        }


    //===================== username : Nettoyage et validation =======================
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        // On vérifie que ce n'est pas vide
        if (!empty($username)) {
            $testUsername = filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_USERNAME . '/')));
            // Avec une regex (constante déclarée dans le fichier config.php), on vérifie si c'est le format attendu 
            if (!$testUsername) {
                $error['username'] = 'Le nom n\'est pas au bon format !';
            }
            if(User::isUsernameExists($username)){
                $error['username'] = 'Ce nom d\'utilisateur existe déjà';
            }
        } else { // Pour les champs obligatoires, on retourne une erreur
            $error['username'] = 'Vous devez entrer un nom !';
        }

    //===================== password : Nettoyage et validation =======================

    $pwd = $_POST['pwd'];
    $confirmPwd = $_POST['confirmPwd'];
        if (!empty($pwd) && !empty($confirmPwd)) {
            if ($pwd == $confirmPwd) {
            $testPwd = filter_var($pwd, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')));
                if (!$testPwd) {
                    $error['pwd'] = 'Le mot de passe doit comporter au moins une majuscule, une minuscule, un caractère spécial, un chiffre et au moins 8 caractères' ;
                }
            } else {
                $error['pwd'] = 'Les mots de passe doivent être identiques.';
            }
        } else {
            $error['pwd'] = 'Remplissez les deux champs.' ;
        }


        if (empty($error)) {
            $user = new User($mail, $pwd, $username);
            $user->add();
            SessionFlash::create('Votre compte a bien était créé.');
            header('location: /connexion');
            exit;   
        } else {

            include(dirname(__FILE__).'/../views/templates/header.php');
            include(dirname(__FILE__).'/../views/form.php');
            include(dirname(__FILE__).'/../views/templates/footer.php');
        }

} else {

    include(dirname(__FILE__).'/../views/templates/header.php');
    include(dirname(__FILE__).'/../views/form.php');
    include(dirname(__FILE__).'/../views/templates/footer.php');
}


