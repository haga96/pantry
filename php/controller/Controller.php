<?php
/**
 *
 *
 */

require_once ("Login.php");
require_once ("Registration.php");
require_once ("SessionManager.php");




if(isset($_POST['action'])){



    if($_POST['action'] == 'LOGIN'){//logowanie
        echo "weszlo do Controller.php";
        $logger = new Login($_POST['mail'], $_POST['password']);
        if($logger->checkUser()){
            echo "<div id='zalogowano'> zalogowano</div>";
            //header('Location: C:\xampp\htdocs\pantry\nextpage.html');
            header('Location: http://localhost/pantry/manager.php');

        }else{

        }
    }

    if($_POST['action'] == 'REGISTER'){//rejestracja

        $register=new Registration($_POST['mail'],$_POST['name'],$_POST['surname'],$_POST['password']);
        if($register->createUser()>0){
            echo "<div id='zajestrowany'>Rejestracja zakończona sukscesem.</div>";
        }else{
            echo "<div id='niezajestrowany'>Użytkownik o podanych danych istnieje już w bazie. Podaj inne dane.</div>";
            header('Location:C:\xampp\htdocs\pantry\index.php');

        }
    }

}
