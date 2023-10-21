<fieldset>

    <legend>Información General</legend>

    <label for="nombre">Nombres</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombres" 
        value="<?php echo s($vendedor->nombre);?>">

    <label for="apellido">Apellido</label>
    <input 
        type="text" 
        id="apellido" 
        name="vendedor[apellido]" 
        placeholder="Apellidos" 
        value="<?php echo s($vendedor->apellido);?>">         
               
</fieldset>

<fieldset>

    <legend>Información Extra</legend>

    <label for="telefono">Telefono</label>
    <input 
        type="tel" 
        id="telefono" 
        name="vendedor[telefono]" 
        placeholder="Telefono" 
        value="<?php echo s($vendedor->telefono);?>">    
        
</fieldset>
