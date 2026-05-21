<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PacienteForm</title>
</head>
<body>
    <h2><?= isset($paciente)? 'Editar' : 'Nuevo' ?></h2>
    <?php 
        $accion = isset($paciente)
        ? site_url('hospitalizacion/actualizar/'.$paciente['id'])
        : site_url('hospitalizacion/guardar');
    ?>

    <?= form_open($accion) ?>
    <div>
        <label for="">Nombre</label>
        <input type="text" name="nombre"
            value="<?= isset($paciente)? $paciente['nombre']:set_value('nombre')?>"required> <br>

        <label for="">Apellido</label>
        <input type="text" name="apellido"
            value="<?= isset($paciente)? $paciente['apellido']:set_value('apellido')?>"required> <br>

        <label for="">Diagnostico</label>
        <input type="text" name="diagnostico"
            value="<?= isset($paciente)? $paciente['diagnostico']:set_value('diagnostico')?>"required> <br>

        <button type="submit">Guardar</button>
    </div>
    <?= form_close() ?>
</body>
</html>