<?php
require_once "../daoRCMH/LibroDAO_RCMH.php";
require_once "../modelosRCMH/LibroRCMH.php";

class LibroControladorRCMH {
    private $dao;

    public function __construct(){
        $this->dao = new LibroDAO_RCMH();
    }

    // Getter
    public function getDao(): LibroDAO_RCMH {
        return $this->dao;
    }

    // Setter
    public function setDao(LibroDAO_RCMH $dao){
        $this->dao = $dao;
    }

    public function listarRCMH(){
        return $this->dao->listarRCMH();
    }

    public function agregarRCMH($data){
        if(!empty($data['titulo']) && !empty($data['id_autor'])){
            $stock = isset($data['stock']) ? (int)$data['stock'] : 1;
            $disponible = $stock > 0 ? 1 : 0;
            $libro = new LibroRCMH(null, $data['titulo'], $data['id_autor'], $data['portada'] ?? '', $stock, $disponible);
            return $this->dao->agregarRCMH($libro);
        }
        return false;
    }

    public function obtenerRCMH($id){
        return $this->dao->obtenerRCMH($id);
    }

    public function actualizarRCMH($data){
        if(!empty($data['id_libro']) && !empty($data['titulo']) && !empty($data['id_autor'])){
            $stock = isset($data['stock']) ? (int)$data['stock'] : 1;
            $disponible = isset($data['disponible']) ? (int)$data['disponible'] : ($stock>0 ? 1:0);
            $libro = new LibroRCMH($data['id_libro'], $data['titulo'], $data['id_autor'], $data['portada'] ?? '', $stock, $disponible);
            return $this->dao->actualizarRCMH($libro);
        }
        return false;
    }

    public function eliminarRCMH($id){
        return $this->dao->eliminarRCMH($id);
    }

    public function comprarRCMH($id){
        return $this->dao->comprarRCMH($id);
    }
}
?>
