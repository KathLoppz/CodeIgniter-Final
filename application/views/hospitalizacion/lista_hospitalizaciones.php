<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Hospitalizaciones</title>
</head>
<style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-custom {
            background-color: #1a3c5e;
        }
</style>
<body>
    <nav class="navbar navbar-dark navbar-custom px-4 py-3">
        <span class="navbar-brand fw-bold text-center">
            <h2 class="fw-bold text-center mt-3">Lista de Hospitalizaciones</h2>
        </span>
    </nav>
    <div class="d-flex justify-content-between align-items-center px-3 my-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-dark">← Inicio</a>
        <button class="btn btn-outline-dark me-md-2" data-bs-toggle="modal" data-bs-target="#crearHospModal">
            + Nueva Hospitalizacion
        </button>
    </div>

    <div class="table-responsive mx-auto p-2" style="max-width:1200px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Fecha Ingreso</th>
                    <th>Fecha Alta</th>
                    <th>Sala</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hospitalizaciones as $h): ?>
                <tr>
                    <td><?= $h->id ?></td>
                    <td><?= $h->nombre ?> <?= $h->apellido ?></td>
                    <td><?= $h->fecha_ingreso ?></td>
                    <td><?= $h->fecha_alta ? $h->fecha_alta : '—' ?></td>
                    <td><?= $h->sala ?></td>
                    <td>
                        <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editarHospModal<?= $h->id ?>">EDITAR</button>
                        <a href="#" onclick="confirmarEliminarHosp(<?= $h->id ?>)" class="btn btn-outline-danger btn-sm">ELIMINAR</a>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarHospModal<?= $h->id ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?= site_url('hospitalizacion/actualizar_hospitalizacion/'.$h->id) ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Hospitalización</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Paciente</label>
                                        <select name="paciente_id" class="form-select" required>
                                            <?php foreach ($pacientes as $p): ?>
                                                <option value="<?= $p->id ?>"
                                                    <?= $p->id == $h->paciente_id ? 'selected' : '' ?>>
                                                    <?= $p->nombre ?> <?= $p->apellido ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fecha de Ingreso</label>
                                        <input type="date" name="fecha_ingreso" class="form-control"
                                            value="<?= $h->fecha_ingreso ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fecha de Alta <small class="text-muted">(opcional)</small></label>
                                        <input type="date" name="fecha_alta" class="form-control"
                                            value="<?= $h->fecha_alta ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sala</label>
                                        <select name="sala_id" class="form-select" required>
                                            <?php foreach ($salas as $s): ?>
                                                <option value="<?= $s->id ?>"
                                                    <?= $s->id == $h->sala_id ? 'selected' : '' ?>>
                                                    <?= $s->nombre ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-dark">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="crearHospModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('hospitalizacion/guardar_hospitalizacion') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Hospitalizacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Paciente</label>
                            <select name="paciente_id" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($pacientes as $p): ?>
                                    <option value="<?= $p->id ?>">
                                        <?= $p->nombre ?> <?= $p->apellido ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Alta <small class="text-muted">(opcional)</small></label>
                            <input type="date" name="fecha_alta" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sala</label>
                            <select name="sala_id" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($salas as $s): ?>
                                    <option value="<?= $s->id ?>"><?= $s->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function confirmarEliminarHosp(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar esta hospitalización",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#212529',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('hospitalizacion/eliminar_hospitalizacion/') ?>" + id;
            }
        });
    }
    </script>
</body>
</html>
