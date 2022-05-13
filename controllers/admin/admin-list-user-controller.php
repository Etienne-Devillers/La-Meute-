<?php

require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../helpers/jwt.php');
require_once(dirname(__FILE__) . '/../../models/User.php');


if ($_SESSION['user']->id_roles != 1) {
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


        $userList = User::getAll($search, $perPage, $offset);
    }   else {
        $userList = User::getAll();
    }
    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/adminListUser.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php'); 
}