<?php

require_once(dirname(__FILE__) . '/../utils/init.php');
require_once(dirname(__FILE__) . '/../utils/config.php');
require_once(dirname(__FILE__) . '/../helpers/jwt.php');
require_once(dirname(__FILE__) . '/../models/User.php');


if ($_SERVER["REQUEST_METHOD"] == 'POST') {


    //===================== username : Nettoyage et validation =======================
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        // On vérifie que ce n'est pas vide
        if (!empty($username) ) {
            $testUsername = filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_USERNAME . '/')));
            // Avec une regex (constante déclarée dans le fichier config.php), on vérifie si c'est le format attendu 
            if (!$testUsername) {
                $error['username'] = 'Le nom n\'est pas au bon format !';
            }
            if(User::isUsernameExists($username) && ($username != $_SESSION['user']->username)){
                $error['username'] = 'Ce nom d\'utilisateur existe déjà';
            }
        } else { 
            $username = $_SESSION['user']->username;
        }

        //===================== lastname : Nettoyage et validation =======================
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        // On vérifie que ce n'est pas vide
        if (!empty($lastname)) {
            $testlastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_NONUMBER . '/')));
            // Avec une regex (constante déclarée dans le fichier config.php), on vérifie si c'est le format attendu 
            if (!$testlastname) {
                $error['lastname'] = 'Le nom n\'est pas au bon format !';
            }
            
        } else { 
            $lastname = $_SESSION['user']->lastname;
        }

        //===================== firstname : Nettoyage et validation =======================
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        // On vérifie que ce n'est pas vide
        if (!empty($firstname)) {
            $testfirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_NONUMBER . '/')));
            // Avec une regex (constante déclarée dans le fichier config.php), on vérifie si c'est le format attendu 
            if (!$testfirstname) {
                $error['firstname'] = 'Le nom n\'est pas au bon format !';
            }
            
        } else { 
            $firstname = $_SESSION['user']->firstname;
        }

        //===================== telephone : Nettoyage et validation =======================
        $phoneNumber = trim(filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_SPECIAL_CHARS));
        if (!empty($phoneNumber)) {
            $phoneNumberCheck = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array('regexp'=>'/'.REGEX_PHONE.'/')));
            if ($phoneNumberCheck === false) {
                $error['phoneNumber'] = 'Veuillez rentrer un format valide !';
            }
        } else { 
            $phoneNumber = $_SESSION['user']->phonenumber;
        }

    if (empty($error)){
        $mail = $_SESSION['user']->mail;
        User::update($username, $mail, $lastname, $firstname, $phoneNumber);

        SessionFlash::create('Le profil a bien été mis à jour.');
        unset($_SESSION['user']);
        $_SESSION['user'] = User::login($mail);

        header('location: /profil');
        exit;
    } else {

        include(dirname(__FILE__).'/../views/templates/header.php');
        include(dirname(__FILE__).'/../views/profil.php');
        include(dirname(__FILE__).'/../views/templates/footer.php');
    }
}