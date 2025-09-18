<?php
class LibroRCMH {
    public $id_libro;
    public $titulo;
    public $id_autor;
    public $portada;
    public $stock;
    public $disponible;

    public function __construct($id_libro=null, $titulo=null, $id_autor=null, $portada=null, $stock=1, $disponible=1){
        $this->id_libro = $id_libro;
        $this->titulo = $titulo;
        $this->id_autor = $id_autor;
        $this->portada = $portada;
        $this->stock = $stock;
        $this->disponible = $disponible;
    }
}
?>
