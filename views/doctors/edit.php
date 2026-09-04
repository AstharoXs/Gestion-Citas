<form class="panel form-grid" method="post" action="<?= e(url('/doctors/' . $data['id'])) ?>" novalidate>
    <?= csrf_field() ?>
    <label for="license_number">Numero de Licencia</label>
    <input id="license_number" name="license_number" value="<?= e($data['license_number'] ?? '') ?>" required>
    <label for="first_name">Nombres</label>
    <input id="first_name" name="first_name" value="<?= e($data['first_name'] ?? '') ?>" required>
    <label for="last_name">Apellidos</label>
    <input id="last_name" name="last_name" value="<?= e($data['last_name'] ?? '') ?>" required>
    <label for="specialty">Especialidad</label>  
    <select id="specialty" name="specialty" required>
        <option value="">Seleccione</option>
        <option value="Medicina General" <?= ($data['specialty'] ?? '') === 'Medicina General' ? 'selected' : '' ?>>Médicina General</option>
        <option value="Cardiologia" <?= ($data['specialty'] ?? '') === 'M' ? 'Cardiologia' : '' ?>>Cardiologia</option>
        <option value="Pediatria" <?= ($data['specialty'] ?? '') === 'O' ? 'Pediatria' : '' ?>>Pediatria</option>
    </select>
    <label for="active">Estado</label>  
    <select id="active" name="active" required>
        <option value="">Seleccione</option>
        <option value="Activo" <?= ($data['active'] ?? '') === 'Medicina General' ? 'selected' : '' ?>>Activo</option>
        <option value="Inactivo" <?= ($data['active'] ?? '') === 'M' ? 'Cardiologia' : '' ?>>Inactivo</option>
    </select>
    <a class="button secondary" href="<?= e(url('/doctors')) ?>">Cancelar</a>
    <button class="button primary" type="submit">Actualizar médico</button>
</form>