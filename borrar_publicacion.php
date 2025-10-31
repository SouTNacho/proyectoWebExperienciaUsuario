<?php
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_publicacion = $_POST['id_publicacion'];

    // Obtiene la conexión a la base de datos
    $mysqli = conectar_bd();

    // Verifica que el usuario actual sea el creador de la publicación
    $query = "SELECT id_user FROM foro_publicaciones WHERE id_publicacion = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id_publicacion);
    $stmt->execute();
    $result = $stmt->get_result();
    $publicacion = $result->fetch_assoc();

    // Verifica si el usuario actual es el creador
    if ($publicacion && isset($_SESSION['usuario_id']) && $publicacion['id_user'] == $_SESSION['usuario_id']) {
        // Elimina la publicación
        $query_delete = "DELETE FROM foro_publicaciones WHERE id_publicacion = ?";
        $stmt_delete = $mysqli->prepare($query_delete);
        $stmt_delete->bind_param("i", $id_publicacion);
        $stmt_delete->execute();
    }

    // Redirigir al foro
    header("Location: foro.php");
    exit();
}
?>