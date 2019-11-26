<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./mysql_database.php";

    $collection_softwares_in_laboratory = "SoftwareInLaboratory";
    //
    class SoftwaresInLaboratoryRepository {
        private $database;

        public function __construct() {
            $this->database = new MySQLDatabase();
        }

        public function softwares_in_laboratory_list() {
            global $collection_softwares_in_laboratory;
            $softwaresInLaboratory = $this->database->db_list($collection_softwares_in_laboratory);
            return $softwaresInLaboratory;
        }

        public function softwares_in_laboratory_read($id) {
            global $collection_softwares_in_laboratory;
            $softwaresInLaboratory = $this->database->db_read($collection_softwares_in_laboratory, $id);
            return $softwaresInLaboratory;
        }

        public function softwares_in_laboratory_list_by_laboratory($laboratoryId) {
            global $collection_softwares_in_laboratory;
            $softwaresInLaboratory = $this->database->db_list($collection_softwares_in_laboratory);
            $softwaresInLaboratory = array_filter($softwaresInLaboratory, function ($item) use($laboratoryId) {
               return $item["laboratoryId"] == $laboratoryId;
            });
            return $softwaresInLaboratory;
        }

        public function softwares_in_laboratory_create($laboratoryId, $softwareId) {
            global $collection_softwares_in_laboratory;
            $softwareInLaboratory = [
                "laboratoryId" => $laboratoryId,
                "softwareId" => $softwareId
            ];
            $this->database->db_create($collection_softwares_in_laboratory, $softwareInLaboratory);
        }

        public function softwares_in_laboratory_delete($laboratoryId, $softwareId) {
            global $collection_softwares_in_laboratory;
            $softwaresInLaboratory = $this->database->db_list($collection_softwares_in_laboratory);
            $softwareInLaboratory = array_values(array_filter($softwaresInLaboratory, function($item) use($laboratoryId, $softwareId) {
               return $item["laboratoryId"] == $laboratoryId && $item["softwareId"] == $softwareId;
            }));
            if(sizeof($softwareInLaboratory) > 0) {
                $this->database->db_delete($collection_softwares_in_laboratory, $softwareInLaboratory[0]["id"]);
            }
        }
    }
?>
