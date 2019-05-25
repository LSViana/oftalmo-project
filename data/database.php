<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./files.php";
    //
    function db_list($name) {
        $items = read_collection($name);
        $notDeletedItems = array_filter($items, function($item) {
            return !isset($item["deleted"]);
        });
        return $notDeletedItems;
    }
    function db_update($name, $id, $object) {
        return update_item_collection($name, $id, $object);
    }
    function db_read($name, $id) {
        return read_item_collection($name, $id);
    }
    function db_exists($name, $id) {
        return exists_item_collection($name, $id);
    }
    function db_delete($name, $id) {
        return delete_item_collection($name, $id);
    }
?>