<h1>Novo Usuário</h1>

<form method="POST" action="/users/store">

<label>Nome</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Senha</label>
<input type="password" name="password" required>

<label>Perfil</label>

<select name="role">

<option value="admin">Admin</option>
<option value="user">Usuário</option>

</select>

<button type="submit">
Salvar
</button>

</form>