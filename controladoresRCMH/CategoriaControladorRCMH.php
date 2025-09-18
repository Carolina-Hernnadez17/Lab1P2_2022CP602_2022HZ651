<?php
require_once "daoRCMH/CategoriaDAO_RCMH.php";
require_once "modelosRCMH/CategoriaRCMH.php";

class CategoriaControladorRCMH {
    private $dao;

    public function __construct() {
        $this->dao = new CategoriaDAO_RCMH();
    }

    public function index() {
        $categorias = $this->dao->listar();
        require "vistasRCMH/categoriasRCMH/listarCategoriasRCMH.php";
    }

    public function agregar() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $nombre = $_POST['nombre'] ?? "";
            if($nombre) {
                $categoria = new CategoriaRCMH(null, $nombre);
                $this->dao->agregar($categoria);
                header("Location: ".RUTA."categoria/index");
            } else {
                $error = "El nombre es obligatorio.";
            }
        }
        require "vistasRCMH/categoriasRCMH/agregarCategoriaRCMH.php";
    }

    public function eliminar($id) {
        $this->dao->eliminar($id);
        header("Location: ".RUTA."categoria/index");
    }
}
?>
