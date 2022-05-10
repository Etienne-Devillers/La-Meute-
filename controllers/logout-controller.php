
<?php
require_once(dirname(__FILE__).'/../utils/init.php');

$_SESSION = array();

// On détruit la session
session_destroy();

header('Location: /accueil');
exit;