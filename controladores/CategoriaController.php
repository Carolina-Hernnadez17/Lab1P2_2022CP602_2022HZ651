<?php
require_once "modelosDAO/CategoriaDAO.php";

class CategoriaController {
    private $dao;

    public function __construct() {
        $this->dao = new CategoriaDAO();
    }

    public function index() {
        $categorias = $this->dao->getAll();
        require "vistas/categorias/index.php";
    }

    public function add() {
        if($_POST){
            $cat = new Categoria(null, $_POST['nombre']);
            if($this->dao->add($cat)){
                header("Location: ".RUTA."categorias");
            } else {
                $error = "Error al guardar la categoría";
            }
        }
        require "vistas/categorias/add.php";
    }

    public function edit($id){
        $cat = $this->dao->getById($id);
        if($_POST){
            $cat->setNombre($_POST['nombre']);
            if($this->dao->update($cat)){
                header("Location: ".RUTA."categorias");
            } else {
                $error = "Error al actualizar la categoría";
            }
        }
        require "vistas/categorias/edit.php";
    }

    public function delete($id){
        $this->dao->delete($id);
        header("Location: ".RUTA."categorias");
    }
}
?>
