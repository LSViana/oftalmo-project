<?php
    class Laboratory {
        private $id;
        private $name;
        private $computers;
        private $softwares;
    
        public function __construct($id, $name, $computers, $softwares){
            $this->id = $id;
            $this->name = $name;
            $this->computers = $computers;
            $this->softwares = $softwares;
        }
        
        public function getName()
        {
            return $this->name;
        }
        
        public function setName($name)
        {
            $this->name = $name;
        }
    
        public function getComputers()
        {
            return $this->computers;
        }
    
        public function setComputers($computers)
        {
            $this->computers = $computers;
    
        }
    
        public function getSoftwares()
        {
            return $this->softwares;
        }
    
        public function setSoftwares($softwares)
        {
            $this->softwares = $softwares;
    
        }
    
        public function getId()
        {
            return $this->id;
        }
    
        public function setId($id)
        {
            $this->id = $id;
        }
    }
?>