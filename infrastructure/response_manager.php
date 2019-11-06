<?php

class ResponseManager
{
    public function returnAsJson(array $data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}