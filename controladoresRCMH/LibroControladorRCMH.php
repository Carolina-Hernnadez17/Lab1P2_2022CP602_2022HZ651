<?php
require_once "daoRCMH/LibroDAO_RCMH.php";
require_once "daoRCMH/AutorDAO_RCMH.php";
require_once "daoRCMH/CategoriaDAO_RCMH.php";
require_once "modelosRCMH/LibroRCMH.php";

class LibroControladorRCMH {
    private $dao;
    private $daoAutor;
    private $daoCategoria;

    public function __construct() {
        $this->dao = new LibroDAO_RCMH();
        $this->daoAutor = new AutorDAO_RCMH();
        $this->daoCategoria = new CategoriaDAO_RCMH();
    }

    public function index() {
        $libros = $this->dao->listar();
        require "vistasRCMH/librosRCMH/listarLibrosRCMH.php";
    }

    public function agregar() {
        $autores = $this->daoAutor->listar();
        $categorias = $this->daoCategoria->listar();

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $titulo = $_POST['titulo'] ?? "";
            $idAutor = $_POST['idAutor'] ?? "";
            $portada = $_POST['portada'] ?? "";
            $stock = intval($_POST['stock'] ?? 1);

            if ($titulo && $idAutor && $portada) {
                $libro = new LibroRCMH(null, $titulo, $idAutor, $portada, $stock, 1);
                $this->dao->agregar($libro);
                header("Location: ".RUTA."libro/index");
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }
        require "vistasRCMH/librosRCMH/agregarLibroRCMH.php";
    }

    public function comprar($id) {
        $this->dao->comprar($id);
        header("Location: ".RUTA."libro/index");
    }

    public function eliminar($id) {
        $this->dao->eliminar($id);
        header("Location: ".RUTA."libro/index");
    }
}
?>
