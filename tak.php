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
});
Route::add('/rejestracja', function(){
    //echo "strona rejestracji";
    global $twig;
    $twig ->display('register.html.twig');
});
Route::run('/FOlder')
?>