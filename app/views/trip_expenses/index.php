<h1>Despesas de Viagem</h1>

<a href="/trip-expenses/create" style="
background:#2563eb;
color:white;
padding:10px 15px;
text-decoration:none;
border-radius:5px;
display:inline-block;
margin-bottom:15px;
">
Nova Despesa
</a>

<table style="
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 3px 8px rgba(0,0,0,0.1);
">

<tr style="background:#111827;color:white;">
<th style="padding:10px;">Motorista</th>
<th style="padding:10px;">Veículo</th>
<th style="padding:10px;">Tipo</th>
<th style="padding:10px;">Descrição</th>
<th style="padding:10px;">Local</th>
<th style="padding:10px;">Valor</th>
<th style="padding:10px;">Data</th>
<th style="padding:10px;">Ações</th>
</tr>

<?php if(!empty($expenses)): ?>

<?php foreach($expenses as $expense): ?>

<tr style="border-bottom:1px solid #ddd">

<td style="padding:10px">
<?= htmlspecialchars($expense['driver_name']) ?>
</td>

<td style="padding:10px">
<?= htmlspecialchars($expense['vehicle_plate']) ?>
</td>

<td style="padding:10px">
<?= htmlspecialchars($expense['expense_type']) ?>
</td>

<td style="padding:10px">
<?= htmlspecialchars($expense['description']) ?>
</td>

<td style="padding:10px">
<?= htmlspecialchars($expense['location']) ?>
</td>

<td style="padding:10px">
R$ <?= number_format($expense['amount'],2,',','.') ?>
</td>

<td style="padding:10px">
<?= $expense['expense_date'] ?>
</td>

<td style="padding:10px">

<a href="/trip-expenses/delete?id=<?= $expense['id'] ?>"
style="color:red;text-decoration:none;"
onclick="return confirm('Excluir despesa?')">
Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="8" style="padding:20px;text-align:center;">
Nenhuma despesa cadastrada
</td>
</tr>

<?php endif; ?>

</table>
