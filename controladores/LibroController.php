<?php
require_once "modelosDAO/LibroDAO.php";
require_once "modelosDAO/LibroCategoriaDAO.php";
require_once "modelosDAO/AutorDAO.php";
require_once "modelosDAO/CategoriaDAO.php";

class LibroController {
    private $dao;
    private $lcDAO;
    private $autorDAO;
    private $catDAO;

    public function __construct() {
        $this->dao = new LibroDAO();
        $this->lcDAO = new LibroCategoriaDAO();
        $this->autorDAO = new AutorDAO();
        $this->catDAO = new CategoriaDAO();
    }

    public function index() {
        $libros = $this->dao->getAll();
        $autores = $this->autorDAO->getAll();
        $categorias = $this->catDAO->getAll();
        require "vistas/libros/index.php";
    }

    public function add() {
    $autores = $this->autorDAO->getAll();
    $categorias = $this->catDAO->getAll();

    if($_POST){
        $libro = new Libro(null,$_POST['titulo'],$_POST['id_autor'],$_FILES['portada']['name']??null,1);
        $idLibro = $this->dao->add($libro);

        if($idLibro){
            if(!empty($_POST['categorias'])){
                foreach($_POST['categorias'] as $c){
                    $this->lcDAO->add($idLibro,$c);
                }
            }

            if(isset($_FILES['portada']) && $_FILES['portada']['error']==0){
                move_uploaded_file($_FILES['portada']['tmp_name'], "uploads/".$_FILES['portada']['name']);
            }

            header("Location: ".RUTA."libros");
        } else {
            $error = "Error al guardar el libro";
        }
    }

    // Pasar estas variables a la vista
    require "vistas/libros/add.php";
}


    public function edit($id){
        $libro = $this->dao->getById($id);
        $autores = $this->autorDAO->getAll();
        $categorias = $this->catDAO->getAll();
        $catsLibro = array_column($this->lcDAO->getCategoriasByLibro($id),'id_categoria');

        if($_POST){
            $libro->setTitulo($_POST['titulo']);
            $libro->setIdAutor($_POST['id_autor']);
            if(isset($_FILES['portada']) && $_FILES['portada']['error']==0){
                $libro->setPortada($_FILES['portada']['name']);
                move_uploaded_file($_FILES['portada']['tmp_name'], "uploads/".$_FILES['portada']['name']);
            }

            $this->dao->update($libro);

            $this->lcDAO->deleteByLibro($id);

            if(!empty($_POST['categorias'])){
                foreach($_POST['categorias'] as $c){
                    $this->lcDAO->add($id,$c);
                }
            }

            header("Location: ".RUTA."libros");
        }

        require "vistas/libros/edit.php";
    }

    public function delete($id){
        $this->dao->delete($id);
        $this->lcDAO->deleteByLibro($id);
        header("Location: ".RUTA."libros");
    }
}
?>
