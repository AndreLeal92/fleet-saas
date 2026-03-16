<h2>Nova Viagem</h2>

<form method="POST" action="/trips/store">

<label>Motorista</label>

<select name="driver_id">

<?php foreach($drivers as $driver): ?>

<option value="<?= $driver['id'] ?>">
<?= $driver['name'] ?>
</option>

<?php endforeach; ?>

</select>


<label>Veículo</label>

<select name="vehicle_id">

<?php foreach($vehicles as $vehicle): ?>

<option value="<?= $vehicle['id'] ?>">
<?= $vehicle['plate'] ?>
</option>

<?php endforeach; ?>

</select>


<label>Origem</label>
<input type="text" name="origin">


<label>Destino</label>
<input type="text" name="destination">


<label>Data</label>
<input type="date" name="trip_date">


<label>KM Inicial</label>
<input type="number" name="km_start">


<label>KM Final</label>
<input type="number" name="km_end">


<br><br>

<button type="submit">Salvar</button>

</form>
