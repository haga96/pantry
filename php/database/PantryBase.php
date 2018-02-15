<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-01-25
 * Time: 16:46
 */

require_once ("php/entities/Product.php");
require_once ("php/database/Connection.php");
require_once ("php/controller/SessionManager.php");

class PantryBase
{

//    private $raw =[];
    private $pdo;
    private $view_name;

    private $select_stmt;
    private $insert_stmt;


    public function __construct($id_pantry)
    {
        /*w pantry.php:
         *
         * $base = new PantryBase($_POST['id_pantry'];
         * $raw = $base->selectAllProducts();
         * foreach($raw as $row){
         *     echo '<div>cos tam $row itd....</div>'
         * }
         *
         * */


        $con = Connection::getInstance();
        $this->pdo = $con->getPdo();

        $session = new SessionManager();
        $user = $session->getUser();

        $this->view_name = 'PantryView'.$id_pantry;
        $this->createView($id_pantry);


        $this->select_stmt = $this->pdo->prepare("SELECT * FROM $this->view_name");
        //$this->insert_stmt = $this->pdo->prepare("Insert idt... ");




    }
    public function viewExists() {
        try {
            $result = $this->pdo->query("SELECT 1 FROM $this->view_name LIMIT 1");
        } catch (Exception $e) {
            return FALSE;
        }
        return $result !== FALSE;
    }


    public function createView($id_pantry){
        if(!$this->viewExists()){
            $view_stmt = $this->pdo->prepare("CREATE VIEW $this->view_name AS
SELECT 
products.id_product,products.name,products.datayt,products.amount,products.measure,products.id_category AS fk_id_category,
categories.category_name,categories.id_category,
pantry_products.id_pantry, pantry_products.id_product AS fk_id_product

FROM pantry.products
INNER JOIN pantry.pantry_products
ON pantry.products.id_product = pantry.pantry_products.id_product
INNER JOIN pantry.categories
ON pantry.categories.id_category=pantry.products.id_category
WHERE pantry.pantry_products.id_pantry = ?");
            $view_stmt->bindParam(1,$id_pantry);
            $view_stmt->execute();
        }
    }

    public function selectAllProducts(){



     $this->select_stmt->bindParam(1, $id_pantry);
        $this->select_stmt->execute();
        $raw = $this->select_stmt->fetchAll();
        return $raw;

//        error_log( print_r($raw, TRUE) );

//        foreach ($raw as $row){
//            //echo $row[];
//            error_log( "row: ". print_r($row, TRUE) );
//        }

    }

    public function insertProduct($product){

        $pdo->beginTransaction();
        $select_stmt = $pdo->prepare("SELECT id_category FROM categories WHERE category_name = ?");
        $select_stmt->bindParam(1, $category_name);
        $select_stmt->execute();
        $row = $select_stmt->fetch();
        if($row){
            //categoria jest
            $fk_id_cat = $row['id_category'];
        } else {
            //trza ją dodać
            $insert_stmt = $pdo->exec("INSERT INTO `categories` (`category_name`) VALUES ('$category_name')");
            $fk_id_cat = $pdo->lastInsertId();
        }

        $insert_stmt = $pdo->prepare("INSERT INTO `products` (`name`,`datayt`,`amount`,`measure`, `fk_id_category`) VALUES (?, ?, ?, ?, ?)");
        $insert_stmt->bindParam(1, $name);
        $insert_stmt->bindParam(2, $datayt);
        $insert_stmt->bindParam(3, $amount);
        $insert_stmt->bindParam(4, $measure);
        $insert_stmt->bindParam(5, $fk_id_cat);
        $insert_stmt->execute();
        $fk_id_prod = $pdo->lastInsertId();
        $insert_stmt = $pdo->exec("INSERT INTO `pantry_product` (`fk_id_product`) VALUES ('$fk_id_prod')");

        $pdo->commit();

    }


}