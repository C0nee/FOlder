<?php
class user{
    private int $id;
    private string $login;
    private string $password;
    private string $FirstName;
    private string $LastName;
}

public function _construct(string $login, string $password){
    $this->login = $login;
    $this-> password = $password;
}
?>