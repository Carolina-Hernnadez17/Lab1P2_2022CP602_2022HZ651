<?php
class LibroRCMH {
    public $id;
    public $titulo;
    public $idAutor;
    public $portada;
    public $stock;
    public $disponible;

    public function __construct($id=null, $titulo="", $idAutor=null, $portada="", $stock=1, $disponible=1){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->idAutor = $idAutor;
        $this->portada = $portada;
        $this->stock = $stock;
        $this->disponible = $disponible;
    }
}
?>
