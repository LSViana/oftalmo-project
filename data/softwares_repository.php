<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./file_database.php";
    require_once __DIR__ . "/" . "./laboratories_repository.php";
    $collection_software = "software";
    //
    class SoftwaresRepository {
        private $database;

        public function __construct() {
            $this->database = new FileDatabase();
        }
        
        public function softwares_read($id) {
            global $collection_software;
            $software = $this->database->db_read($collection_software, $id);
            return $software;
        }
        
        public function softwares_list() {
            global $collection_software;
            $softwares = $this->database->db_list($collection_software);
            return $softwares;
        }
        
        public function softwares_delete($id) {
            global $collection_software;
            // Remove this software from all laboratories
            $laboratories = $this->database->db_list("laboratory");
            $laboratoriesRepository = new LaboratoriesRepository();
            foreach($laboratories as $laboratory) {
                $laboratoriesRepository->laboratories_unattach_software($laboratory["id"], $id);
            }
            $this->database->db_delete($collection_software, $id);
        }
        
        public function softwares_create($object) {
            global $collection_software;
            $this->database->db_create($collection_software, $object);
        }
        
        public function softwares_update($id, $object) {
            global $BASE_URL, $collection_software;
            $this->database->db_update($collection_software, $id, $object);
        }
    }
?>