<h1>Editar Usuário</h1>

<form method="POST" action="/users/update/<?= $user['id'] ?>">

<label>Nome</label>
<input type="text" name="name" value="<?= $user['name'] ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?= $user['email'] ?>" required>

<label>Nova senha</label>
<input type="password" name="password" placeholder="Deixe vazio para não alterar">

<label>Perfil</label>

<select name="role">

<option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
<option value="user" <?= $user['role']=='user'?'selected':'' ?>>Usuário</option>

</select>

<button type="submit">
Atualizar
</button>

</form>