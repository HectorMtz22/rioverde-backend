<?php

class DB{
    /*
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = "ec2-18-235-97-230.compute-1.amazonaws.com
        ";
        $this->db       = "d4dck2vd3tk5p2";
        $this->user     = "qyhpfpwepyphdk";
        $this->password = "d1ecc916eddb649b154354c390178df665443bdc7693b6408a6586d66ea9fcc3";
        //$this->password = "6#vWHD_$";
        $this->charset  = "utf8";

        //$this->host     = "localhost";
        //$this->db       = "id12963520_abarrotes_rio_verde";
        //$this->user     = "id12963520_hectormtz";
        //$this->password = "abarrotes8161";
        //$this->password = "6#vWHD_$";
        //$this->charset  = "utf8";
    }
    */
    

    //mysql -e "USE todolistdb; select*from todolist" --user=azure --password=6#vWHD_$ --port=49175 --bind-address=52.176.6.0

    function connect(){
    
        try{

            $db = parse_url(getenv("DATABASE_URL"));
            $pdo = new PDO("pgsql:" . sprintf(
                "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                $db["host"],
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
            ));

            //$connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            /* $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]; */
            //$pdo = new PDO($connection, $this->user, $this->password, $options);
            //$pdo = new PDO($connection,$this->user,$this->password);
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}



?>