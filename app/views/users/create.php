<h1>Novo Usuário</h1>

<form method="POST" action="/users/store">

Nome
<br>
<input type="text" name="name" required>

<br><br>

Email
<br>
<input type="email" name="email" required>

<br><br>

Senha
<br>
<input type="password" name="password" required>

<br><br>

Perfil
<br>

<select name="role">

<option value="admin">Admin</option>
<option value="manager">Manager</option>
<option value="user">User</option>

</select>

<br><br>

<button type="submit">Salvar</button>

</form>

<br>

<a href="/users">Voltar</a>
