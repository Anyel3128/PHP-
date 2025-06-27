<?php
class Conexion {
    private static $instancia = null;
    private $pdo;

    // Constructor privado para evitar múltiples instancias
    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=crud;charset=utf8",
                "root",
                "",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    // Método estático para obtener la única instancia
    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new Conexion();
        }
        return self::$instancia;
    }

    // Método para acceder directamente al PDO
    public function getConexion() {
        return $this->pdo;
    }

    // Método para insertar de forma segura
    public function insertSeguro($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // Método para actualizar de forma segura
    public function updateSeguro($sql, $params) {
        return $this->insertSeguro($sql, $params);
    }

    // Método para hacer consultas con parámetros
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consulta única (por ejemplo: buscar por ID)
    public function queryOne($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
