<?php
  require_once __DIR__ . "/" . "./data/mysql_database.php";
  //
  $database = new MySQLDatabase();
  // Create
  $database->db_create("software", [
    "id" => "8BCD8B99-F453-43E2-9C78-0EF31079D150",
    "name" => "Thunderbird",
    "color" => "#3084c8",
    "logo" => "https:\/\/www.thunderbird.net\/media\/img\/thunderbird\/thunderbird-256.png",
    "description" => "Mozilla Thunderbird is a free and open-source, cross-platform email client, news client, RSS, and chat client developed by the Mozilla Foundation. The project strategy was modeled after that of the Mozilla Firefox web browser. It is installed by default on Ubuntu desktop systems."
  ]);
  // List
  $softwares = $database->db_list("software");
  // Exists
  $softwareExists = $database->db_exists("software", "8BCD8B99-F453-43E2-9C78-0EF31079D150");
  // Update
  $database->db_update("software", "8BCD8B99-F453-43E2-9C78-0EF31079D150", [
    "id" => "8BCD8B99-F453-43E2-9C78-0EF31079D150",
    "name" => "Thunderbird!",
    "color" => "#3084c8",
    "logo" => "https:\/\/www.thunderbird.net\/media\/img\/thunderbird\/thunderbird-256.png",
    "description" => "Mozilla Thunderbird is a free and open-source, cross-platform email client, news client, RSS, and chat client developed by the Mozilla Foundation. The project strategy was modeled after that of the Mozilla Firefox web browser. It is installed by default on Ubuntu desktop systems."
  ]);
  $softwares = $database->db_list("software");
  // Read
  $software = $database->db_read("software", "8BCD8B99-F453-43E2-9C78-0EF31079D150");
  // Delete
  $database->db_delete("software", "8BCD8B99-F453-43E2-9C78-0EF31079D150");
  $software = $database->db_read("software", "8BCD8B99-F453-43E2-9C78-0EF31079D150");
  $softwareExists = $database->db_exists("software", "8BCD8B99-F453-43E2-9C78-0EF31079D150");
?>