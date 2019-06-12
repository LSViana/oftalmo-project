<?php
    require __DIR__ . "/" . "../../infrastructure/constants.php";
    require __DIR__ . "/" . "../../infrastructure/request_data.php";
    require __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require __DIR__ . "/" . "../../data/laboratories.php";
    //
    $isAuthenticated = session_is_authenticated() && session_is_admin();
    if(!$isAuthenticated) {
        http_response_code(401);
        return;   
    }
    if(!$isGet) {
        http_response_code(405);
        return;
    }
    $laboratoryId = $_GET["laboratory_id"] ?? null;
    $softwareId = $_GET["software_id"] ?? null;
    if($laboratoryId == null || $softwareId == null) {
        http_response_code(400);
        return;
    }
    // Recoverying the laboratory
    $laboratory = laboratories_read($laboratoryId);
    // Removing the software
    $freshSoftwares = array_values(array_filter($laboratory["softwares"], function($item) use($softwareId) {
        return $item != $softwareId;
    }));
    $laboratory["softwares"] = $freshSoftwares;
    // Updating the laboratory
    laboratories_update($laboratoryId, $laboratory);
    // Sending back to the laboratory softwares page
    header("Location: ../../pages/laboratory/softwares.php?id=" . $laboratoryId);
?>