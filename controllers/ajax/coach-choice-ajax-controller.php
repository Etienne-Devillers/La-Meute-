<?php
require_once(dirname(__FILE__).'/../../models/User.php');

if (!empty($_GET['game'])) {

    $game = trim(filter_input(INPUT_GET, 'game', FILTER_SANITIZE_SPECIAL_CHARS));

    $coachList = User::getCoach($game);

    $result= json_encode($coachList);

    echo $result;
}