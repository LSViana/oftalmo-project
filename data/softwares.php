<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./database.php";
    $collection_software = "software";
    //
    function softwares_read($id) {
        global $collection_software;
        $software = db_read($collection_software, $id);
        return $software;
    }
    //
    function softwares_list() {
        global $collection_software;
        $softwares = db_list($collection_software);
        return $softwares;
    }
?>