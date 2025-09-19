<?php
require_once "modelosDAO/LibroDAO.php";
require_once "modelosDAO/AutorDAO.php";
require_once "modelosDAO/CategoriaDAO.php";
require_once "modelosDAO/LibroCategoriaDAO.php";

class LibroController {
    private $dao;
    private $autorDao;
    private $categoriaDao;
    private $lcDao;

    public function __construct() {
        $this->dao = new LibroDAO();
        $this->autorDao = new AutorDAO();
        $this->categoriaDao = new CategoriaDAO();
        $this->lcDao = new LibroCategoriaDAO();
    }

    public function index() {
        $libros = $this->dao->getAll();
        require_once "vistas/libros/index.php";
    }

    public function add() {
        $autores = $this->autorDao->getAll();
        $categorias = $this->categoriaDao->getAll();
        $error = "";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $titulo = $_POST['titulo'];
            $id_autor = $_POST['id_autor'];
            $disponible = 1;

            // Subida de portada
            $portada = null;
            if(isset($_FILES['portada']) && $_FILES['portada']['error'] == 0){
                $nombreArchivo = time()."_".$_FILES['portada']['name'];
                move_uploaded_file($_FILES['portada']['tmp_name'], "uploads/".$nombreArchivo);
                $portada = $nombreArchivo;
            }

            if(empty($titulo) || empty($id_autor)){
                $error = "Título y Autor son obligatorios";
            } else {
                $libro = new Libro(null, $titulo, $id_autor, $portada, $disponible);
                if($this->dao->add($libro)){
                    $id_libro = $this->dao->getAll(); // obtener último libro agregado
                    $id_libro = end($id_libro)->getId();

                    // Guardar categorías
                    if(isset($_POST['categorias'])){
                        foreach($_POST['categorias'] as $c){
                            $this->lcDao->add($id_libro, $c);
                        }
                    }

                    header("Location: ".RUTA."libro");
                    exit;
                } else {
                    $error = "Error al agregar el libro";
                }
            }
        }

        require_once "vistas/libros/add.php";
    }

    public function edit($id) {
        $libro = $this->dao->getById($id);
        if(!$libro) { header("Location: ".RUTA."libro"); exit; }

        $autores = $this->autorDao->getAll();
        $categorias = $this->categoriaDao->getAll();
        $categoriasLib = $this->lcDao->getCategoriasByLibro($id);
        $categoriasLibIds = array_column($categoriasLib, 'id_categoria');

        $error = "";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $titulo = $_POST['titulo'];
            $id_autor = $_POST['id_autor'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            // Subida de portada
            if(isset($_FILES['portada']) && $_FILES['portada']['error'] == 0){
                $nombreArchivo = time()."_".$_FILES['portada']['name'];
                move_uploaded_file($_FILES['portada']['tmp_name'], "uploads/".$nombreArchivo);
                $libro->setPortada($nombreArchivo);
            }

            if(empty($titulo) || empty($id_autor)){
                $error = "Título y Autor son obligatorios";
            } else {
                $libro->setTitulo($titulo);
                $libro->setIdAutor($id_autor);
                $libro->setDisponible($disponible);

                if($this->dao->update($libro)){
                    // actualizar categorías
                    $this->lcDao->deleteByLibro($id);
                    if(isset($_POST['categorias'])){
                        foreach($_POST['categorias'] as $c){
                            $this->lcDao->add($id, $c);
                        }
                    }

                    header("Location: ".RUTA."libro");
                    exit;
                } else {
                    $error = "Error al actualizar el libro";
                }
            }
        }

        require_once "vistas/libros/edit.php";
    }

    public function delete($id) {
        $this->lcDao->deleteByLibro($id);
        $this->dao->delete($id);
        header("Location: ".RUTA."libro");
        exit;
    }
}
?>
