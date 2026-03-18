<h1>Nova Manutenção</h1>

<form method="POST" action="/maintenance/store" class="form-grid">

<label>Veículo</label>
<select name="vehicle_id">
<?php foreach($vehicles as $v): ?>
<option value="<?= $v['id'] ?>">
<?= $v['plate'] ?>
</option>
<?php endforeach; ?>
</select>

<label>Tipo</label>
<input name="type" placeholder="Ex: Troca de óleo">

<label>Descrição</label>
<input name="description">

<label>Custo</label>
<input type="number" step="0.01" name="cost">

<label>KM atual</label>
<input type="number" name="km">

<label>Próxima manutenção (KM)</label>
<input type="number" name="next_km">

<label>Data</label>
<input type="date" name="maintenance_date">

<button class="btn">Salvar</button>

</form>