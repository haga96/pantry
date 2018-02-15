<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-01-25
 * Time: 13:35
 */

require_once ("../database/Connection.php");

class Login
{

    private $mail;
    private $password;
    private $id_user;
    private $users = [];


    public function __construct($mail, $password)
    {
        $this->mail = $mail;
        $this->password = $password;
    }

    public function selectUser() {

        $con = Connection::getInstance();
        $pdo = $con->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE mail='".$this->mail."' AND password='".$this->password."'");
        $stmt->execute([]);
        $raw = $stmt->fetchAll();
        return $raw;


    }

    public function checkUser(){
    if(!empty($this->selectUser())){
        $raw = $this->selectUser()[0];

        error_log($raw['id_user']);
        error_log(print_r($raw[0]['id_user'],TRUE));
        $session = new SessionManager();
        $session->setUser($raw['id_user']);
        return true;
    } else{
        return false;
    }
}


}