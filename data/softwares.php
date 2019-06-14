<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./database.php";
    require_once __DIR__ . "/" . "./laboratories.php";
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
    //
    function softwares_delete($id) {
        global $collection_software;
        // Remove this software from all laboratories
        $laboratories = db_list("laboratory");
        foreach($laboratories as $laboratory) {
            laboratories_unattach_software($laboratory["id"], $id);
        }
        db_delete($collection_software, $id);
    }
    //
    function softwares_create($object) {
        global $collection_software;
        db_create($collection_software, $object);
    }
    //
    function softwares_update($id, $object) {
        global $BASE_URL;
        global $collection_software;
        db_update($collection_software, $id, $object);
    }
?>