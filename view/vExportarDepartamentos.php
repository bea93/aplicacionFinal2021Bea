<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Exportar Departamentos</h2>
<form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" enctype="multipart/form-data">
    <div>
        <label for="Archivo">Tipo archivo:</label><br>
        <select class="campos" name="Archivo" id="Archivo">
            <option value="xml">XML</option>
            <option value="json">JSON</option>
        </select>
        <?php echo isset($errorArchivo) ? '<p style="color: red;">' . $errorArchivo . '</p>' : null; ?>
        <br><br>
    </div>
    <div>
        <button type="submit" name="Exportar">Exportar</button>
        <button type="submit" name="Cancelar">Cancelar</button>
    </div>
</form>