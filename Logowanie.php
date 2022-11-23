
<?php
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    require_once('config.php');
    require_once('Klasa.php');
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    if($user->login()) {
        $twig ->display('research.html.twig',["Text => błędny login lub hasło"]);
    } else {
        echo "Błędny login lub hasło";
    }
}else{
    $twig ->display('login.html.twig');
}
?>    
