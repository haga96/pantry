<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-02-13
 * Time: 13:52
 */

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pantry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <link href="css/IndexStyle.css" rel="stylesheet" type="text/css">

    <script>
        $(document).ready(function () {
            $("#insert-pop-up").hide();
            $("#show").click(function(){
                $("#insert-pop-up").fadeToggle();
            });

            $("#btn").click(function(){
                console.log($("#name").val());
                $.ajax({
                    url: "php/controller/ProductController.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        action: 1,
                        //nazwa_klucza: pobrane dane z inputa: $("#id-inputa").val(), np:
                        name: $("#name").val(),
                        datayt: $("#datayt").val(),
                        amount: $("#amount").val(),
                        measure: $("#measure").val(),
                        category_name: $("#category_name").val(),
                        id_pantry: parseInt($("#id_pantry").text())
                    }
                }).done(function (data) {
                    alert(data);

                });
                $("#insert-pop-up").fadeOut();
            });


        })


    </script>

</head>





<body>
<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("php/database/ProductBase.php");
$session=new SessionManager();

if(isset($_POST['PANTRY_ID'])){

    $session->setPantry($_POST['PANTRY_ID']);
    //error_log($_SESSION['id_pantry']);
}

if($session->getPantry()){
    //error_log($session->getPantry());



    $base = new ProductBase($session->getPantry());
    $raw = $base->selectAllProducts();

}else{
    header('Location: index.php');
}
//$base = new ProductBase($_POST['PANTRY_ID']);
//$raw = $base->selectAllProducts();


?>


<div class="header">
    W spiżarni <span id="id_pantry"><?php echo $session->getPantry() ?></span> <i><?php echo $_POST['PANTRY_NAME'] ?></i> znajdują się aktualnie:
</div>
<div class="table">
<table>

    <tr>
    <th>Nazwa</th>
        <th>Data ważności</th>
        <th>Ilość</th>
        <th>Miara</th>
        <th>Kategoria</th>
        </tr>
    <tr>

<?php
        foreach($raw as $row){


echo"<tr>";

        echo"<td>".$row['name']."</td>";
        echo"<td>".$row['datayt']."</td>";
        echo"<td>".$row['amount']."</td>";
        echo"<td>".$row['measure']."</td>";
        echo"<td>".$row['category_name']."</td>";
            echo"</tr>";
        }?>
    </tr>



</table>
</div>


<span id="show">
    DODAJ PRODUKT
</span>


<div id="insert-pop-up">
    <div>
        <span>Nazwa produktu:</span> <input id="name" /><br/><br/>
        <span>Data ważności:</span> <input id="datayt" /><br/><br/>
        <span>Ilość: </span><input id="amount" /><br/><br/>
        <span>Miara: </span><input id="measure" /><br/><br/>
        <span>Kategoria: </span><input id="category_name" /><br/><br/>

        <div id="btn"> OK </div>
    </div>
    <div>

    </div>
</div>

</body>
</html>