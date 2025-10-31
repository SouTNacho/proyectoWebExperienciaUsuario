<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtiene la conexión a la base de datos
$mysqli = conectar_bd();

// Obtiene el ID del usuario y su nombre
$id_user = $_SESSION['usuario_id'];
$query = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Publicación</title>
    <link rel="stylesheet" href="./css/foroestilo.css">
    <link rel="shortcut icon" href="./SRC/favico.webp" type="image/x-icon">
</head>
<body class="creapubli">
    <div class="form-container form-crear-publicacion">
        <h2>Crear Publicación</h2>
        <a href="foro.php" class="btn-regresar btn-regresar-comentario">Volver al Foro</a>
        <form action="procesar_publicacion.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <label>Título:</label>
            <input type="text" name="titulo" required>
            <label>Contenido:</label>
            <textarea name="contenido" rows="4" required></textarea>
            
            <label>Imagen (opcional):</label>
            <div class="custom-file-upload">
                <input type="file" name="imagen" id="imagen" accept=".png, .jpg, .jpeg">
                <label for="imagen" class="upload-button">Seleccionar Imagen</label>
            </div>
            
            <button type="submit">Publicar</button>
        </form>
    </div>
</body>
</html>