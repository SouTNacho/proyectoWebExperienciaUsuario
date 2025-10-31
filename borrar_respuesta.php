<?php
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_respuesta = $_POST['id_respuesta'];
    $id_publicacion = $_POST['id_publicacion'];

    // Obtiene la conexión a la base de datos
    $mysqli = conectar_bd();

    // Verifica que el usuario actual sea el creador de la respuesta
    $query = "SELECT id_user FROM foro_respuestas WHERE id_respuesta = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id_respuesta);
    $stmt->execute();
    $result = $stmt->get_result();
    $respuesta = $result->fetch_assoc();

    // Verifica si el usuario actual es el creador
    if ($respuesta && isset($_SESSION['usuario_id']) && $respuesta['id_user'] == $_SESSION['usuario_id']) {
        // Elimina la respuesta
        $query_delete = "DELETE FROM foro_respuestas WHERE id_respuesta = ?";
        $stmt_delete = $mysqli->prepare($query_delete);
        $stmt_delete->bind_param("i", $id_respuesta);
        $stmt_delete->execute();
    }

    // Redirigir al foro
    header("Location: foro.php");
    exit();
}
?>