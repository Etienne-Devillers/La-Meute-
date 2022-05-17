<?php

require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../helpers/jwt.php');
require_once(dirname(__FILE__) . '/../../models/User.php');

if ($_SESSION['user']->id_role != 1) {
    header('location: /accueil');
    exit;

} else {

$mail = trim(filter_input(INPUT_GET, 'mail', FILTER_SANITIZE_EMAIL));

$userProfil = User::getByMail($mail);
if ($userProfil instanceof PDOException) {
    header('location: /controllers/admin/admin-list-user-controller.php?userPerPage=25&search=');
exit;}

include(dirname(__FILE__).'/../../views/templates/header.php');
include(dirname(__FILE__).'/../../views/adminShowProfil.php');
include(dirname(__FILE__).'/../../views/templates/footer.php'); 

}