<?php

class BBDD
{
    private const SRV = 'localhost';

    //Usuario de la base de datos
    private const USR = 'root';

    //Clave de la base de datos
    private const PWD = '';

    private const BBDD = 'foro';
    
    private $bbdd;

    public function __construct()
    {
        $this->bbdd = new mysqli();
        try {
            $this->bbdd->connect(self::SRV, self::USR, self::PWD, self::BBDD);
            $this->bbdd->query("SET NAMES 'utf8'");
        } catch (Exception $e) {
            $this->bbdd = null;
            throw new Exception("Error de conexión:" . $e->getMessage());
        }
    }

    public function __destruct()
    {
        if (!$this->bbdd) $this->bbdd->close();
        $this->bbdd = null;
    }

    function nuevoMensaje($usuario,$clave,$asunto, $mensaje)
    {
        $sql = "INSERT INTO `foro`(`Autor`, `Password`, `Titulo`, `Mensaje`, `Fecha`) VALUES (?,?,?,?,concat(CURRENT_DATE, ' ' ,CURRENT_TIME))";
        $stmt = $this->bbdd->prepare($sql);
        $stmt->bind_param('ssss', $usuario, $clave, $asunto, $mensaje);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    function validarUsuario($usuario,$pass)
    {
        $retorno = false;
        $sql = "SELECT ID FROM `foro` WHERE `Autor`='$usuario' AND `Password`='$pass' GROUP BY `Autor` ";
        $result = $this->bbdd->query($sql);
        
        if ($result->num_rows == 1) {
            $retorno=true;
        }
        return $retorno;
    }
}
