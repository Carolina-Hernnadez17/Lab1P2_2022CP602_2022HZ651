<?php
require_once "../daoRCMH/AutorDAO_RCMH.php";
require_once "../modelosRCMH/AutorRCMH.php";

class AutorControladorRCMH {
    private $dao;

    public function __construct(){
        $this->dao = new AutorDAO_RCMH();
    }

    // Getter
    public function getDao(): AutorDAO_RCMH {
        return $this->dao;
    }

    // Setter
    public function setDao(AutorDAO_RCMH $dao){
        $this->dao = $dao;
    }

    // Funciones del controlador
    public function listarRCMH(){
        return $this->dao->listarRCMH();
    }

    public function agregarRCMH($data){
        if(!empty($data['nombre']) && !empty($data['nacionalidad'])){
            $autor = new AutorRCMH(null, $data['nombre'], $data['nacionalidad']);
            return $this->dao->agregarRCMH($autor);
        }
        return false;
    }

    public function obtenerRCMH($id){
        return $this->dao->obtenerRCMH($id);
    }

    public function actualizarRCMH($data){
        if(!empty($data['id_autor']) && !empty($data['nombre']) && !empty($data['nacionalidad'])){
            $autor = new AutorRCMH($data['id_autor'], $data['nombre'], $data['nacionalidad']);
            return $this->dao->actualizarRCMH($autor);
        }
        return false;
    }

    public function eliminarRCMH($id){
        return $this->dao->eliminarRCMH($id);
    }
}
?>
