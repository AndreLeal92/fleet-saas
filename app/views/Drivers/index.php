<h1>Motoristas</h1>

<a href="/drivers/create">Novo Motorista</a>

<table border="1">

<tr>
<th>ID</th>
<th>Nome</th>
<th>CPF</th>
<th>CNH</th>
<th>Telefone</th>
<th>Ações</th>
</tr>

<?php foreach($drivers as $driver): ?>

<tr>

<td><?= $driver['id'] ?></td>
<td><?= $driver['name'] ?></td>
<td><?= $driver['cpf'] ?></td>
<td><?= $driver['cnh'] ?></td>
<td><?= $driver['phone'] ?></td>

<td>

<a href="/drivers/delete?id=<?= $driver['id'] ?>">
Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

</table>