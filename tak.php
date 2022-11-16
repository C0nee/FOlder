<?php
require_once('Klasa.php');
$user = new user('jkowalski', 'haslo');
$user -> register();

echo '<pre>';
var_dump($user);
?>