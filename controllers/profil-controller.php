<?php
require_once(dirname(__FILE__) . '/../utils/init.php');
require_once(dirname(__FILE__) . '/../utils/config.php');
require_once(dirname(__FILE__) . '/../models/User.php');
require_once(dirname(__FILE__) . '/../models/Coaching.php');


$coachingList = Coaching::getList($_SESSION['user']->id);

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/profil.php');
include(dirname(__FILE__).'/../views/templates/footer.php');