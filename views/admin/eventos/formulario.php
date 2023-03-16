<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input 
            class="formulario__input" 
            id="nombre" 
            name="nombre" 
            placeholder="Nombre del Evento" 
            type="text" 
            value="<?php echo $evento->nombre ?? '' ?>"
        >
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripción</label>
        <textarea 
            class="formulario__input" 
            id="descripcion" 
            name="descripcion" 
            placeholder="Descripción del Evento" 
        ><?php echo $evento->descripcion ?? '' ?></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoría</label>
        <select 
            name="categoria_id" 
            id="categoria"
            class="formulario__select"
        >
            <option value="">-- Seleccionar --</option>
            <?php foreach($categorias as $categoria) { ?>
                <option <?php echo ($evento->categoria_id == $categoria->id) ? 'selected' : '' ?> value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="dia">Selecciona el Día</label>
        <div class="formulario__radio">
            <?php foreach($dias as $dia) { ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre ?></label>
                    <input 
                        type="radio" 
                        name="dia" 
                        id="<?php echo strtolower($dia->nombre); ?>" 
                        value="<?php echo $dia->id; ?>"
                        <?php echo $evento->dia_id === $dia->id ? 'checked' : '' ?>
                    >
                </div>
            <?php } ?>
        </div>
        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id ?? '' ?>">
    </div>

    <div id="horas" class="formulario__campo">
        <label for="" class="formulario__label">Seleccionar Hora</label>
        <ul class="horas">
            <?php foreach($horas as $hora) { ?>
                <li data-hora-id="<?php echo $hora->id; ?>" class="horas__hora horas__hora--deshabilitado"><?php echo $hora->hora ?></li>
            <?php } ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id ?? '' ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">Ponentes</label>
        <input 
            class="formulario__input" 
            id="ponentes" 
            placeholder="Buscar Ponente" 
            type="search" 
        >
        <ul id="listado-ponentes" class="listado-ponentes">
        </ul>
        <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">Lugares Disponibles</label>
        <input 
            class="formulario__input" 
            id="disponibles"
            name="disponibles" 
            placeholder="Ej: 20" 
            type="number" 
            min="1"
            value="<?php echo $evento->disponibles ?>"
        >
    </div>
</fieldset>