<?php
class AutorRCMH {
    public $id_autor;
    public $nombre;
    public $nacionalidad;

    public function __construct($id_autor=null, $nombre=null, $nacionalidad=null){
        $this->id_autor = $id_autor;
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
    }
}
?>
