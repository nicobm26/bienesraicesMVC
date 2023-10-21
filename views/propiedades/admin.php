<main class="contenedor seccion">
    <h1>Administrador</h1>
    <?php
    if($resultado){
        $notificacion = mostrarNotificacion(intval($resultado));
        if ($notificacion) { ?>
            <p class="alerta exito" id="notificacionCrud"><?php echo s($notificacion) ?></p>
            <?php   
        }
    } ?>
    
    <a href="/propiedades/crear" class="boton-verde-inlineBlock">Nueva Propiedad</a>
    <a href="/vendedor/crear" class="boton-amarillo">Nuevo Vendedor</a>
    <h2>Propiedades</h2>
    <table class="propieades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- 4. Mostrar los resultado-->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td> <?php echo $propiedad->id ?> </td>
                    <td> <?php echo $propiedad->titulo ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen ?> " alt="imagen de la casa" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->precio ?></td>
                    <td>
                        <form method="post" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
        <table class="propieades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>  <!-- 4. Mostrar los resultado-->
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td> <?php echo $vendedor->id; ?> </td>
                    <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td> <?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="post" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/vendedor/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

</main>