<?php
use steampixel\Route;
require_once('config.php');
require_once('Klasa.php');
Route::add('/', function({
    echo "strona główna";

}))
Route::run('/FOlder')
?>