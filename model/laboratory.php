public class Laboratory{
    private $name;
    private $computers;
    private $softwares;

    public function Laboratory($name, $computers, $softwares){
        this->$name = $name;
        this->$computers = $computers;
        this->$softwares = $softwares;
    }


    public function Laboratory() {
        
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
}