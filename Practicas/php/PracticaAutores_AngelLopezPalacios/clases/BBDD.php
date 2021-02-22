<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'autores';
    private const TBL = 'autores';
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

    public function getAutores($tbl = self::TBL)
    {
        $ret = null;
        $sql = "SELECT id, nombre, apellidos, nacionalidad FROM {$tbl}";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[] = new Autor($row['id'], $row['nombre'], $row['apellidos'], $row['nacionalidad']);
        return $ret;
    }

    public function setAutor($autor, $tbl = self::TBL)
    {
        $ret = null;
        if ($autor instanceof Autor) {
            $sql = "INSERT INTO {$tbl} (nombre,apellidos,nacionalidad) VALUES (
                '{$autor->nombre}',
                '{$autor->apellidos}',
                '{$autor->nacionalidad}'
            )";
            $ret = $this->bbdd->query($sql);
        }
        return $ret;
    }
    public function updateAutor($autor, $tbl = self::TBL)
    {
        $ret = null;
        if ($autor instanceof Autor) {
            $sql = "UPDATE {$tbl} SET 
            nacionalidad='{$autor->nacionalidad}'
            WHERE id={$autor->id}";
            $ret = $this->bbdd->query($sql);
        }
        return $ret;
    }
    public function deleteAutor($autor, $tbl = self::TBL)
    {
        $ret = null;
        if ($autor instanceof Autor) {
            $sql = "DELETE FROM {$tbl} WHERE id = {$autor->id}";
            $ret = $this->bbdd->query($sql);
        }
        return $ret;
    }
}
