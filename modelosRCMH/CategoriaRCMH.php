<?php
class CategoriaRCMH {
    public $id;
    public $nombre;

    public function __construct($id=null, $nombre=""){
        $this->id = $id;
        $this->nombre = $nombre;
    }
}
?>
