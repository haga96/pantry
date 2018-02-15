<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-02-08
 * Time: 20:22
 */

class SessionManager{

    const TIME_OUT = 10*60;
    private $fingerprint;

    public function __construct(){
        $this->fingerprint = sha1('SECRET-SALT'.$_SERVER['HTTP_USER_AGENT']);

    }

    public function setUser($id_user){
        session_start();
        $this->generateSession();
        $_SESSION['id_user'] = $id_user;
    }

    public function generateSession(){
        session_regenerate_id();
        $_SESSION['last_active'] = time();
        $_SESSION['fingerprint'] = $this->fingerprint;
    }

    public function checkSession($logout = false){
        session_start();
        if((isset($_SESSION['last_active']) && (time() > ($_SESSION['last_active']+self::TIME_OUT)))){
            error_log('last_active error');
        }
        if((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint']!=$this->fingerprint)){
            error_log('fingerprint error');
        }
        if($logout){
            error_log('logout error');
        }

        if ( (isset($_SESSION['last_active']) && (time() > ($_SESSION['last_active']+self::TIME_OUT)))
            || (isset($_SESSION['fingerprint']) && $_SESSION['fingerprint']!=$this->fingerprint)
            || $logout ) {
            session_destroy();
            return false;
        }
        $this->generateSession();
        return true;
    }


    public function getUser(){
        if($this->checkSession() && isset($_SESSION['id_user'])){
            return $_SESSION['id_user'];
        }else{
            return null;
        }
    }


}
