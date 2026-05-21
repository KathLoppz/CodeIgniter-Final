<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>hospitalizacion</title>
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
            <h2 class="fw-bold ">Lista de pacientes</h2>
        </span>
    </nav>
    <div class="d-flex justify-content-between align-items-center px-3 my-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-dark">← Inicio</a>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearModal">
            + Nuevo Paciente
        </button>
    </div>
    <div class="table-responsive mx-auto p-2" style="max-width:800px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <th  scope="col">ID</th>
                <th  scope="col">Nombre</th>
                <th  scope="col">Apellido</th>
                <th  scope="col">Diagnostico</th>
                <th  scope="col">Acciones</th>
            </thead>
            <tbody >
                <?php foreach ($paciente as $p): ?>
                    <tr>
                        <td><?= $p->id ?></td>
                        <td><?= $p->nombre ?></td>
                        <td><?= $p->apellido ?></td>
                        <td><?= $p->diagnostico ?></td>
                        <td>
                        <a href="<?= site_url('hospitalizacion/editar/'.$p->id) ?>" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editarModal<?= $p->id ?>">EDITAR</a>                        
                        <a href="#" onclick="confirmarEliminar(<?= $p->id ?>)" class="btn btn-outline-danger">ELIMINAR</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editarModal<?= $p->id ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?= site_url('hospitalizacion/actualizar/'.$p->id) ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="<?= $p->nombre ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Apellido</label>
                                        <input type="text" name="apellido" class="form-control" value="<?= $p->apellido ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Diagnostico</label>
                                        <input type="text" name="diagnostico" class="form-control" value="<?= $p->diagnostico ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-dark">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="crearModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('hospitalizacion/guardar') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo paciente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diagnostico</label>
                            <input type="text" name="diagnostico" class="form-control" required>
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
</body>
<script>
function confirmarEliminar(id){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás recuperar este paciente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#212529',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            window.location.href =
            "<?= site_url('hospitalizacion/eliminar/') ?>" + id;
        }
    });
}
</script>
</html>