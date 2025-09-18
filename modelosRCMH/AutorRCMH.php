<?php
class AutorRCMH {
    public $id;
    public $nombre;
    public $nacionalidad;

    public function __construct($id = null, $nombre = "", $nacionalidad = "") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
    }
}
?>
