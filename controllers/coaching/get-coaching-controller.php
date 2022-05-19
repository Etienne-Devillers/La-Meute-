<?php
require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../models/User.php');
require_once(dirname(__FILE__) . '/../../models/Coaching.php');
require_once(dirname(__FILE__) . '/../../utils/db.php');


$coachId = intval(filter_input(INPUT_GET, 'coachId', FILTER_SANITIZE_NUMBER_INT));

$coachList = User::getCoach();


$isCoachExists = false;

foreach ($coachList as $key => $value) {  
    if ($coachId == $value->id) {
        $isCoachExists = true;
    }
}

if ($isCoachExists === true){

    // $pdo = Database::dbConnect();
    // $pdo->beginTransaction();

    // $coaching = new Coaching('2022-05-20', 57, 6);
    // $coachingCreated = $coaching->create();
    // $id_coaching = $pdo->lastInsertId();
    // $userAdded = Coaching::addUser(24, $id_coaching);
    // if ($coachingCreated === true && $userAdded === true){
    //     $pdo->commit();
    // } else {
    //     $pdo->rollBack();
    // }

    // $test = Coaching::isCoachingExists('2022-05-20', 57, 6);
    
    
    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/get-coaching.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php');
} else {
    header('location: /choix-du-jeu');
    exit;
}

