<?php
class User {
    private int $id;
    private mysqli $db;
    private string $login;
    private string $password;
    private string $FirstName;
    private string $LastName;

    public function __serialize() : array{
        return array(
            'id' =>$this->id,
            'login' =>$this->login,
            'password' =>$this->password,
            'FirstName' =>$this->FirstName,
            'LastName' =>$this->LastName,

        );
    }
    public function __unserialize(array $data) {
        $this->id = $data['id'];
        $this->login = $data['login'];
        $this->password = $data['password'];
        $this->FirstName = $data['FirstName'];
        $this->LastName = $data['LastName'];
        global $db;
        $this->db = &$db;
    } 

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
        $this->FirstName = "";
        $this->LastName = "";
        global $db;
        $this->db = &$db;
    }

    public function register() : bool {
        $passwordHash = password_hash($this->password, PASSWORD_ARGON2I);
        $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
        $preparedQuery = $this->db->prepare($query); 
        $preparedQuery->bind_param('ssss', $this->login, $passwordHash, 
                                            $this->FirstName, $this->LastName);
        $result = $preparedQuery->execute();
        return $result;
    }

    public function login() : bool {
        $query = "SELECT * FROM user WHERE login = ? LIMIT 1";
        $preparedQuery = $this->db->prepare($query); 
        $preparedQuery->bind_param('s', $this->login);
        $preparedQuery->execute();
        $result = $preparedQuery->get_result();
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
    public function setFirstName(string $FirstName) {
        $this->FirstName = $FirstName;
    }
    public function setLastName(string $LastName) {
        $this->LastName = $LastName;
    }
    public function getName() : string {
        return $this->FirstName . " " . $this->LastName;
    }
    public function save() : bool {
        $q = "UPDATE user SET
                firstName = ?,
                lastName = ?
                WHERE id = ?";
        $preparedQuery = $this->db->prepare($q);
        $preparedQuery->bind_param("ssi", $this->firstName, $this->lastName, $this->id);
        return $preparedQuery->execute();
    }
}

?>