<?php
require_once('vendor/autoload.php');

$loader = Twig\Loader\FilesystemLoader("/templates");

$db = new mysqli('localhost', 'root', '', 'form');


?>