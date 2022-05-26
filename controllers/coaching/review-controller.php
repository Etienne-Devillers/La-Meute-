<?php
require_once(dirname(__FILE__) . '/../../utils/init.php');
require_once(dirname(__FILE__) . '/../../utils/config.php');
require_once(dirname(__FILE__) . '/../../models/User.php');
require_once(dirname(__FILE__) . '/../../models/Coaching.php');
require_once(dirname(__FILE__) . '/../../utils/db.php');

if (empty($_SESSION['user'])) {
    SessionFlash::create('Vous devez vous connecter pour accéder à cette section.');
    header('location: /connexion');
    exit;
}