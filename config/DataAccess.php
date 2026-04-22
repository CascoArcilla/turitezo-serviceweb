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
            error_log("Error al obtener las credenciales para la base de datos: " . $this->conection->connect_error);
            http_response_code(500);
            echo json_encode(array("error" => "Error al conectar con la base de datos."));
            die();
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