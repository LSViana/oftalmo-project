<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./files.php";
    //
    function db_list($name) {
        return read_collection($name);
    }
    function db_exists($name, $id) {
        return exists_item_collection($name, $id);
    }
?>