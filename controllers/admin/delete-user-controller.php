<?php

require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../helpers/jwt.php');
require_once(dirname(__FILE__) . '/../../models/User.php');


if ($_SESSION['user']->id_role != 1) {
    header('location: /accueil');
    exit;

} else {

    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    User::delete($id);

    header('location: /controllers/admin/admin-list-user-controller.php?userPerPage=25&search=');
    exit;
}