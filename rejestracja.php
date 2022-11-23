<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>
<body>
    <form action="" method="post">
        <label for="loginID">Login:</label><br>
        <input type="text" name="login" id="loginID"><br>
        <label for="passwordID">Hasło:</label><br>
        <input type="password" name="password" id="passwordID"><br>
        <label for="firstNameID">Imię:</label><br>
        <input type="text" name="firstName" id="firstNameID"><br>
        <label for="lastNameID">Nazwisko:</label><br>
        <input type="text" name="lastName" id="lastNameID"><br>
        <input type="submit" value="Rejestruj">
    </form>
<?php
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    require_once('config.php');
    require_once('class/User.class.php');
    $user = new user($_REQUEST['login'], $_REQUEST['password']);
    $user->setFirstName($_REQUEST['firstName']);
    $user->setLastName($_REQUEST['lastName']);
    if($user->register()) {
        echo "Zarejestrowano poprawnie";
    } else {
        echo "Błąd rejestracji użytkownika";
    }
}
?>    
</body>
</html>