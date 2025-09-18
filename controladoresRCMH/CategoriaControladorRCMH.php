<?php
require_once "../daoRCMH/CategoriaDAO_RCMH.php";
require_once "../modelosRCMH/CategoriaRCMH.php";

class CategoriaControladorRCMH {
    private $dao;

    public function __construct(){
        $this->dao = new CategoriaDAO_RCMH();
    }

    // Getter
    public function getDao(): CategoriaDAO_RCMH {
        return $this->dao;
    }

    // Setter
    public function setDao(CategoriaDAO_RCMH $dao){
        $this->dao = $dao;
    }

    public function listarRCMH(){
        return $this->dao->listarRCMH();
    }

    public function agregarRCMH($data){
        if(!empty($data['nombre'])){
            $categoria = new CategoriaRCMH(null, $data['nombre']);
            return $this->dao->agregarRCMH($categoria);
        }
        return false;
    }

    public function obtenerRCMH($id){
        return $this->dao->obtenerRCMH($id);
    }

    public function actualizarRCMH($data){
        if(!empty($data['id_categoria']) && !empty($data['nombre'])){
            $categoria = new CategoriaRCMH($data['id_categoria'], $data['nombre']);
            return $this->dao->actualizarRCMH($categoria);
        }
        return false;
    }

    public function eliminarRCMH($id){
        return $this->dao->eliminarRCMH($id);
    }
}
?>
