<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Tipos de Diagnostico</title>
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
            <h2 class="fw-bold text-center mt-3">Tipos de Diagnostico</h2>
        </span>
    </nav>
    <div class="d-flex justify-content-between align-items-center px-3 my-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-dark">← Inicio</a>
        <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#crearTipoModal">
            + Nuevo Tipo
        </button>
    </div>

    <div class="table-responsive mx-auto p-2" style="max-width:700px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tipos as $t): ?>
                <tr>
                    <td><?= $t->id ?></td>
                    <td><?= $t->nombre ?></td>
                    <td>
                        <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editarTipoModal<?= $t->id ?>">EDITAR</button>
                        <a href="#" onclick="confirmarEliminarTipo(<?= $t->id ?>)" class="btn btn-outline-danger btn-sm">ELIMINAR</a>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarTipoModal<?= $t->id ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?= site_url('hospitalizacion/actualizar_tipo_diagnostico/'.$t->id) ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Tipo de Diagnostico</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control"
                                            value="<?= $t->nombre ?>" required>
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
    <div class="modal fade" id="crearTipoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('hospitalizacion/guardar_tipo_diagnostico') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Tipo de Diagnostico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
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
    function confirmarEliminarTipo(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar este tipo de diagnóstico",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#212529',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('hospitalizacion/eliminar_tipo_diagnostico/') ?>" + id;
            }
        });
    }
    </script>
</body>
</html>
