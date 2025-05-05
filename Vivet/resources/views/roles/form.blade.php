<div>
    <label for="name">Nombre:</label>
    <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" required>
</div>

<div>
    <label for="is_active">Activo:</label>
    <input type="checkbox" name="is_active" {{ old('is_active', $role->is_active ?? false) ? 'checked' : '' }}>
</div>
