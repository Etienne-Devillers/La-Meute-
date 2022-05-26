<?php
require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../models/User.php');
require_once(dirname(__FILE__) . '/../../models/Coaching.php');

if (empty($_SESSION['user'])) {
    SessionFlash::create('Vous devez vous connecter pour accéder à cette section.');
    header('location: /connexion');
    exit;
}

$coachingId = intval(filter_input(INPUT_GET, 'coachingId', FILTER_SANITIZE_NUMBER_INT));

$coachingList = Coaching::getList($_SESSION['user']->id, '', 100);

$allowDelete = false;

foreach ($coachingList as $key => $value) {
    
    if ($value->id == $coachingId){
        $allowDelete = true;
    }
}

if ($allowDelete === true) {
    $test = Coaching::delete($coachingId);
    header('location: /profil');
    SessionFlash::create('le coaching a bien été supprimé');
}  else {
    header('location: /profil');
    exit; 
}