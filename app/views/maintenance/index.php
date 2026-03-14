<h1>Manutenções</h1>

<a href="/maintenance/create">Nova Manutenção</a>

<table border="1">

<tr>
<th>ID</th>
<th>Veículo</th>
<th>Descrição</th>
<th>Custo</th>
<th>KM</th>
<th>Data</th>
<th>Ações</th>
</tr>

<?php foreach($maintenances as $m): ?>

<tr>

<td><?= $m['id'] ?></td>
<td><?= $m['vehicle'] ?></td>
<td><?= $m['description'] ?></td>
<td><?= $m['cost'] ?></td>
<td><?= $m['odometer'] ?></td>
<td><?= $m['maintenance_date'] ?></td>

<td>
<a href="/maintenance/delete?id=<?= $m['id'] ?>">Excluir</a>
</td>

</tr>

<?php endforeach; ?>

</table>