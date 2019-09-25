<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./mysql_database.php";
    require_once __DIR__ . "/" . "./softwares_in_laboratory_repository.php";

    $collection_laboratories = "laboratory";
    //
    class LaboratoriesRepository {
        private $database;
        private $softwaresInLaboratoryRepository;
        
        public function __construct() {
            $this->database = new MySQLDatabase();
            $this->softwaresInLaboratoryRepository = new SoftwaresInLaboratoryRepository();
        }

        public function laboratories_read($id) {
            global $collection_laboratories;
            $laboratory = $this->database->db_read($collection_laboratories, $id);
            $softwaresInLaboratory = $this->softwaresInLaboratoryRepository->softwares_in_laboratory_list_by_laboratory($id);
            $softwaresId = array_map(function($item) { return $item["softwareId"]; }, $softwaresInLaboratory);
            $laboratory["softwares"] = $softwaresId;
            return $laboratory;
        }

        public function laboratories_list() {
            global $collection_laboratories;
            $laboratories = $this->database->db_list($collection_laboratories);
            $index = 0;
            foreach ($laboratories as $laboratory) {
                $softwaresInLaboratory = $this->softwaresInLaboratoryRepository->softwares_in_laboratory_list_by_laboratory($laboratory["id"]);
                $softwaresId = array_map(function($item) { return $item["softwareId"]; }, $softwaresInLaboratory);
                // Verify if the laboratory is updated in the array
                $laboratories[$index]["softwares"] = $softwaresId;
                $index++;
            }
            return $laboratories;
        }

        public function laboratories_create($object) {
            global $collection_laboratories;
            // Creating a default array of zero softwares
            $this->database->db_create($collection_laboratories, $object);
        }

        public function laboratories_update($id, $object) {
            global $collection_laboratories;
            // Removing old softwares
            $softwaresInLaboratory = $this->softwaresInLaboratoryRepository->softwares_in_laboratory_list_by_laboratory($id);
            foreach ($softwaresInLaboratory as $softwareInLaboratory) {
                $this->softwaresInLaboratoryRepository->softwares_in_laboratory_delete($id, $softwareInLaboratory["id"]);
            }
            // Adding new softwares
            $softwareIds = $object["softwares"];
            foreach ($softwareIds as $softwareId) {
                $this->softwaresInLaboratoryRepository->softwares_in_laboratory_create($id, $softwareId);
            }
            unset($object["softwares"]);
            $this->database->db_update($collection_laboratories, $id, $object);
        }

        public function laboratories_delete($id){
            global $collection_laboratories;
            $this->database->db_delete($collection_laboratories, $id);
        }

        public function laboratories_attach_software($laboratoryId, $softwareId) {
            $this->softwaresInLaboratoryRepository->softwares_in_laboratory_create($laboratoryId, $softwareId);
        }

        public function laboratories_unattach_software($laboratoryId, $softwareId) {
            $this->softwaresInLaboratoryRepository->softwares_in_laboratory_delete($laboratoryId, $softwareId);
        }
    }
?>