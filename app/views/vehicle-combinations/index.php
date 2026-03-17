<h1>Combinação de Veículos</h1>

<a href="/vehicle-combinations/create" class="btn">
➕ Atrelar Cavalo + Carreta
</a>

<div class="table-box">

<table>

<thead>
<tr>
<th>Cavalo</th>
<th>Carreta</th>
<th>Ações</th>
</tr>
</thead>

<tbody>

<?php if(!empty($combinations)): ?>

<?php foreach($combinations as $c): ?>

<tr>

<td><?= htmlspecialchars($c['cavalo']) ?></td>
<td><?= htmlspecialchars($c['carreta']) ?></td>

<td>

<a 
href="/vehicle-combinations/detach?id=<?= $c['id'] ?>"
class="btn btn-danger"
onclick="return confirm('Desatrelar conjunto?')"
>

Desatrelar

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="3" style="text-align:center;">
Nenhuma combinação encontrada
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>