<?php
//Se inicia la sesion
session_start();

//Se incluye la clase que se conecta y maneja la base de datos
include_once("accdat/BBDD.php");

//Si se relleno el formulario de login se valida si la informacion del usuario esta en la base de datos
if(isset($_REQUEST['txtNombre'])&&isset($_REQUEST['txtClave'])){
    $bbdd=new BBDD();
    if($bbdd->validarUsuario($_REQUEST['txtNombre'],$_REQUEST['txtClave'])){
        $_SESSION['nombreUsuario']= $_REQUEST['txtNombre'];
        $_SESSION['nombrePass']= $_REQUEST['txtClave'];
    }
    unset($bbdd);
}

//Si todos los datos necesarios  para enviar el mensaje estan disponibles 
//se guardara un registro en la base de datos  y se le notificara al usuario
if(isset($_REQUEST['txtAsunto'])&&isset($_REQUEST['txtMensaje'])&&isset($_SESSION['nombrePass'])&&isset($_SESSION['nombreUsuario'])){
    $bbdd=new BBDD();
    $bbdd->nuevoMensaje($_SESSION['nombreUsuario'],$_SESSION['nombrePass'],$_REQUEST['txtAsunto'],$_REQUEST['txtMensaje']);
    unset($bbdd);
    echo "Mensaje enviado";
}

//Si ya se inicio sesion con anterioridad se muestra el formulario de enviar mensaje
if(isset($_SESSION['nombreUsuario'])){
    require_once("gui/crear_entrada.php");
}
//Si no esta iniciada la sesion se mostrara el formulario de login
else{
    require_once("gui/login.php");
    if(isset($_REQUEST['txtNombre']))
    echo "Usuario o contraseña no valida";
}
