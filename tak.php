<?php
require_once('Klasa.php');

$user = new user('jkowalski', 'tajneHasło');
/*
if($user->register()) {
    echo "Zarejestrowano poprawnie";
} else {
    echo "Błąd rejestracji użytkownika";
}
*/

if($user->login()) {
    echo "Zalogowano poprawnie";
} else {
    echo "Błędny login lub hasło";
}

?>