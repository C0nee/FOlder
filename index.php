<?php

use Steampixel\Route;

require_once('config.php');
require_once('Klasa.php');
session_start();
Route::add('/', function() {
    global $twig;
    $v = array();
    if(isset($_SESSION['auth']))
        if($_SESSION['auth']) {
            //jesteśmy zalogowani
            $User = $_SESSION['User'];
            $v['User'] = $User;
            
        }
    $twig->display('home.html.twig', $v);
    //echo "<pre>";
    //var_dump($_SESSION);
});

Route::add('/login', function() { 
    global $twig;
    $twig->display('login.html.twig');
});

Route::add('/login', function() {
    global $twig;
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        $User = new User($_REQUEST['login'], $_REQUEST['password']);
        if($User->login()) {
            $_SESSION['auth'] = true;
            $_SESSION['User'] = $User;
            $v = array(
                'message' => "Zalogowano poprawnie użytkownika: ".$User->getName(),
            );
            $twig->display('message.html.twig', $v);
        } else {
            $twig->display('login.html.twig', 
                                ['message' => "Błędny login lub hasło"]);
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/register', function() {
    global $twig;
    $twig->display('register.html.twig');
});
Route::add('/register', function() {
    global $twig;
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        if(empty($_REQUEST['login']) || empty($_REQUEST['password'])
            || empty($_REQUEST['firstName']) || empty($_REQUEST['lastName'])) {
                //podano pusty string jako jedną z wymaganych wartości
                $twig->display('register.html.twig', 
                                ['message' => "Nie podano wymaganej wartości"]);
                exit();
            }
        $User = new User($_REQUEST['login'], $_REQUEST['password']);
        $User->setFirstName($_REQUEST['firstName']);
        $User->setLastName($_REQUEST['lastName']);
        if($User->register()) {
            //echo "Zarejestrowano poprawnie";
            $twig->display('message.html.twig', 
                                ['message' => "Zarejestrowano poprawnie"]);
        } else {
            //echo "Błąd rejestracji użytkownika";
            $twig->display('register.html.twig', 
                                ['message' => "Błąd rejestracji użytkownika"]);
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');
Route::add('/logout', function() {
    global $twig;
    session_destroy();
    $twig->display('message.html.twig', 
                                ['message' => "Wylogowano poprawnie"]);
});

Route::add('/profile', function() {
    global $twig;
    $User = $_SESSION['User'];
    //pobieramy imię i nazwisko rozdzielone spacją
    $fullName = $User->getName();
    $fullName = explode(" ", $fullName); // "Imię nazwisko" => array ("Imię", "Nazwisko");
    $v = array( 'User'      => $User,
                'firstName' => $fullName[0],
                'lastName'  => $fullName[1],
            );
    $twig->display('profile.html.twig', $v);
});
Route::add('/profile', function() {
    global $twig;
    if(isset($_REQUEST['FirstName']) && isset($_REQUEST['LastName'])) {
        $User = $_SESSION['User'];
        $User->setFirstName($_REQUEST['FirstName']);
        $User->setLastName($_REQUEST['LastName']);
        $User->save();
        $twig->display('message.html.twig', 
                                ['message' => "Zapisano zmiany w profilu"]);
    }
},"post");
 if(isset($_REQUEST['password']) && isset($_REQUEST['passwordRepeat'])) {
    //formularz zmiany hasła
    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['passwordRepeat'];
    if($password == $passwordRepeat) {
        //hasła zgodne
        $user = $_SESSION['user'];
        if($user->changePassword($password)) {
            $twig->display('message.html.twig', 
                ['message' => "Hasło zostało zmienione"]);
        } else {
            $twig->display('message.html.twig', 
                ['message' => "Nastąpił błąd!"]);
        }
    } else {
        //hasła niezgodne
        $twig->display('message.html.twig', 
        ['message' => "Podane hasła nie są zgodne"]);
    }

} 





Route::run('/FOlder');
?>