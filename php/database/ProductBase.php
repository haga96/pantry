<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-01-25
 * Time: 16:46
 */

require_once ("C:\\xampp\\htdocs\\pantry\\php\\entities\\Product.php");
require_once ("Connection.php");
require_once ("C:\\xampp\\htdocs\\pantry\\php\\controller\\SessionManager.php");
require_once ("DataMapper.php");

class ProductBase extends DataMapper
{

//    private $raw =[];
    //private $pdo;
   // private $view_name;

   // private $select_stmt;
    private $insert_stmt;

    private $id_pantry;

    public function __construct($id_pantry)
    {


        parent::__construct();
        $this->id_pantry=$id_pantry;

        //$con = Connection::getInstance();
        //$this->pdo = $con->getPdo();

        //$session = new SessionManager();
        //$user = $session->getUser();

        $this->view_name = 'PantryView'.$id_pantry;
        $this->createView($id_pantry);


        $this->select_stmt = $this->pdo->prepare("SELECT * FROM $this->view_name");
        $this->select_stmt->bindParam(1, $this->id_pantry);
        //$this->insert_stmt = $this->pdo->prepare("Insert idt... ");

        $this->view_stmt = $this->pdo->prepare("CREATE VIEW $this->view_name AS
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

        $this->view_stmt->bindParam(1,$id_pantry);


    }



    public function insert($entity){

        $category_name=$entity->getCategoryName();
        $name=$entity->getName();
        $datayt=$entity->getDatayt();
        $amount=$entity->getAmount();
        $measure=$entity->getMeasure();
        $this->pdo->beginTransaction();
        $select_stmt = $this->pdo->prepare("SELECT id_category FROM categories WHERE category_name = ?");
        $select_stmt->bindParam(1, $category_name);
        $select_stmt->execute();
        $row = $select_stmt->fetch();
        if($row){
            //categoria jest
            $fk_id_cat = $row['id_category'];
        } else {
            //trza ją dodać
            $insert_stmt = $this->pdo->exec("INSERT INTO `categories` (`category_name`) VALUES ('$category_name')");
            $fk_id_cat = $this->pdo->lastInsertId();
        }

        $insert_stmt = $this->pdo->prepare("INSERT INTO `products` (`name`,`datayt`,`amount`,`measure`, `id_category`) VALUES (?, ?, ?, ?, ?)");
        $insert_stmt->bindParam(1, $name);
        $insert_stmt->bindParam(2, $datayt);
        $insert_stmt->bindParam(3, $amount);
        $insert_stmt->bindParam(4, $measure);
        $insert_stmt->bindParam(5, $fk_id_cat);
        $insert_stmt->execute();
        $fk_id_prod = $this->pdo->lastInsertId();
        $insert_stmt = $this->pdo->exec("INSERT INTO `pantry_products` (`id_product`,`id_pantry`) VALUES ('$fk_id_prod','$this->id_pantry')");

        $this->pdo->commit();

    }


}