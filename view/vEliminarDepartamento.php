<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Eliminar Departamento</h2>
<div>
    <form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
        <div>
            <label for="CodDepartamento">Código de departamento</label><br>
            <input type="text" id="CodDepartamento" name="CodDepartamento" readonly value="<?php echo $codDep; ?>">
            <br>

            <label for="DescDepartamento" >Descripción de departamento</label><br>
            <input type="text" id="DescDepartamento" name="DescDepartamento" readonly value="<?php echo $descDep; ?>">
            <br>

            <label for="FechaCreacion">Fecha de creación</label><br>
            <input type="text" id="FechaCreacion" name="FechaCreacion" readonly value="<?php echo date('d/m/Y', $fechaCreacion); ?>">
            <br>

            <label for="VolumenNegocio">Volumen de negocio</label><br>
            <input type="text" id="VolumenNegocio" name="VolumenNegocio" readonly value="<?php echo  $volumen; ?>">
            <br>
        </div>
        <div>
            <button class="logout" type="submit" name='Aceptar'>Aceptar</button>
            <button class="logout" type="submit" name='Cancelar'>Cancelar</button>
        </div>
    </form>
</div>