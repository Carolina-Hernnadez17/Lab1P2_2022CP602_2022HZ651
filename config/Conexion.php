<?php
class ConexionRCMH {
    private $host = "localhost";
    private $db = "libros";
    private $usuario = "root"; // tu usuario de MySQL
    private $clave = "";       // tu contraseña de MySQL
    private $conexion;

    public function conectarRCMH(): PDO {
        try {
            $this->conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->usuario,
                $this->clave
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
