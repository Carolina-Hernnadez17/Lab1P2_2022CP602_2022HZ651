<?php
require_once "modelosDAO/CategoriaDAO.php";

class CategoriaController {
    private $dao;

    public function __construct() {
        $this->dao = new CategoriaDAO();
    }

    public function index() {
        $categorias = $this->dao->getAll();
        require_once "vistas/categorias/index.php";
    }

    public function add() {
        $error = "";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nombre = trim($_POST['nombre']);
            if(empty($nombre)){
                $error = "El nombre de la categoría es obligatorio";
            } else {
                $categoria = new Categoria(null, $nombre);
                if($this->dao->add($categoria)){
                    header("Location: ".RUTA."categoria");
                    exit;
                } else {
                    $error = "Error al agregar la categoría";
                }
            }
        }
        require_once "vistas/categorias/add.php";
    }

    public function edit($id) {
        $categoria = $this->dao->getById($id);
        if(!$categoria){
            header("Location: ".RUTA."categoria");
            exit;
        }

        $error = "";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nombre = trim($_POST['nombre']);
            if(empty($nombre)){
                $error = "El nombre de la categoría es obligatorio";
            } else {
                $categoria->setNombre($nombre);
                if($this->dao->update($categoria)){
                    header("Location: ".RUTA."categoria");
                    exit;
                } else {
                    $error = "Error al actualizar la categoría";
                }
            }
        }

        require_once "vistas/categorias/edit.php";
    }

    public function delete($id) {
        $this->dao->delete($id);
        header("Location: ".RUTA."categoria");
        exit;
    }
}
?>
