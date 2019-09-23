<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./mysql_database.php";
    $collection_laboratory = "laboratory";
    //
    class LaboratoriesRepository {
        private $database;
        
        public function __construct() {
            $this->database = new MySQLDatabase();
        }

        public function laboratories_read($id) {
            global $collection_laboratory;
            $laboratory = $this->database->db_read($collection_laboratory, $id);
            if(is_string($laboratory["softwares"])) {
                $laboratory["softwares"] = json_decode($laboratory["softwares"]);
            }
            return $laboratory;
        }

        public function laboratories_list() {
            return [];
            //
            global $collection_laboratory;
            $laboratories = $this->database->db_list($collection_laboratory);
            $index = 0;
            foreach ($laboratories as $laboratory) {
                if(is_string($laboratory["softwares"])) {
                    $laboratory["softwares"] = json_decode($laboratory["softwares"]);
                    $laboratories[$index] = $laboratory;
                }
                $index++;
            }
            return $laboratories;
        }

        public function laboratories_create($object) {
            global $collection_laboratory;
            // Creating a default array of zero softwares
            $object["softwares"] = "[]";
            $this->database->db_create($collection_laboratory, $object);
        }

        public function laboratories_update($id, $object) {
            global $BASE_URL;
            global $collection_laboratory;
            $this->database->db_update($collection_laboratory, $id, $object);
        }

        public function laboratories_delete($id){
            global $collection_laboratory;
            $this->database->db_delete($collection_laboratory, $id);
        }

        public function laboratories_attach_software($laboratoryId, $softwareId) {
            // Recoverying the laboratory
            $laboratory = $this->laboratories_read($laboratoryId);
            // Appending the software
            array_push($laboratory["softwares"], $softwareId);
            // Updating the laboratory
            $this->laboratories_update($laboratoryId, $laboratory);
        }

        public function laboratories_unattach_software($laboratoryId, $softwareId) {
            // Recoverying the laboratory
            $laboratory = $this->laboratories_read($laboratoryId);
            // Removing the software
            $freshSoftwares = array_values(array_filter($laboratory["softwares"], function($item) use($softwareId) {
                return $item != $softwareId;
            }));
            $laboratory["softwares"] = $freshSoftwares;
            // Updating the laboratory
            $this->laboratories_update($laboratoryId, $laboratory);
        }
    }
?>