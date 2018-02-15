<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-01-25
 * Time: 18:36
 */
require_once ("../database/Connection.php");

class Registration
{
    private $mail;
    private $name;
    private $surname;
    private $password;

    private $id_user;
    private $users = [];


    public function __construct($mail, $name, $surname, $password)
    {
        $this->mail = $mail;
        $this->password = $password;
        $this->name=$name;
        $this->surname=$surname;
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
        return !empty($this->selectUser());
    }

    public function createUser(){
        if($this->checkUser())return 0;
        else {
            $con = Connection::getInstance();
            $pdo = $con->getPdo();
            //error_log($this->mail);
            //error_log($this->password);

            $stmt = $pdo->prepare("INSERT INTO users (mail, password, name, surname ) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $this->mail);
            $stmt->bindParam(2, $this->password);
            $stmt->bindParam(3, $this->name);
            $stmt->bindParam(4, $this->surname);
            $stmt->execute();

            return $pdo->lastInsertId();
        }
    }


}

