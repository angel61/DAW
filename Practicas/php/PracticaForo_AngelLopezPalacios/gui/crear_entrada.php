<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="contenedor">
        <div class="titulo">
            <h1>Nuevo mensaje</h1>
        </div>
        <div class="formulario">
            <form action="index.php" method="POST">
                <div class="fila"> <span>Asunto:</span> <input type="text" name="txtAsunto" required></div>
                <div class="fila"> <span>Mensaje:</span> <textarea name="txtMensaje" cols="30" rows="10" required></textarea></div>
                <div class="botones"><input type="submit"><input type="reset" value="Borrar"></div>
            </form>
        </div>
    </div>
</body>

</html>