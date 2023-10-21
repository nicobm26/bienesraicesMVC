<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form action="/vendedor/crear" method="post" class="formulario" enctype="multipart/form-data">
        <?php require_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton-verde">
    </form>
</main>