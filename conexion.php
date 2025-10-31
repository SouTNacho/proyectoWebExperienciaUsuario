<?php
function conectar_bd() {
    $host = 'localhost';
    $usuario = 'root';
    $clave = '';
    $base_datos = 'bluecost';

    $conn = new mysqli($host, $usuario, $clave, $base_datos);

    if ($conn->connect_error) {
        die('CONEXION FALLIDA: ' . $conn->connect_error);
    }

    return $conn;
}

function obtenerUsuario($conn, $id) {
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>