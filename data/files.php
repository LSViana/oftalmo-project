<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    //
    define("COLLECTIONS_FOLDER", "${ROOT}/collections");
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
                $item["id"] = pathinfo($file, PATHINFO_FILENAME);
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
    //
    function read_item_collection($name, $id) {
        $collectionFolder = COLLECTIONS_FOLDER . "/" . $name;
        ensure_collection_folder($collectionFolder);
        //
        $file = $collectionFolder . "/" . $id . ITEM_EXTENSION;
        if(file_exists($file)) {
            $fileHandler = fopen($file, "r");
            $json = fread($fileHandler, filesize($file));
            fclose($fileHandler);
            //
            $item = json_decode($json, true);
            $item["id"] = pathinfo($file, PATHINFO_FILENAME);
            return $item;
        } else {
            return null;
        }
    }
    //
    function update_item_collection($name, $id, $object) {
        $collectionFolder = COLLECTIONS_FOLDER . "/" . $name;
        ensure_collection_folder($collectionFolder);
        //
        $file = $collectionFolder . "/" . $id . ITEM_EXTENSION;
        if(file_exists($file)) {
            $fileHandler = fopen($file, "w");
            // Removing ID property before saving
            unset($object["id"]);
            //
            $json = json_encode($object);
            fwrite($fileHandler, $json);
            fclose($fileHandler);
            //
            return true;
        } else {
            return null;
        }
    }
    //
    function delete_item_collection($name, $id) {
        $collectionFolder = COLLECTIONS_FOLDER . "/" . $name;
        ensure_collection_folder($collectionFolder);
        //
        $file = $collectionFolder . "/" . $id . ITEM_EXTENSION;
        if(file_exists($file)) {
            unlink($file);
        } else {
            return null;
        }
    }
?>