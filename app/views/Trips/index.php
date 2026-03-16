<h1>Viagens</h1>

<a href="/trips/create" style="display:inline-block;margin-bottom:15px;padding:8px 12px;background:#2563eb;color:white;text-decoration:none;border-radius:4px;">
Nova Viagem
</a>

<table border="1" width="100%" cellpadding="10" style="background:white;border-collapse:collapse;">

<tr style="background:#f3f4f6;">

<th>Motorista</th>
<th>Veículo</th>
<th>Origem</th>
<th>Destino</th>
<th>Data</th>
<th>KM</th>
<th>Ações</th>

</tr>

<?php foreach($trips as $trip): ?>

<tr>

<td><?= $trip['driver_name'] ?? '-' ?></td>
<td><?= $trip['vehicle_plate'] ?? '-' ?></td>
<td><?= $trip['origin'] ?></td>
<td><?= $trip['destination'] ?></td>
<td>
<?= !empty($trip['date']) ? date('d/m/Y', strtotime($trip['date'])) : '-' ?>
</td>

<td>
<?= $trip['km'] ?? '-' ?>
</td>

<td>

<a href="/trips/edit?id=<?= $trip['id'] ?>">Editar</a> |

<a href="/trips/delete?id=<?= $trip['id'] ?>" 
onclick="return confirm('Excluir esta viagem?')">
Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

</table>