<h1>Manutenções Preventivas</h1>

<a href="/maintenance-plans/create" class="btn">➕ Nova Preventiva</a>

<div class="table-box">

<table>

<tr>
<th>Veículo</th>
<th>Nome</th>
<th>KM</th>
<th>Dias</th>
<th>Ação</th>
</tr>

<?php foreach($plans as $p): ?>

<tr>
<td><?= $p['plate'] ?? 'Todos' ?></td>
<td><?= $p['name'] ?></td>
<td><?= $p['interval_km'] ?></td>
<td><?= $p['interval_days'] ?></td>
<td>
<a href="/maintenance-plans/delete?id=<?= $p['id'] ?>">Excluir</a>
</td>
</tr>

<?php endforeach; ?>

</table>

</div>