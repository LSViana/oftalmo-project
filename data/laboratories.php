<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./database.php";
    $collection_laboratory = "laboratory";
    //
    function laboratories_read($id) {
        global $collection_laboratory;
        $laboratory = db_read($collection_laboratory, $id);
        return $laboratory;
    }
    //
    function laboratories_list() {
        global $collection_laboratory;
        $laboratories = db_list($collection_laboratory);
        return $laboratories;
    }
?>