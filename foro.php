<?php
include 'conexion.php';
session_start();

$mysqli = conectar_bd();

// Consulta publicaciones
$query = "
    SELECT 
        fp.id_publicacion, 
        fp.titulo, 
        fp.contenido, 
        fp.imagen, 
        fp.fecha_publicacion,
        fp.id_user,
        u.nombre AS autor
    FROM foro_publicaciones fp
    JOIN usuarios u ON fp.id_user = u.id
    ORDER BY fp.fecha_publicacion DESC";

$result = $mysqli->query($query);

// Obtener el ID del usuario actual
$id_user_actual = null;
if (isset($_SESSION['usuario_id'])) {
    $id_user_actual = $_SESSION['usuario_id'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro - BC</title>
    <link rel="stylesheet" href="./css/foroestilo.css">
    <link rel="shortcut icon" href="./SRC/favico.webp" type="image/x-icon">
</head>
<body class="foroprinci">
    <header>
        <div class="heder-conter">
            <div class="btn-regreso-conter">
                <a href="index.php" class="btn-regresar">Inicio</a>
            </div>
            <img class="logoimg" src="SRC/logo.png" alt="">
        </div>
    </header>
    <div class="seccionforodiv">
        <h1 class="seccionforotitle">FORO BLUE COST</h1>
    </div>
    <nav>
        <a href="crear_publicacion_foro.php" class="btn-crear">Crear Publicación</a>
    </nav>

    <div class="publicaciones-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="publicacion">
                <div class="contenido-publicacion">
                    <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($row['contenido']); ?></p>
                    <?php if ($row['imagen']): ?>
                        <img class="imgforopubli" src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen de la publicación">
                    <?php endif; ?>
                </div>
                <small class="fecha">Publicado el: <?php echo $row['fecha_publicacion']; ?></small> 
                <br>
                <small class="autor">Autor: <?php echo htmlspecialchars($row['autor']); ?></small>
            
                <?php if ($id_user_actual == $row['id_user']): ?>
                    <form action="borrar_publicacion.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta publicación?');">
                        <input type="hidden" name="id_publicacion" value="<?php echo $row['id_publicacion']; ?>">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                <?php endif; ?>
                
                <!-- Sección de respuestas -->
                <div class="respuestas-container">
                    <h4>Respuestas:</h4>
                    
                    <?php
                    // Consultar respuestas para esta publicación
                    $query_respuestas = "
                        SELECT 
                            fr.id_respuesta, 
                            fr.contenido, 
                            fr.imagen,
                            fr.id_user, 
                            fr.fecha_respuesta,
                            u.nombre AS autor
                        FROM foro_respuestas fr
                        JOIN usuarios u ON fr.id_user = u.id
                        WHERE fr.id_publicacion = ?
                        ORDER BY fr.fecha_respuesta ASC";
                    
                    $stmt_respuestas = $mysqli->prepare($query_respuestas);
                    $stmt_respuestas->bind_param("i", $row['id_publicacion']);
                    $stmt_respuestas->execute();
                    $result_respuestas = $stmt_respuestas->get_result();
                    
                    while ($respuesta = $result_respuestas->fetch_assoc()):
                    ?>
                        <div class="respuesta">
                            <p><?php echo htmlspecialchars($respuesta['contenido']); ?></p>
                            <?php if ($respuesta['imagen']): ?>
                                <img class="imgfororespuesta" src="<?php echo htmlspecialchars($respuesta['imagen']); ?>" alt="Imagen de la respuesta">
                            <?php endif; ?>
                            <small class="fecha abx">Respondido el: <?php echo $respuesta['fecha_respuesta']; ?></small>
                            <br>
                            <small class="autor abx">Por: <?php echo htmlspecialchars($respuesta['autor']); ?></small>
                            
                            <?php if ($id_user_actual == $respuesta['id_user']): ?>
                                <form action="borrar_respuesta.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta respuesta?');">
                                    <input type="hidden" name="id_respuesta" value="<?php echo $respuesta['id_respuesta']; ?>">
                                    <input type="hidden" name="id_publicacion" value="<?php echo $row['id_publicacion']; ?>">
                                    <button type="submit" class="btn-eliminar-respuesta">Eliminar</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                    
                    <!-- Formulario para agregar respuesta -->
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <form action="procesar_respuesta.php" method="POST" class="form-respuesta" enctype="multipart/form-data">
                            <input type="hidden" name="id_publicacion" value="<?php echo $row['id_publicacion']; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $id_user_actual; ?>">
                            
                            <textarea name="contenido" placeholder="Escribe tu respuesta..." required></textarea>
                            
                            <div class="custom-file-upload">
                                <input type="file" name="imagen" id="imagen_<?php echo $row['id_publicacion']; ?>" accept=".png, .jpg, .jpeg">
                                <label for="imagen_<?php echo $row['id_publicacion']; ?>" class="upload-button">Agregar imagen</label>
                            </div>
                            
                            <button type="submit" class="btn-responder">Responder</button>
                        </form>
                    <?php else: ?>
                        <p class="login-required">Inicia sesión para responder</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>