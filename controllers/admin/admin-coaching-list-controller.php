<?php
require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../models/User.php');
require_once(dirname(__FILE__) . '/../../models/Coaching.php');



if ($_SESSION['user']->id_role != 1) {
    header('location: /accueil');
    exit;

} else {

    if (!empty($_GET)) {
        $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));
        $perPage = intval(filter_input(INPUT_GET, 'userPerPage', FILTER_SANITIZE_NUMBER_INT));
        
        $userNum = User::count($search);
        $pages = ceil($userNum / $perPage);

        $currentPage = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));

        if($currentPage <= 0 || $currentPage > $pages){
            $currentPage = 1;
        }
        $offset = $perPage*($currentPage-1);


    }   else {
        // $userList = User::getAll();
    }

    $coachingList = Coaching::getList();
    var_dump($coachingList);
    die;
    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/admin-coaching-list.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php'); 
}
