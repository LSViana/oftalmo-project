<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "./interfaces/database.php";
    require_once __DIR__ . "/" . "./collection_files.php";
    //
    class FileDatabase implements Database {
        private $collectionFiles;

        public function __construct() {
            $this->collectionFiles = new CollectionFiles();
        }

        public function db_list($name) {
            $items = $this->collectionFiles->read_collection($name);
            $notDeletedItems = array_filter($items, function($item) {
                return !isset($item["deleted"]);
            });
            return $notDeletedItems;
        }
        public function db_update($name, $id, $object) {
            return $this->collectionFiles->update_item_collection($name, $id, $object);
        }
        public function db_read($name, $id) {
            return $this->collectionFiles->read_item_collection($name, $id);
        }
        public function db_exists($name, $id) {
            return $this->collectionFiles->exists_item_collection($name, $id);
        }
        public function db_delete($name, $id) {
            return $this->collectionFiles->delete_item_collection($name, $id);
        }
        public function db_create($name, $object) {
            return $this->collectionFiles->create_item_collection($name, $object);
        }
    }
?>