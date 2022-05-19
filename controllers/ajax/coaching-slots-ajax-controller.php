<?php
require_once(dirname(__FILE__).'/../../models/User.php');
require_once(dirname(__FILE__).'/../../models/Coaching.php');

$date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS));

$date = explode(",", $date);


$coachId = intval(filter_input(INPUT_POST, 'coachId', FILTER_SANITIZE_NUMBER_INT));

$coachingList = Coaching::coachingList($date, $coachId);

echo json_encode($coachingList);