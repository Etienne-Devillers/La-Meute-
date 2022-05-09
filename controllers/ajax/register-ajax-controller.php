<?php
require_once(dirname(__FILE__).'/../../models/User.php');


if (!empty($_GET['mail'])){
    $mail = trim(filter_input(INPUT_GET, 'mail', FILTER_SANITIZE_EMAIL));
    $mailVerif = filter_var($mail, FILTER_VALIDATE_EMAIL);

    if (!$mailVerif) {
        echo json_encode('not good');
        exit;
    }
    $isMail = User::getByMail($mail);
    
    if ($isMail instanceof PDOException) {
        echo json_encode('mail available');
    } else {
        echo json_encode($isMail);
    }
}

if (!empty($_GET['username'])){
    $username = trim(filter_input(INPUT_GET, 'username', FILTER_SANITIZE_SPECIAL_CHARS));

    $isusername = User::getByUsername($username);
    
    if ($isusername instanceof PDOException) {
        echo json_encode('username available');
    } else {
        echo json_encode($isusername);
    }
} 
