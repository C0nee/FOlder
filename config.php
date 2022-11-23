<?php
require_once('vendor/autoload.php');
require_once('Klasa.php');

$user = new user('jkowalski', 'tajneHasło');
$loader = new Twig\Loader\FilesystemLoader("templates");
$twig = new Twig\Environment($loader);
$db = new mysqli('localhost', 'root', '', 'form');


?>