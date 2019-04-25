<?php
class Conexion
{

    private $Server = '127.0.0.1';
    private $Usuario = 'root';
    private $contra = '';
    private $Namebd = 'seleccionCDS';
    public $conexion;

    public function conexion()
    {
        $con = new mysqli($this->Server, $this->Usuario, $this->contra, $this->Namebd);
        if ($con->connect_error) {
            die("error de conexion" . $con->connect_error);
        }
        return $con;
    }
}
