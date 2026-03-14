<h1>Viagens</h1>

<a href="/trips/create">Nova Viagem</a>

<table border="1">

<tr>
<th>ID</th>
<th>Motorista</th>
<th>Veículo</th>
<th>Origem</th>
<th>Destino</th>
<th>KM Inicial</th>
<th>KM Final</th>
<th>Data</th>
<th>Ações</th>
</tr>

<?php foreach($trips as $t): ?>

<tr>

<td><?= $t['id'] ?></td>
<td><?= $t['driver'] ?></td>
<td><?= $t['vehicle'] ?></td>
<td><?= $t['origin'] ?></td>
<td><?= $t['destination'] ?></td>
<td><?= $t['start_km'] ?></td>
<td><?= $t['end_km'] ?></td>
<td><?= $t['trip_date'] ?></td>

<td>
<a href="/trips/delete?id=<?= $t['id'] ?>">Excluir</a>
</td>

</tr>

<?php endforeach; ?>

</table>