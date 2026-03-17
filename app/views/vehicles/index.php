<h1>Veículos</h1>

<?php
$status = $_GET['status'] ?? 'all';
?>

<div class="toolbar">

<a href="/vehicles/create" class="btn">Novo Veículo</a>

<input 
type="text" 
id="searchPlate" 
placeholder="Buscar placa..."
class="search-input"
>

<a href="/vehicles" class="btn <?= $status=='all'?'active':'' ?>">Todos</a>
<a href="/vehicles?status=1" class="btn <?= $status==='1'?'active':'' ?>">Ativos</a>
<a href="/vehicles?status=0" class="btn <?= $status==='0'?'active':'' ?>">Inativos</a>

<a href="/vehicles/export?type=csv&status=<?= $status ?>" class="btn">
Exportar CSV
</a>

<a href="/vehicles/export?type=pdf&status=<?= $status ?>" class="btn">
Exportar PDF
</a>

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

<?php if(!empty($vehicles)): ?>

<?php foreach($vehicles as $v): ?>

<tr>

<td><?= $v['id'] ?></td>

<td>
<strong><?= htmlspecialchars($v['plate']) ?></strong>
</td>

<td><?= htmlspecialchars($v['brand']) ?></td>

<td><?= htmlspecialchars($v['model']) ?></td>

<td><?= htmlspecialchars($v['year_fab'] ?? '-') ?></td>

<td>

<?php if($v['status']): ?>

<span class="status ativo">Ativo</span>

<?php else: ?>

<span class="status inativo">Inativo</span>

<?php endif; ?>

</td>

<td>

<?php if(!empty($v['crlv_file'])): 

/* pega apenas nome do arquivo */
$file = basename($v['crlv_file']);

/* monta caminho correto */
$url = "/uploads/crlv/" . $file;

?>

<a href="<?= htmlspecialchars($url) ?>" target="_blank" title="Abrir CRLV">
📄
</a>

<a href="<?= htmlspecialchars($url) ?>" download title="Baixar CRLV">
⬇
</a>

<?php else: ?>

-

<?php endif; ?>

</td>

<td class="actions">

<a class="btn" href="/vehicles/edit?id=<?= $v['id'] ?>">
Editar
</a>

<a 
class="btn btn-danger"
href="/vehicles/delete?id=<?= $v['id'] ?>"
onclick="return confirm('Excluir veículo?')"
>
Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="8" style="text-align:center;padding:20px;">
Nenhum veículo encontrado
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>


<style>

.toolbar{
display:flex;
gap:10px;
margin-bottom:15px;
align-items:center;
flex-wrap:wrap;
}

.search-input{
padding:8px;
border:1px solid #ccc;
border-radius:5px;
}

.table-box{
background:#f8fafc;
padding:15px;
border-radius:10px;
}

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#e5e7eb;
}

th,td{
padding:10px;
text-align:left;
border-bottom:1px solid #ddd;
}

tbody tr:hover{
background:#f1f5f9;
}

.status{
font-weight:bold;
}

.status.ativo{
color:green;
}

.status.inativo{
color:red;
}

.actions{
display:flex;
gap:5px;
}

.btn{
padding:8px 14px;
background:#2563eb;
color:white;
border-radius:5px;
text-decoration:none;
font-size:14px;
}

.btn:hover{
background:#1d4ed8;
}

.btn-danger{
background:#ef4444;
}

.btn-danger:hover{
background:#dc2626;
}

.btn.active{
background:#1e40af;
}

</style>


<script>

/* BUSCA POR PLACA */

const searchInput = document.getElementById("searchPlate");

if(searchInput){

searchInput.addEventListener("keyup", function(){

let filter = this.value.toUpperCase();

let rows = document.querySelectorAll("#vehicleTable tbody tr");

rows.forEach(row => {

let plate = row.children[1].innerText.toUpperCase();

row.style.display = plate.includes(filter) ? "" : "none";

});

});

}

</script>