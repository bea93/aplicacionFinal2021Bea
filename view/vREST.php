<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">REST</h2>
<article class="botones">
    <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button class="button" type="submit" name="Volver">Volver</button> 
    </form>
</article>
<div style="width: 50%; float: left;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Rick y Morty</h3>
        <h4>
            <a style="text-decoration: none;" href="https://rickandmortyapi.com/documentation/#rest" target="blank">
                Documentación de la API
            </a>
        </h4>
        <div>
            <?php if(isset($ValoresPersonaje)){ ?>
                <p><span style="font-weight:bold;">Nombre del personaje: </span> <?php echo $nombrePersonajeR ?></p>
                <p><span style="font-weight:bold;">Imagen: </span><br><img src="<?php echo $imagenR; ?>" width="150px"></p>
                <p><span style="font-weight:bold;">Estado del personaje: </span> <?php echo $estadoR ?></p>
                <p><span style="font-weight:bold;">Especie del personaje: </span> <?php echo $especieR ?></p>
                <p><span style="font-weight:bold;">Género del personaje: </span> <?php echo $generoR ?></p>
            <?php } ?>
        </div> 
        <div>
            <?php echo (isset($_REQUEST['numero']) && $ValoresPersonaje == null) ? "<p style='font-weight:bold; color:red;'>No se ha encontrado ningún personaje</p>" : null;?>
            <input type="number" name="numero" min="1" placeholder="Número de personaje" />
            <button class="button" type="submit" name="Aceptar">Aceptar</button>
        </div>
    </form>
</div>
<!--<div style="width: 50%; float: left;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Crítica de libros del New York Times</h3>
        <h4>
            <a style="text-decoration: none;" target="blank"" href="https://developer.nytimes.com/docs/books-product/1/routes/reviews.json/get">
                Documentación de la API
            </a>
        </h4>
        <div>
            <?php if(isset($aLibro)){ ?>
                <p><span style="font-weight:bold;">Título del libro: </span> <?php echo $aLibro['Titulo'] ?></p>
                <p><span style="font-weight:bold;">Resumen: </span> <?php echo $aLibro['Resumen'] ?></p>
                <p><span style="font-weight:bold;">Fecha de publicación: </span> <?php echo $aLibro['Fecha'] ?></p>
                <p><span style="font-weight:bold;">URL con la crítica: </span> <a href="<?php echo $aLibro['URL'] ?>" target="blank"><?php echo $aLibro['URL'] ?></a></p>
            <?php } ?>
        </div>
        <div>
            <?php echo (isset($_REQUEST['autor']) && $aLibro == null) ? "<p style='font-weight:bold; color:red;'>No se ha encontrado ningún libro del autor</p>" : null;?>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" placeholder="Nombre del autor" value="<?php echo $_REQUEST['autor']; ?>">
            <button class="button" type="submit" name="Buscar">Buscar</button>
        </div>
    </form>-->
</div>