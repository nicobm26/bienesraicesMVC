<?php
    
    if(!isset($_SESSION))
        session_start();
    // var_dump($_SESSION);

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)){
        $inicio=false;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    <header class="header  <?php echo  $inicio ? 'inicio': ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index.php">
                    <img src="../build/img/logo.svg" alt="Logotipo de bienes raices" class="logo">
                </a>

                <div class="mobile-menu">
                    <img src="../build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img src="../build/img/dark-mode.svg" class="dark-mode-boton" alt="Dark mode boton">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($auth) : ?>
                            <a href="/cerrarSesion.php">Cerrar Sesion</a>
                        <?php endif?>
                    </nav>
                </div> <!-- .derecha-->
            </div> <!-- .barra-->
            <?php
            if($inicio)
                echo "<h1>Venta de casas y departamentos exclusivos de lujo</h1>"
            ?>
        </div>  <!--.contenedor .contenido-header -->
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros.php">Nosotros</a>
                <a href="/anuncios.php">Anuncios</a>
                <a href="/blog.php">Blog</a>
                <a href="/contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyrigth">Toodos los derehos reservados. <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>
</html>