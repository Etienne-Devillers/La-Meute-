<?php

require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../helpers/jwt.php');
require_once(dirname(__FILE__) . '/../../models/User.php');


if ($_SESSION['user']->id_roles != 1) {
    header('location: /accueil');
    exit;

} else {

    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/adminListUser.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php'); 
}