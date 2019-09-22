<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./mysql_database.php";
    $collection_user = "user";

class UsersRepository{
    private $database;

    public function __construct()
    {
        $this->database = new MySQLDatabase();
    }

    function users_list() {
        global $collection_user;
        $users = $this->database->db_list($collection_user);
        return $users;
    }
    function users_read($id) {
        global $collection_user;
        $user = $this->database->db_read($collection_user, $id);
        return $user;
    }
    //
    function users_authenticate($email, $password) {
        $users = $this->users_list();
        $authenticatedUsers = array_values(array_filter($users, function($item) use ($email, $password) {
            try {
                if($item["email"] == $email && $item["password"] == $password) {
                    return true;        
                }
            } catch(Exception $err) {
                return false;
            }
        }));
        if(sizeof($authenticatedUsers) > 0) {
            return $authenticatedUsers[0];
        }
        else {
            return null;
        }
    }
}
?>