<h1>Editar Viagem</h1>

<form method="POST" action="/trips/update">

<input type="hidden" name="id" value="<?= $trip['id'] ?>">

<label>Motorista</label>

<select name="driver_id">

<?php foreach($drivers as $d): ?>

<option value="<?= $d['id'] ?>" <?= $d['id'] == $trip['driver_id'] ? 'selected' : '' ?>>

<?= $d['name'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Veículo</label>

<select name="vehicle_id">

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>" <?= $v['id'] == $trip['vehicle_id'] ? 'selected' : '' ?>>

<?= $v['plate'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Origem</label>

<input type="text" name="origin" value="<?= $trip['origin'] ?>">

<br><br>

<label>Destino</label>

<input type="text" name="destination" value="<?= $trip['destination'] ?>">

<br><br>

<label>Data</label>

<input type="date" name="trip_date" value="<?= $trip['trip_date'] ?>">

<br><br>

<label>KM Inicial</label>

<input type="number" name="km_start" value="<?= $trip['km_start'] ?>">

<br><br>

<label>KM Final</label>

<input type="number" name="km_end" value="<?= $trip['km_end'] ?>">

<br><br>

<button type="submit">Atualizar</button>

</form>