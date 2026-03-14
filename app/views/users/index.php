<h1>Usuários</h1>

<a href="/users/create">Novo Usuário</a>

<table border="1">

<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Perfil</th>
<th>Ações</th>
</tr>

<?php foreach($users as $user): ?>

<tr>

<td><?= $user['id'] ?></td>
<td><?= $user['name'] ?></td>
<td><?= $user['email'] ?></td>
<td><?= $user['role'] ?></td>

<td>

<a href="/users/edit/<?= $user['id'] ?>">Editar</a>

<a href="/users/delete/<?= $user['id'] ?>">Excluir</a>

</td>

</tr>

<?php endforeach; ?>

</table>