<?php
class LibroCategoria {
    private $id_libro;
    private $id_categoria;
    public function __construct($id_libro = null, $id_categoria = null){
        $this->id_libro = $id_libro;
        $this->id_categoria = $id_categoria;
    }
    public function getIdLibro(){ return $this->id_libro; }
    public function getIdCategoria(){ return $this->id_categoria; }
}
?>
