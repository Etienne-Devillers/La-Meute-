<?php
require_once(dirname(__FILE__) . '/../utils/init.php');
require_once(dirname(__FILE__) . '/../utils/config.php');
require_once(dirname(__FILE__) . '/../models/User.php');
require_once(dirname(__FILE__) . '/../models/Coaching.php');

$registeredDate = strtotime($_SESSION['user']->registered_at);
$registeredDate = date('d/m/Y', $registeredDate);



$coachingList = Coaching::getList($_SESSION['user']->id);


foreach ($coachingList as $key => $value) {
    $coachingDateTime = $value->date.' '.$value->slot;
    $coachingDateTime = DateTime::createFromFormat('d/m/Y H:i', $coachingDateTime);
    
    $actualDate = new DateTime('now');
    
    if ($actualDate>$coachingDateTime) {
        $value->datePast=true;
    }
}


include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/profil.php');
include(dirname(__FILE__).'/../views/templates/footer.php');