<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./database.php";
    //
    function users_authenticate($email, $password) {
        $users = db_list("user");
        $authenticatedUsers = array_filter($users, function($item) use ($email, $password) {
            try {
                if($item["email"] == $email && $item["password"] == $password) {
                    return true;        
                }
            } catch(Exception $err) {
                return false;
            }
        });
        if(sizeof($authenticatedUsers) > 0) {
            return $authenticatedUsers[0];
        }
        else {
            return null;
        }
    }
?>