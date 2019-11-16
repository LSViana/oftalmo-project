<?php

class ResponseManager
{
    public function returnAsJson(array $data, $status_code = 200)
    {
        header("Content-Type: application/json");
        http_response_code($status_code);
        echo json_encode($data);
    }
}