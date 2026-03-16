<h1>Nova Despesa de Viagem</h1>

<form method="POST" action="/trip-expenses/store">

<label>Viagem</label>

<select name="trip_id">

<?php foreach($trips as $trip): ?>

<option value="<?= $trip['id'] ?>">

Viagem <?= str_pad($trip['id'],4,'0',STR_PAD_LEFT) ?> -
<?= $trip['origin'] ?> → <?= $trip['destination'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Motorista</label>

<select name="driver_id">

<?php foreach($drivers as $d): ?>

<option value="<?= $d['id'] ?>">
<?= $d['name'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Veículo</label>

<select name="vehicle_id">

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= $v['plate'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Tipo</label>
<input type="text" name="expense_type">

<br><br>

<label>Descrição</label>
<input type="text" name="description">

<br><br>

<label>Local</label>
<input type="text" name="location">

<br><br>

<label>Valor</label>
<input type="number" step="0.01" name="amount">

<br><br>

<label>Data</label>
<input type="date" name="expense_date">

<br><br>

<button type="submit">
Salvar
</button>

</form>