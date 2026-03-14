<h1>Novo Abastecimento</h1>

<form method="POST" action="/fuel/store">

<label>Veículo</label>

<select name="vehicle_id">

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= $v['plate'] ?>
</option>

<?php endforeach; ?>

</select>

<label>Motorista</label>

<select name="driver_id">

<?php foreach($drivers as $d): ?>

<option value="<?= $d['id'] ?>">
<?= $d['name'] ?>
</option>

<?php endforeach; ?>

</select>

<label>Litros</label>
<input type="number" step="0.01" name="liters">

<label>Preço por litro</label>
<input type="number" step="0.01" name="price">

<label>Total</label>
<input type="number" step="0.01" name="total">

<label>KM</label>
<input type="number" name="odometer">

<label>Data</label>
<input type="date" name="fuel_date">

<button type="submit">
Salvar
</button>

</form>