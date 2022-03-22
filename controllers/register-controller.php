<?php

require(dirname(__FILE__) . '/../utils/config.php');


if ($_SERVER["REQUEST_METHOD"] == 'POST') {


    
   //===================== email : Nettoyage et validation =======================
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        if (!empty($email)) {
            $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$testEmail) {
                $error['email'] = 'L\'adresse email n\'est pas au bon format !';
            }
        } else {
            $error['email'] = 'L\'adresse mail est obligatoire !';
        }


    //===================== userName : Nettoyage et validation =======================
        $userName = trim(filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        // On vérifie que ce n'est pas vide
        if (!empty($userName)) {
            $testuserName = filter_var($userName, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_USERNAME . '/')));
            // Avec une regex (constante déclarée dans le fichier config.php), on vérifie si c'est le format attendu 
            if (!$testuserName) {
                $error['userName'] = 'Le nom n\'est pas au bon format !';
            }
        } else { // Pour les champs obligatoires, on retourne une erreur
            $error['userName'] = 'Vous devez entrer un nom !';
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

}


