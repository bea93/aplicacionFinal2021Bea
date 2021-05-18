<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Importar Departamentos</h2>
<form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" enctype="multipart/form-data">
    <div>
        <label for="Archivo">Archivo</label><br>
        <input class="campos" type="file" id="Archivo" name="Archivo" value="">
        <?php echo isset($errorArchivo) ? '<p style="color: red;">' . $errorArchivo . '</p>' : null; ?>
        <br>

        <label for="Archivo">Tipo archivo:</label><br>
        <select class="campos" name="Tipo" id="Tipo">
            <option value="xml">XML</option>
            <option value="json">JSON</option>
        </select>
        <br><br>
    </div>
    <div>
        <button type="submit" name="Importar">Importar</button>
        <button type="submit" name="Cancelar">Cancelar</button>
    </div>
</form>