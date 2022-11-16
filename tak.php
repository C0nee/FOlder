<?php
require_once(FOlder/user.class.php);

$user = new User('jkowalski', 'haslo');
echo '<pre>';
var_dump($user);
?>