<?php
  interface Database {
    public function db_list($name);
    public function db_update($name, $id, $object);
    public function db_read($name, $id);
    public function db_exists($name, $id);
    public function db_delete($name, $id);
    public function db_create($name, $object);
  }
?>