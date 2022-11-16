<?php
require_once('Klasa.php');

$user = new User('jkowalski', 'haslo');
echo '<pre>';
var_dump($user);
?>