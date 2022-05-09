<?php


class SessionFlash {
    public static function create(string $message):void{
        $_SESSION['message'] = $message;
    }

    public static function display($key){
        $display = $_SESSION[$key] ?? '';
        SessionFlash::unset($key);
        return $display;
    }

    public static function unset($key){
        unset($_SESSION[$key]);
    }
}
