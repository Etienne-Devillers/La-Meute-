<?php
require_once(dirname(__FILE__).'/../../models/User.php');

$mail = trim(filter_input(INPUT_GET, 'mail', FILTER_SANITIZE_EMAIL));

$isMail = User::getByMail($mail);

if ($isMail instanceof PDOException) {
    echo json_encode('mail available');
} else {
    echo json_encode($isMail);
}