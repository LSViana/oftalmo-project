public class User {
    private $name;
    private $email;
    private $password;
    private $is_admin;

    public function User($name, $email, $password, $is_admin){
        this->$name = $name;
        this->$email = $email;
        this->$password = $password;
        this->$is_admin = $is_admin;
    }

    public function User(){

    }

    public function setName($name){
        this->$name = $name;

    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    
    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIs_admin()
    {
        return $this->is_admin;
    }

    public function setIs_admin($is_admin)
    {
        $this->is_admin = $is_admin;

    }
}


