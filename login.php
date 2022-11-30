<?php
require_once('config.php');

if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    //jeżeli już podano dane do logowania
    
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    if($user->login()) {
        //echo "Zalogowano poprawnie użytkownika: ".$user->getName();
        $v = array(
            'message' => "Zalogowano poprawnie użytkownika: ".$user->getName(),
        );
        $twig->display('message.html.twig', $v);
    } else {
        //echo "Błędny login lub hasło";
        $twig->display('message.html.twig', 
                            ['message' => "Błędny login lub hasło"]);
    }
} else {
    //jeśli jeszcze nie podano danych
    //wyświetl formularz logowania
    $twig->display('login.html.twig');
}
?>   