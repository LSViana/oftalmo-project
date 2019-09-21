<?php
    require_once __DIR__ . "/" . "constants.php";
    //
    class RequestData {
        public $method;
        public $isGet;
        public $isPost;

        public function __construct() {
            $this->method = $_SERVER["REQUEST_METHOD"];
            $this->isGet = $this->method == "GET";
            $this->isPost = $this->method == "POST";
        }
    }
?>