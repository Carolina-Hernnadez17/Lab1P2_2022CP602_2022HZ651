<?php
require_once "daoRCMH/AutorDAO_RCMH.php";
require_once "modelosRCMH/AutorRCMH.php";

class AutorControladorRCMH {
    private $dao;

    public function __construct() {
        $this->dao = new AutorDAO_RCMH();
    }

    public function index() {
        $autores = $this->dao->listar();
        require "vistasRCMH/autoresRCMH/listarAutoresRCMH.php";
    }

    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? "";
            $nacionalidad = $_POST['nacionalidad'] ?? "";

            if ($nombre && $nacionalidad) {
                $autor = new AutorRCMH(null, $nombre, $nacionalidad);
                $this->dao->agregar($autor);
                header("Location: ".RUTA."autor/index");
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }
        require "vistasRCMH/autoresRCMH/agregarAutorRCMH.php";
    }

    public function eliminar($id) {
        $this->dao->eliminar($id);
        header("Location: ".RUTA."autor/index");
    }
}
?>
