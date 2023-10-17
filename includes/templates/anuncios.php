<?php
    use App\Propiedad;

    $propiedades;

    if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
        $propiedades = Propiedad::all();
    }else{
        $propiedades = Propiedad::some(3);
    }
?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) :  ?>
    <div class="anuncio">
        <picture>
            <!-- <source srcset="build/img/anuncio1.webp" type="image/webp">
            <source srcset="build/img/anuncio1.jpg" type="image/jpp"> -->
            <img loading="lazy" width="200" height="300" src="imagenes/<?php echo $propiedad->imagen ?>" alt="Anuncio">
        </picture>

        <div class="contenido-anuncio">
            <h3> <?php echo $propiedad->titulo;  ?></h3>
            <p>
                <?php echo $propiedad->descripcion; ?>
            </p>
            <p class="precio"><?php echo "$" . number_format($propiedad->precio, 2, ',', '.'); ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p> <?php echo $propiedad->wc; ?> </p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento" loading="lazy">
                    <p>  <?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                    <p> <?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo">
                Ver Propiedad
            </a>
        </div> <!-- .contenido-anuncio-->
    </div> <!-- .anuncio-->
    <?php endforeach; ?>
</div> <!-- .contenedor-anuncios-->

