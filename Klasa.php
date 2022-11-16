<?php
class user {
    private int $id;
    private string $login;
    private string $password;
    private string $FirstName;
    private string $LastName;

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
        $this->FirstName = "";
        $this->LastName = "";
    }

    public function register() : bool {
        $passwordHash = password_hash($this->password, PASSWORD_ARGON2I);
        $q = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
        $db = new mysqli('localhost', 'root', '', 'Form');
        $pq = $db->prepare($q); 
        $pq->bind_param('ssss', $this->login, $passwordHash, 
                                            $this->FirstName, $this->LastName);
        $result = $pq->execute();
        return $result;
    }

    public function login() : bool {
        $q = "SELECT * FROM user WHERE login = ? LIMIT 1";
        $db = new mysqli('localhost', 'root', '', 'Form');
        $pq = $db->prepare($q); 
        $pq->bind_param('s', $this->login);
        $pq->execute();
        $result = $pq->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $passwordHash = $row['password'];
            if(password_verify($this->password, $passwordHash)) {
                $this->id = $row['id'];
                $this->FirstName = $row['FirstName'];
                $this->LastName = $row['LastName'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
?>