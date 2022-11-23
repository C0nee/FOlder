
<?php
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    require_once('config.php');
    require_once('class/User.class.php');
    $user = new user($_REQUEST['login'], $_REQUEST['password']);
    $user->setFirstName($_REQUEST['firstName']);
    $user->setLastName($_REQUEST['lastName']);
    if($user->register()) {
            $v = array(
                'message' => "Zalogowano poprawnie użytkownika: ".$user->getName(),
            );
            $twig->display('research.html.twig', $v);
        } else{
            $v = array(
                'message' => 'błąd'
            );
        }
}
else{
    $twig->display('register.html.twig');
}
?>    
</body>
</html>