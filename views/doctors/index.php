<section class="page-header">
    <div>
        <h1>Médicos</h1>
        <p>Busque por documento, nombres o apellidos.</p>
    </div>
    <a class="button primary" href="<?= e(url('/doctors/create')) ?>">Nuevo Médico</a>
</section>

<form class="search-form" method="get" action="<?= e(url('/doctors')) ?>">
    <label class="sr-only" for="q">Término de búsqueda</label>
    <input id="q" name="q" value="<?= e($term) ?>" placeholder="Licencia o Nombre">
    <button class="button secondary" type="submit">Buscar</button>
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Licencia</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Estado</th>
                <th>Opción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doctors as $doctor): ?>
                <tr>
                    <td><?= e($doctor['license_number']) ?></td>
                    <td><?= e($doctor['first_name'] . ' ' . $doctor['last_name']) ?></td>
                    <td><?= e($doctor['specialty']) ?></td>
                    <td><?= e($doctor['active'] == 1 ? 'Activo' : 'Inactivo') ?></td>
                    <th>
                        <a class="button secondary" href="<?= e(url('/doctors/'. $doctor['id'].'/edit'))?>">Editar</a>
                    </th>
                    <td>
                        <form method="POST" action="<?= e(url('/doctors/' . $doctor['id'] . '/delete')) ?>" style="display:inline;" data-confirm='¿Está seguro de eliminar este médico?'>
                            <?= csrf_field() ?>
                            <button type="submit" class="button danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if ($doctors === []): ?>
                <tr>
                    <td colspan="4">No se encontraron médicos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>