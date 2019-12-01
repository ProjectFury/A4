<?php


namespace Rentit;


use PDO;

abstract class Model
{
    /**
     * @var Database
     */
    protected $db;
    /**
     * @var \PDOStatement
     */
    protected $stmt;
    //datos de intercamvio con eñ controlador
    protected $data;

    function __construct()
    {
        //singleton acces to DDBB
        //usamos la clase creada DB para entrar a la BBDD con singleton
        //osea, creamos el usuario
        $this->db = Database::getInstance();
    }
    //creamos nuestras funciones
    //prepara la sentencia
    public function query(string $sql): void
    {
        //el prepare sirve para prepatar la sentencia del PDO, osea, del mysql
        $this->stmt = $this->db->prepare($sql);
    }
    //nos permite ligar los parámetros de PHP con los de la consulta SQL, lo hacemos para evitar atauqes a nuestra BBDD
    //pasamos parametro y valor
    public function bind($param, $value): void
    {
        switch ($value) {
            case is_int($value):
                //PDO --> PHP DATA OBJECT
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //devolvemos la ejecución
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    //recogeremos los datos con el fech_all en unn array asosiativo
    public function resultSet(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //devuelve un único resultado
    public function singleSet()
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //el numero de elementos de la sentencia
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    //devuelve el ID del último elemento insertado
    public function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }
    //ORM - mapeado de objetos relacioles
}