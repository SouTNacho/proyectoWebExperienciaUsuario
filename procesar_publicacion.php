<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$mysqli = conectar_bd();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagen = null;

    // Subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $file_type = mime_content_type($_FILES['imagen']['tmp_name']);
        // Verifica que el archivo sea PNG o JPG
        if ($file_type == 'image/png' || $file_type == 'image/jpeg') {
            $nombre_unico = uniqid() . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $ruta_imagen = 'uploads/' . $nombre_unico;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
            $imagen = $ruta_imagen;
        } else {
            echo "Error: Solo se permiten archivos PNG o JPG.";
            exit();
        }
    }

    // Prepara y ejecuta la consulta
    $query = "INSERT INTO foro_publicaciones (id_user, titulo, contenido, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("isss", $id_user, $titulo, $contenido, $imagen);
    $stmt->execute();

    // Redirigir al foro
    header("Location: foro.php");
    exit();
}
?>