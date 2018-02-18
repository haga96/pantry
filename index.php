<?php

//session_start();
//
//if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
//{
////    header('Location: pantry.php');
//    exit();
//}
//
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pantry</title>
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <link href="css/IndexStyle.css" rel="stylesheet" type="text/css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#login").hide();
        $("#log-btn").click(function(){
            $("#register").hide();
            $("#login").fadeToggle();
        });
    })

</script>

<script>
    $(document).ready(function () {
        $("#register").hide();
        $("#reg-btn").click(function(){
            $("#login").hide();
            $("#register").fadeToggle();
        });
    })

</script>

<body>

<div class="header">
    Pantry<br />
    <span>Oszczędź czas i pieniądze dbając o zawartość<br> twojej spizarni z <i>Pantry</i>!</span><br>
    <span class="btn" id="log-btn">Zaloguj</span> <span class="btn" id="reg-btn">Zarejestruj</span>
</div>


<form action="php/controller/Controller.php" method="post" id="login">
    E-mail: <br /> <input type="text" name="mail" /> <br />
    Password: <br /> <input type="password" name="password" /> <br /><br />
    <input type="submit" value="LOGIN" name="action"  />
</form>

<form action="php/controller/Controller.php" method="post" id="register">
    <div class="column">E-mail: <br /> <input required type="email" name="mail" /> <br /></div>
    <div class="column">Name: <br /> <input type="text" name="name" /> <br /></div>
    <div><br/></div>
    <div class="column">Password: <br /> <input type="password" name="password" /> <br /></div>
    <div class="column">Surname: <br /> <input type="text" name="surname" /> <br /></div>

    <input type="submit" value="REGISTER" name="action"/>
</form>

<?php
if(isset($_SESSION['error']))	echo $_SESSION['error'];
?>

</body>
</html>