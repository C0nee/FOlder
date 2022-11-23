<?php
require_once('config.php');
require_once('Klasa.php');
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
    else {
    $twig->display('login.html.twig');
}
?>   