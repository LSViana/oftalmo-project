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
    function laboratories_create($object){
        global $collection_laboratory;
        db_create($collection_laboratory, $object);
    }
    function laboratories_update($id, $object) {
        global $BASE_URL;
        global $collection_laboratory;
        db_update($collection_laboratory, $id, $object);
    }
    function laboratories_delete($id){
        global $collection_laboratory;
        db_delete($collection_laboratory, $id);
    }
    function laboratories_attach_software($laboratoryId, $softwareId) {
        // Recoverying the laboratory
        $laboratory = laboratories_read($laboratoryId);
        // Appending the software
        array_push($laboratory["softwares"], $softwareId);
        // Updating the laboratory
        laboratories_update($laboratoryId, $laboratory);
    }
    function laboratories_unattach_software($laboratoryId, $softwareId) {
        // Recoverying the laboratory
        $laboratory = laboratories_read($laboratoryId);
        // Removing the software
        $freshSoftwares = array_values(array_filter($laboratory["softwares"], function($item) use($softwareId) {
            return $item != $softwareId;
        }));
        $laboratory["softwares"] = $freshSoftwares;
        // Updating the laboratory
        laboratories_update($laboratoryId, $laboratory);
    }
?>