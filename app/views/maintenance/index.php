<h1 style="margin-bottom:20px;">Manutenções</h1>

<a href="/maintenance/create" class="btn">➕ Nova Manutenção</a>

<!-- ALERTAS -->
<?php if(!empty($alerts)): ?>
<div style="background:#fee2e2;padding:15px;margin-top:20px;border-radius:8px;">
<strong>⚠️ Alertas de manutenção:</strong><br><br>

<?php foreach($alerts as $a): ?>
<div style="margin-bottom:5px;">
🚚 <?= $a['plate'] ?> precisa de manutenção
</div>
<?php endforeach; ?>

</div>
<?php endif; ?>

<!-- TABELA -->
<div class="table-box" style="margin-top:20px;">

<table>

<tr>
<th>Veículo</th>
<th>Tipo</th>
<th>Custo</th>
<th>KM</th>
<th>Próximo KM</th>
<th>Status</th>
<th>Data</th>
<th>Ação</th>
</tr>

<?php foreach($records as $r): ?>

<tr>

<td><?= $r['plate'] ?></td>

<td><?= $r['type'] ?? '-' ?></td>

<td>
R$ <?= number_format($r['cost'] ?? 0,2,',','.') ?>
</td>

<td><?= $r['km'] ?? '-' ?></td>

<td><?= $r['next_km'] ?? '-' ?></td>

<td>
<?php
$status = $r['status'] ?? 'OK';

$color = '#16a34a';

if($status == 'PRÓXIMO'){
    $color = '#f59e0b';
}

if($status == 'VENCIDO'){
    $color = '#dc2626';
}
?>

<span style="
background:<?= $color ?>;
color:white;
padding:5px 10px;
border-radius:6px;
font-size:12px;
">
<?= $status ?>
</span>

</td>

<td><?= $r['maintenance_date'] ?? '-' ?></td>

<td>
<a href="/maintenance/delete?id=<?= $r['id'] ?>" 
style="color:red;">Excluir</a>
</td>

</tr>

<?php endforeach; ?>

</table>

</div>