<h1>Nova Manutenção</h1>

<form method="POST" action="/maintenance/store">

<label>Veículo</label>

<select name="vehicle_id">

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= $v['plate'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Descrição</label>
<input type="text" name="description">

<br><br>

<label>Custo</label>
<input type="number" step="0.01" name="cost">

<br><br>

<label>KM</label>
<input type="number" name="odometer">

<br><br>

<label>Data</label>
<input type="date" name="maintenance_date">

<br><br>

<button type="submit">
Salvar
</button>

</form>