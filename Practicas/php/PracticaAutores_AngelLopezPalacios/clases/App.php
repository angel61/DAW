<?php


class App
{
    private function printHead()
    {
        include_once("gui/head.html");
    }
    private function printBody()
    {
        include_once("gui/body.php");
    }
    private function printTabla()
    {
        include_once("gui/tabla.php");
    }
    private function printAutores()
    {
        $bbdd = new BBDD();
        $autores=$bbdd->getAutores();
        unset($bbdd);

        foreach($autores as $autor){
            echo "<tr><td>{$autor->id}</td><td>{$autor->nombre}</td><td>{$autor->apellidos}</td><td>{$autor->nacionalidad}</td></tr>";
        }
    }
    private function printFoot()
    {
        include_once("gui/foot.html");
    }

    public function run($p = null)
    {
        $this->printHead();

        $this->printBody();

        $annadir = isset($p["btnAnnadir"]) && strlen($p["nombre"]) > 0 && strlen($p["apellidos"]) > 0 && strlen($p["nacionalidad"]) > 0;
        $mostrar = isset($p["btnMostrar"]);
        $modificar = isset($p["btnModificar"]) && strlen($p["id"]) > 0 && strlen($p["nacionalidad"]) > 0;
        $borrar = isset($p["btnBorrar"]) && strlen($p["id"]) > 0;

        switch (true) {
            case $annadir:
                $aut = new Autor(-1,$p['nombre'], $p['apellidos'], $p['nacionalidad']);
                $bbdd = new BBDD();
                if ($bbdd->setAutor($aut)) echo "<h2>Autor añadido</h2>";
                unset($bbdd);
                break;
            case $mostrar:
                $this->printTabla();
                break;
            case $modificar:
                $aut = new Autor($p['id'], '', '', $p['nacionalidad']);
                $bbdd = new BBDD();
                if ($bbdd->updateAutor($aut)&&$aut->id>-1) echo "<h2>Autor modificado</h2>";
                unset($bbdd);
                break;
            case $borrar:
                $aut = new Autor($p['id']);
                $bbdd = new BBDD();
                if ($bbdd->deleteAutor($aut)&&$aut->id>-1) echo "<h2>Autor eliminado</h2>";
                unset($bbdd);
                break;
        }

        $this->printFoot();
    }
}
