<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-01-25
 * Time: 13:38
 */

class Connection
{

    private static $instance;
    private $pdo;

    public static function getInstance(){
        if(!(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function getPdo()
    {
        return $this->pdo;
    }

    private function __construct()
    {
        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=pantry', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e)
        {
            echo 'The connection could not be created: ' . $e->getMessage();
        }
    }



}