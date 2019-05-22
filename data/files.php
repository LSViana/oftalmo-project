<?php
    define("COLLECTIONS_FOLDER", "collections");
    define("ITEM_EXTENSION", ".json");
    // Creating collections folder if it doesn't exist
    if(!file_exists(COLLECTIONS_FOLDER)) {
        mkdir(COLLECTIONS_FOLDER);
    }
    // Infrastructure functions
    function ensure_collection_folder($collectionFolder) {
        $folderExists = file_exists($collectionFolder);
        // Create if it doesn't exist
        if(!$folderExists) {
            mkdir($collectionFolder);
        }
    }
    //
    function read_collection($name) {
        $collectionFolder = COLLECTIONS_FOLDER . "/" . $name;
        ensure_collection_folder($collectionFolder);
        // Reading all files inside the folder
        $files = scandir($collectionFolder);
        $results = [];
        // Saving all to the results
        foreach($files as $file) {
            $completeFile = $collectionFolder . "/" . $file;
            if(is_file($completeFile)) {
                // Read as JSON and save to results
                $fileHandler = fopen($completeFile, "r");
                $fileJson = fread($fileHandler, filesize($completeFile));
                fclose($fileHandler);
                // Converting to associative array
                $item = json_decode($fileJson, true);
                // Adding item to results
                array_push($results, $item);
            }
        }
        // Return the results
        return $results;
    }
    //
    function exists_item_collection($name, $id) {
        $collectionFolder = COLLECTIONS_FOLDER . "/" . $name;
        ensure_collection_folder($collectionFolder);
        //
        $files = scandir($collectionFolder);
        $itemExists = array_search($id . ITEM_EXTENSION, $files);
        return $itemExists !== false; // False (as boolean) only if the file isn't found
    }
?>