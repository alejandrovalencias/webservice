<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "demo");

class Conection
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $error;

    public static $inst;

    /**
     * Funcion para usar el patron singleton
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1
     * @return object $inst Conection
     * @access public
     *
     */
    public static function Instance()
    {
        if (self::$inst === null) {
            self::$inst = new Conection;
        }
        return self::$inst;
    }


    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Función para definir cada parámetro de las variables a
     * buscar y les pone el tipo
     *
     * @param $param
     * @param $value
     * @param $type
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return void
     *
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
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
        }
        $this->stmt->bindValue($param, $value, $type);
    }


    /**
     * Función que prepara la ejecución de una consulta
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return void
     *
     */
    public function execute()
    {
//        if(count($arrData) > 0){
//            return $this->stmt->execute($arrData);
//        }
        return $this->stmt->execute();

    }

    /**
     * Función retorna todos los datos en una lista de array
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return array
     *
     */
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Función que retorna solo una fila
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return array
     *
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Función que hace un count de la consulta
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return int
     *
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    /**
     * Función para iniciar transacción
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return object
     *
     */
    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    /**
     * Función para hacer commit en transacción
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return object
     *
     */
    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    /**
     * Función para cancelar transacción
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright alejandrov.net
     * @return object
     *
     */
    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }
}

?>