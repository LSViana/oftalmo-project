<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./file_database.php";
    require_once __DIR__ . "/" . "./laboratories_repository.php";
    $collection_software = "software";
    //
    $database = new FileDatabase();
    //
    function softwares_read($id) {
        global $collection_software, $database;
        $software = $database->db_read($collection_software, $id);
        return $software;
    }
    //
    function softwares_list() {
        global $collection_software, $database;
        $softwares = $database->db_list($collection_software);
        return $softwares;
    }
    //
    function softwares_delete($id) {
        global $collection_software, $database;
        // Remove this software from all laboratories
        $laboratories = $database->db_list("laboratory");
        $laboratoriesRepository = new LaboratoriesRepository();
        foreach($laboratories as $laboratory) {
            $laboratoriesRepository->laboratories_unattach_software($laboratory["id"], $id);
        }
        $database->db_delete($collection_software, $id);
    }
    //
    function softwares_create($object) {
        global $collection_software, $database;
        $database->db_create($collection_software, $object);
    }
    //
    function softwares_update($id, $object) {
        global $BASE_URL, $collection_software, $database;
        $database->db_update($collection_software, $id, $object);
    }
?>