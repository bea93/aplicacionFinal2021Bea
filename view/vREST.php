<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">REST</h2>
<div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Rick y Morty</h3>
        <div>
            <p><span style="font-weight:bold;">Nombre del personaje: </span> <?php echo $nombrePersonajeR ?></p>
            <p><span style="font-weight:bold;">Imagen: </span><br><img src="<?php echo $imagenR; ?>" width="150px"></p>
            <p><span style="font-weight:bold;">Estado del personaje: </span> <?php echo $estadoR ?></p>
            <p><span style="font-weight:bold;">Especie del personaje: </span> <?php echo $especieR ?></p>
            <p><span style="font-weight:bold;">Tipo de personaje: </span> <?php echo $tipoR ?></p>
            <p><span style="font-weight:bold;">Género del personaje: </span> <?php echo $generoR ?></p>   
        </div>
        <input type="number" name="numero" min="1" placeholder="Número de personaje"/><br>
        <div>
            <button class="button" type="submit" name="Aceptar">Aceptar</button>
            <button class="button" type="submit" name="Cancelar">Volver</button> 
        </div>
    </form>
</div>