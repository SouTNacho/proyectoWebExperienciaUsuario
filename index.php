<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLUE COST - Inicio</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./SRC/favico.webp" type="image/x-icon">
</head>
<body>
    <div class="grid-general-conter">
        <div class="item1">
            <div class="header-conter">
                <div class="button-logout-conter">
                    <a href="logout.php" class="heder-logout-button" id="bottonCerrarSesion">LOGOUT</a>
                </div>
                <div class="header-image-conter">
                    <center><img class="header-image" src="./SRC/logo.png" alt=""></center>
                </div>
                <div class="header-link-conter">
                    <button class="header-button"><a class="header-button-link" href="index.php">INICIO</a></button>
                    <button class="header-button"><a class="header-button-link" href="cooler.html">COOLER</a></button>
                    <button class="header-button"><a class="header-button-link" href="litio.html">LITIO</a></button>
                    <button class="header-button"><a class="header-button-link" href="hidrogeno.html">GH2</a></button>
                    <button class="header-button anim-header-button-link"><a class="header-button-link" href="register.php">SING UP</a></button>
                    <button class="header-button"><a class="header-button-link" href="login.php">JOIN</a></button>
                    <button class="header-button"><a class="header-button-link" href="foroPrincipal.php">FORUM</a></button>
                </div>
                <h2 class="bUsuario">Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
            </div>
        </div>
        <div class="item2">
            <div class="main-conter">
                <div class="target-conter">
                    <div class="target-title">
                        <h2>title</h2>
                    </div>
                    <div class="target-content">
                        <p class="target-txt">
                            Con este sitio web se busca desarrollar una comprensión más profunda sobre el impacto ambiental que generan diversas actividades humanas en el agua dulce, un recurso limitado y esencial para la vida.La contaminación y el uso excesivo de este recurso no son fenómenos nuevos, pero en la actualidad están tomando nuevas formas a través de industrias tecnológicas emergentes y procesos industriales modernos.
                        </p>
                    </div>
                </div>
                <div class="target-conter">
                    <div class="target-title">
                        <h2>title</h2>
                    </div>
                    <div class="target-content">
                        <p class="target-txt">
                            En particular, este sitio se enfocará en analizar cómo ciertas prácticas actuales como el uso intensivo de agua para la refrigeración de sistemas de inteligencia artificial y centros de datos, la extracción masiva de litio para baterías, y los procesos industriales implicados en la producción de hidrógeno verde están afectando la disponibilidad de agua dulce a nivel global.
                        </p>
                    </div>
                </div>
                <div class="target-conter">
                    <div class="target-title">
                        <h2>title</h2>
                    </div>
                    <div class="target-content">
                        <p class="target-txt">
                            Cabe destacar que, aunque el planeta está cubierto en su mayoría por agua, solamente el 2.5% de ella es dulce. De ese pequeño porcentaje, apenas un 1% es accesible para el consumo humano, ya que el resto se encuentra en glaciares, capas de hielo o en zonas subterráneas de difícil acceso.
                        </p>
                    </div>
                </div>
                <div class="target-conter">
                    <div class="target-title">
                        <h2>title</h2>
                    </div>
                    <div class="target-content">
                        <p class="target-txt">
                            Ante esta realidad, resulta urgente concientizar a la población sobre el uso responsable de tecnologías que, aunque ofrecen grandes avances, también imponen un costo ambiental significativo. El uso de inteligencia artificial, por ejemplo, se ha disparado en los últimos años, y con ello también ha aumentado su huella hídrica, convirtiéndose en una de las actividades más demandantes de agua.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="item3">
            <div class="footer-conter">
                <div class="footer-image">
                    <img src="./SRC/logo.png" alt="" class="img-footer">
                </div>
                <div class="footer-socialmedia">
                    <a href="https://www.facebook.com/profile.php?id=61583027223674" target="_blank"><img src="./SRC/ficon.png" alt="" class="sc-image"></a>
                    <a href="https://www.instagram.com/_bluecost_/" target="_blank"><img src="./SRC/insta.png" alt="" class="sc-image"></a>
                    <a href="https://x.com/_BlueCost" target="_blank"><img src="./SRC/twiit.png" alt="" class="sc-image"></a>
                </div>
                <div class="footer-link">
                    <div class="flink-conter">
                        <div class="flink-container"><a href="terms.html" class="flink" target="_blank">TERMS</a></div>
                        <div class="flink-container"><a href="cooler.html" class="flink">COOLER</a></div>
                        <div class="flink-container"><a href="litio.html" class="flink">LITIO</a></div>
                        <div class="flink-container"><a href="hidrogeno.html" class="flink">CLEAN GH2</a></div>
                        <div class="flink-container"><a href="login.php" class="flink">INICIO</a></div>
                        <div class="flink-container"><a href="foroPrincipal.php" class="flink">FORUM</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const isLogged = <?php echo isset($_SESSION['nombre']) ? 'true' : 'false'; ?>;
    const bottonCerrar = document.getElementById("bottonCerrarSesion");
    if(!isLogged) {
        bottonCerrar.style.display="none";
    }
</script>
</body>
</html>