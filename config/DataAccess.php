<?php
class DataAccess
{
    private $host;
    private $username;
    private $password;
    private $dbname;

    private $conection;

    public function __construct()
    {
        $this->host = getenv("TZ_HOST");
        $this->username = getenv("TZ_USER");
        $this->password = getenv("TZ_PASSWORD");
        $this->dbname = getenv("TZ_NAME_DATA_BASE");

        $this->conection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conection->connect_error) {
            die('Error de Conexión (' . $this->conection->connect_errno . ') ' . $this->conection->connect_error);
        }
    }

    public function executeQueryGet($queryExecue)
    {
        return $this->conection->query($queryExecue);
    }

    public function closeConection()
    {
        $this->conection->close();
    }
}
?>