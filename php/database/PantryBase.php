<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-02-15
 * Time: 17:32
 */
require_once ("C:\\xampp\\htdocs\\pantry\\php\\entities\\Product.php");
require_once ("Connection.php");
require_once ("C:\\xampp\\htdocs\\pantry\\php\\controller\\SessionManager.php");
require_once ("DataMapper.php");

class PantryBase  extends DataMapper
{
    private $id_user;
    public function __construct()
    {
        parent::__construct();

        $session = new SessionManager();
        $this->id_user = $session->getUser();
    }

    public function insert($entity)
    {
        $pantry_name=$entity;
        $this->pdo->beginTransaction();


        $insert_stmt = $this->pdo->prepare("INSERT INTO `pantry` (`name`) VALUES (?)");
        $insert_stmt->bindParam(1, $pantry_name);
        $insert_stmt->execute();
        $fk_id_pantry = $this->pdo->lastInsertId();
        $insert_stmt = $this->pdo->exec("INSERT INTO `user_pantry` (`id_pantry`,`id_user`) VALUES ('$fk_id_pantry','$this->id_user')");

        $this->pdo->commit();

    }
}