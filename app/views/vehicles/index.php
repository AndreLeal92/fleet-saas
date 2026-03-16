<h1>Veículos</h1>

<a href="/vehicles/create" class="btn">Novo Veículo</a>

<br><br>

<table border="1" cellpadding="8">

<tr>
<th>ID</th>
<th>Placa</th>
<th>Modelo</th>
<th>Ano</th>
<th>Ações</th>
</tr>

<?php foreach($vehicles as $v){ ?>

<tr>

<td><?= $v['id'] ?></td>
<td><?= $v['plate'] ?></td>
<td><?= $v['model'] ?></td>
<td><?= $v['year'] ?></td>

<td>
<a href="/vehicles/delete?id=<?= $v['id'] ?>">Excluir</a>
</td>

</tr>

<?php } ?>

</table>
