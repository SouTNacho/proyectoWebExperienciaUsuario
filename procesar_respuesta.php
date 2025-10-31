<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$mysqli = conectar_bd();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_publicacion = $_POST['id_publicacion'];
    $id_user = $_POST['id_user'];
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
    $query = "INSERT INTO foro_respuestas (id_publicacion, id_user, contenido, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iiss", $id_publicacion, $id_user, $contenido, $imagen);
    $stmt->execute();

    // Redirigir al foro
    header("Location: foro.php");
    exit();
}
?>