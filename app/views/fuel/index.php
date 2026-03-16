<h1>Abastecimentos</h1>

<a href="/fuel/create" class="btn">Novo Abastecimento</a>

<table border="1">

<tr>
<th>ID</th>
<th>Veículo</th>
<th>Motorista</th>
<th>Litros</th>
<th>Preço</th>
<th>Total</th>
<th>KM</th>
<th>Data</th>
<th>Ações</th>
</tr>

<?php foreach($records as $r): ?>

<tr>

<td><?= $r['id'] ?></td>
<td><?= $r['vehicle'] ?></td>
<td><?= $r['driver'] ?></td>
<td><?= $r['liters'] ?></td>
<td><?= $r['price'] ?></td>
<td><?= $r['total'] ?></td>
<td><?= $r['odometer'] ?></td>
<td><?= $r['fuel_date'] ?></td>

<td>
<a href="/fuel/delete?id=<?= $r['id'] ?>">Excluir</a>
</td>

</tr>

<?php endforeach; ?>

</table>