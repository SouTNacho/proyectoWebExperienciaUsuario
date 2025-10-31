<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtiene la conexión a la base de datos
$mysqli = conectar_bd();

// Obtiene el ID de la publicación desde la URL
if (!isset($_GET['id_publicacion'])) {
    header("Location: foro.php");
    exit();
}

$id_publicacion = $_GET['id_publicacion'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Responder Publicación</title>
    <link rel="stylesheet" href="./css/foroestilo.css">
</head>
<body class="crearespuesta">
    <div class="form-container">
        <h2>Responder Publicación</h2>
        <a href="foro.php" class="btn-regresar">Volver al Foro</a>
        
        <form action="procesar_respuesta.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion; ?>">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['usuario_id']; ?>">
            
            <label>Respuesta:</label>
            <textarea name="contenido" rows="4" required placeholder="Escribe tu respuesta..."></textarea>
            
            <label>Imagen (opcional):</label>
            <div class="custom-file-upload">
                <input type="file" name="imagen" id="imagen" accept=".png, .jpg, .jpeg">
                <label for="imagen" class="upload-button">Seleccionar Imagen</label>
            </div>
            
            <button type="submit">Publicar Respuesta</button>
        </form>
    </div>
</body>
</html>