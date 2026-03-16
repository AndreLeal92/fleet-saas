<h1>Veículos</h1>

<div style="display:flex;gap:10px;margin-bottom:15px;align-items:center;">

<a href="/vehicles/create" class="btn">Novo Veículo</a>

<input 
type="text" 
id="searchPlate" 
placeholder="Buscar placa..."
style="padding:8px;border:1px solid #ccc;border-radius:5px;"
>

<a href="/vehicles" class="btn">Todos</a>
<a href="/vehicles?status=1" class="btn">Ativos</a>
<a href="/vehicles?status=0" class="btn">Inativos</a>

</div>


<div class="table-box">

<table id="vehicleTable">

<thead>
<tr>
<th>ID</th>
<th>Placa</th>
<th>Marca</th>
<th>Modelo</th>
<th>Ano</th>
<th>Status</th>
<th>CRLV</th>
<th>Ações</th>
</tr>
</thead>

<tbody>

<?php foreach($vehicles as $v): ?>

<tr>

<td><?= $v['id'] ?></td>

<td><strong><?= htmlspecialchars($v['plate']) ?></strong></td>

<td><?= htmlspecialchars($v['brand']) ?></td>

<td><?= htmlspecialchars($v['model']) ?></td>

<td><?= htmlspecialchars($v['year_fab'] ?? $v['year'] ?? '-') ?></td>

<td>

<?php if($v['status']): ?>

<span style="color:green;font-weight:bold;">Ativo</span>

<?php else: ?>

<span style="color:red;font-weight:bold;">Inativo</span>

<?php endif; ?>

</td>

<td>

<?php if(!empty($v['crlv_file'])): ?>

<a href="<?= $v['crlv_file'] ?>" target="_blank" title="Abrir CRLV">
📄
</a>

<a href="<?= $v['crlv_file'] ?>" download title="Baixar CRLV">
⬇
</a>

<?php else: ?>

-

<?php endif; ?>

</td>

<td style="display:flex;gap:5px;">

<a class="btn" href="/vehicles/edit?id=<?= $v['id'] ?>">
Editar
</a>

<a 
class="btn" 
href="/vehicles/delete?id=<?= $v['id'] ?>"
onclick="return confirm('Excluir veículo?')"
>
Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>


<script>

/* BUSCA POR PLACA */

document.getElementById("searchPlate").addEventListener("keyup", function(){

let filter = this.value.toUpperCase();

let rows = document.querySelectorAll("#vehicleTable tbody tr");

rows.forEach(row => {

let plate = row.children[1].innerText.toUpperCase();

row.style.display = plate.includes(filter) ? "" : "none";

});

});

</script>