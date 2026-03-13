<h1>Usuários</h1>

<?php if(isset($_GET['success'])){ ?>
<div style="color:green;">Usuário salvo com sucesso</div>
<?php } ?>

<a href="/users/create">Novo Usuário</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Perfil</th>
<th>Ações</th>
</tr>

<?php foreach($users as $u){ ?>

<tr>

<td><?= $u['id'] ?></td>
<td><?= $u['name'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['role'] ?></td>

<td>
<a href="/users/delete?id=<?= $u['id'] ?>">Excluir</a>
</td>

</tr>

<?php } ?>

</table>
