<?php
    require_once('conf_bd.php');
    class Procesos_bd 
    {
        private $conectar;
        private $resultado;
        function __construct()
        {
            $this->conectar=new mysqli(HOSTNAME,USERNAME,CONTRASENA,NOMBREBD);
        }
        public function cerrar()
        {
            return $this->conectar->close();
        }
        public function consultar($consulta)
        {
            return $this->resultado=$this->conectar->query($consulta);
        }
        public function error()
        {
            //return $this->conectar->errno;
            return $this->conectar->error;
            if($this->conexion->errno=='1062')
                return 'El usuario o el correo ya están registrados';
            if($this->conexion->errno=='1406')
                return 'Superados el maximo de caracteres permitidos';
        }
         public function contarFilas($resultado)
        {
           return $resultado->num_rows;
        }
        public function id_ultima(){
            return $this->conectar->insert_id;
        }
    }

    
?>