<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pantry</title>
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="css/ManagerStyle.css" rel="stylesheet" type="text/css">
    <link href="css/IndexStyle.css" rel="stylesheet" type="text/css">

    <script>
        $(document).ready(function () {
            $("#add-pop-up").hide();
            $("#show").click(function(){
                $("#add-pop-up").fadeToggle();
            });

            $("#btn").click(function(){
                console.log($("#name").val());
                $.ajax({
                    url: "php/controller/PantryController.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        action: 1,
                        //nazwa_klucza: pobrane dane z inputa: $("#id-inputa").val(), np:
                        name: $("#name").val()
                    }
                }).done(function (data) {
                    alert(data);

                });
                $("#add-pop-up").fadeOut();
            });


        })


    </script>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




<body>

<div class="welcome">

    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    require_once ("php/database/Connection.php");
    require_once ("php/controller/SessionManager.php");
    function getUser(){

        $con = Connection::getInstance();
        $pdo = $con->getPdo();

        $session = new SessionManager();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");

        $user = $session->getUser();
        $stmt->bindParam(1, $user);

        $stmt->execute();
        $raw = $stmt->fetch();
        $name=$raw['name'];
        $surname=$raw['surname'];
        echo "Cześć <span>$name $surname</span>";
    }
    getUser();
    ?>
</div>

<div id="pantries-div">
    <span>twoje spiżarnie czekają:</span>
    <ul>
        <?php
        //require_once ("php/database/Connection.php");
        //require_once ("php/controller/SessionManager.php");
        $con = Connection::getInstance();
        $pdo = $con->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM pantry.pantry
                                        INNER JOIN pantry.user_pantry ON pantry.pantry.id_pantry = pantry.user_pantry.id_pantry
                                        WHERE pantry.user_pantry.id_user = ?");
        $session = new SessionManager();
        error_log('getUser: '.$session->getUser());
        error_log('$_SESSION[\'id_user\']: '.$_SESSION['id_user']);
        $user = $session->getUser();
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $raw = $stmt->fetchAll();
        error_log( print_r($raw, TRUE) );

        foreach ($raw as $row){
            $name = $row['name'];
            $text="<form action='pantry.php' method='post'>";
            $text.="<input type='text' class='list-input' value='".$row['id_pantry']."' name='PANTRY_ID' readonly/>";
            $text.="<input type='submit' class='list-btn' value='".$row['name']."' name='PANTRY_NAME'/>";
            $text.="</form>";
            echo "<li>$text</li>";
        }

        ?>
    </ul>

</div>

<span id="show">
    DODAJ SPIŻARNIĘ
</span>


<div id="add-pop-up">
    <div>
        <span>Nazwa spiżarni:</span> <input id="name" /><br/><br/>

        <div id="btn"> OK </div>
    </div>
    <div>

    </div>
</div>

</body>
</html>