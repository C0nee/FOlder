<?php
class user{
    private int $id;
    private string $login;
    private string $password;
    private string $FirstName;
    private string $LastName;


public function _construct(string $login, string $password){
    $this->login = $login;
    $this-> password = $password;
}}
public function register(){
    $passwordhash = password_hash($this->$password, PASSWORD_ARGON2I);
    $q = INSERT INTO user VALUES(null, ?, ?, ?, ?);
    $db = new mysqli('localhost', 'root', "", 'user');
    $pq = $db-> prepare($q);
    $pq -> bind_param('ssss', $this->login,$passwordhash, $this->FirstName, $this->LastName);
    $pq -> execute();
}
?>