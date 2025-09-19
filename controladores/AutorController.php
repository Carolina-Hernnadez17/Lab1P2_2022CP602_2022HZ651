<?php
require_once "modelosDAO/AutorDAO.php";

class AutorController {
    private $dao;

    public function __construct() {
        $this->dao = new AutorDAO();
    }

    public function index() {
        $autores = $this->dao->getAll();
        require "vistas/autores/index.php";
    }

    public function add() {
        if($_POST) {
            $autor = new Autor(null, $_POST['nombre'], $_POST['nacionalidad']);
            if($this->dao->add($autor)){
                header("Location: ".RUTA."autores");
            } else {
                $error = "Error al guardar el autor";
            }
        }
        require "vistas/autores/add.php";
    }

    public function edit($id) {
        $autor = $this->dao->getById($id);
        if($_POST){
            $autor->setNombre($_POST['nombre']);
            $autor->setNacionalidad($_POST['nacionalidad']);
            if($this->dao->update($autor)){
                header("Location: ".RUTA."autores");
            } else {
                $error = "Error al actualizar el autor";
            }
        }
        require "vistas/autores/edit.php";
    }

    public function delete($id){
        $this->dao->delete($id);
        header("Location: ".RUTA."autores");
    }
}
?>
