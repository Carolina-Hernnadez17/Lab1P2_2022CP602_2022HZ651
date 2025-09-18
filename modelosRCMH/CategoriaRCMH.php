<?php
class CategoriaRCMH {
    public $id_categoria;
    public $nombre;

    public function __construct($id_categoria=null, $nombre=null){
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
    }
}
?>
