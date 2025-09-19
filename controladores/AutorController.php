<?php
require_once "modelosDAO/AutorDAO.php";

class AutorController {
    private $dao;

    public function __construct() {
        $this->dao = new AutorDAO();
    }

    // Mostrar todos los autores
    public function index() {
        $autores = $this->dao->getAll(); // aquí obtenemos todos los autores
        require_once "vistas/autores/index.php"; // pasamos la variable a la vista
    }

    public function add() {
        $error = "";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nombre = $_POST['nombre'];
            $nacionalidad = $_POST['nacionalidad'];

            if(empty($nombre) || empty($nacionalidad)){
                $error = "Todos los campos son obligatorios";
            } else {
                $autor = new Autor(null, $nombre, $nacionalidad);
                if($this->dao->add($autor)){
                    header("Location: ".RUTA."autor");
                    exit;
                } else {
                    $error = "Error al agregar el autor";
                }
            }
        }
        require_once "vistas/autores/add.php";
    }

    public function edit($id) {
        $error = "";
        $autor = $this->dao->getById($id);
        if(!$autor){
            header("Location: ".RUTA."autor");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nombre = $_POST['nombre'];
            $nacionalidad = $_POST['nacionalidad'];

            if(empty($nombre) || empty($nacionalidad)){
                $error = "Todos los campos son obligatorios";
            } else {
                $autor->setNombre($nombre);
                $autor->setNacionalidad($nacionalidad);
                if($this->dao->update($autor)){
                    header("Location: ".RUTA."autor");
                    exit;
                } else {
                    $error = "Error al actualizar el autor";
                }
            }
        }

        require_once "vistas/autores/edit.php";
    }

    public function delete($id) {
        $this->dao->delete($id);
        header("Location: ".RUTA."autor");
        exit;
    }
}
?>
