<?php
use Steampixel\Route;
require_once('config.php');
require_once('Klasa.php');
Route::add('/', function(){
    echo "strona główna";
});
Route::add('/Klasa', function(){
    //echo "strona logowania";
    global $twig;
    $twig ->display('login.html.twig');
    'post';
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        $user = new user($_REQUEST['login'], $_REQUEST['password']);
        if($user->login()) {
            $v = array(
                'message' => "Zalogowano poprawnie użytkownika: ".$user->getName(),
            );
            $twig->display('research.html.twig', $v);
        } else {
            $twig->display('research.html.twig', 
                            ['message' => "Błędny login lub hasło"]);
        }
    } 
    
});
Route::add('/rejestracja', function(){
    //echo "strona rejestracji";
    global $twig;
    $twig ->display('register.html.twig');
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        require_once('config.php');
        
        $user = new user($_REQUEST['login'], $_REQUEST['password']);
        $user->setFirstName($_REQUEST['firstName']);
        $user->setLastName($_REQUEST['lastName']);
        if($user->register()) {
                $v = array(
                    'message' => "Zalogowano poprawnie użytkownika: ".$user->getName(),
                );
                $twig->display('research.html.twig', $v);
            } else{
                $v = array(
                    'message' => 'błąd'
                );
            }
    }
    else{
        $twig->display('register.html.twig');
    }
});
Route::run('/FOlder')
?>