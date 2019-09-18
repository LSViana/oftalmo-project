<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./file_database.php";
    $collection_user = "user";
    //
    $database = new FileDatabase();
    //
    function users_list() {
        global $collection_user, $database;
        $users = $database->db_list($collection_user);
        return $users;
    }
    function users_read($id) {
        global $collection_user, $database;
        $user = $database->db_read($collection_user, $id);
        return $user;
    }
    //
    function users_authenticate($email, $password) {
        $users = users_list();
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
?>