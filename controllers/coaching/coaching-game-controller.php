<?php
require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../models/User.php');

if (empty($_SESSION['user'])) {
    SessionFlash::create('Vous devez vous connecter pour accéder à cette section.');
    header('location: /connexion');
    exit;
}

$gameId = intval(filter_input(INPUT_GET, 'game', FILTER_SANITIZE_NUMBER_INT));


include(dirname(__FILE__).'/../../views/templates/header.php');
include(dirname(__FILE__).'/../../views/coaching-game.php');
include(dirname(__FILE__).'/../../views/templates/footer.php');