<?php
/**
 *
 *
 */
require_once ("../database/PantryBase.php");

if(isset($_POST['action'])){



    if($_POST['action'] == 1){


        $prod=new Product($_POST['name'],$_POST['amount'],$_POST['datayt'],0,$_POST['category_name'],$_POST['measure']);

        $base=new PantryBase(1);

        $base->insertProduct($prod);
        echo json_encode("Wstawiono dane");
        
    }

    if($_POST['action'] == 'REGISTER'){
    }

}
