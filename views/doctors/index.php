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
    <?php if ($term !== ''): ?>
        <a class="button secondary" href="<?= e(url('/doctors')) ?>">Limpiar</a>
    <?php endif; ?>
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

<?php if ($total > 0): ?>
    <?php
        $pageUrl = static function (int $target) use ($term): string {
            $query = ['page' => $target];
            if ($term !== '') {
                $query['q'] = $term;
            }
            return url('/doctors') . '?' . http_build_query($query);
        };

        $window = 2;
        $start = max(1, $page - $window);
        $end = min($totalPages, $page + $window);
    ?>
    <nav class="pagination" aria-label="Paginación de médicos">
        <?php if ($page > 1): ?>
            <a class="button secondary" href="<?= e($pageUrl($page - 1)) ?>" rel="prev">Anterior</a>
        <?php else: ?>
            <span class="button secondary is-disabled" aria-disabled="true">Anterior</span>
        <?php endif; ?>

        <span class="pagination-pages">
            <?php if ($start > 1): ?>
                <a class="page-link" href="<?= e($pageUrl(1)) ?>">1</a>
                <?php if ($start > 2): ?><span class="page-ellipsis">…</span><?php endif; ?>
            <?php endif; ?>

            <?php for ($i = $start; $i <= $end; $i++): ?>
                <?php if ($i === $page): ?>
                    <span class="page-link is-current" aria-current="page"><?= e($i) ?></span>
                <?php else: ?>
                    <a class="page-link" href="<?= e($pageUrl($i)) ?>"><?= e($i) ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($end < $totalPages): ?>
                <?php if ($end < $totalPages - 1): ?><span class="page-ellipsis">…</span><?php endif; ?>
                <a class="page-link" href="<?= e($pageUrl($totalPages)) ?>"><?= e($totalPages) ?></a>
            <?php endif; ?>
        </span>

        <?php if ($page < $totalPages): ?>
            <a class="button secondary" href="<?= e($pageUrl($page + 1)) ?>" rel="next">Siguiente</a>
        <?php else: ?>
            <span class="button secondary is-disabled" aria-disabled="true">Siguiente</span>
        <?php endif; ?>

        <span class="pagination-info">
            Página <?= e($page) ?> de <?= e($totalPages) ?> · <?= e($total) ?> pacientes
        </span>
    </nav>
<?php endif; ?>