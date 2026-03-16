<h1>Relatório de Viagens</h1>

<table border="1" width="100%" cellpadding="10">

<tr>

<th>Viagem</th>
<th>Motorista</th>
<th>Veículo</th>
<th>KM</th>
<th>Combustível</th>
<th>Despesas</th>
<th>Custo Total</th>
<th>Custo/KM</th>

</tr>

<?php foreach($trips as $trip): 

$total = $trip['fuel_cost'] + $trip['expenses'];

$custo_km = $trip['km'] > 0 
? $total / $trip['km'] 
: 0;

?>

<tr>

<td><?= str_pad($trip['id'],4,'0',STR_PAD_LEFT) ?></td>

<td><?= $trip['driver'] ?></td>

<td><?= $trip['vehicle'] ?></td>

<td><?= $trip['km'] ?> km</td>

<td>R$ <?= number_format($trip['fuel_cost'],2,',','.') ?></td>

<td>R$ <?= number_format($trip['expenses'],2,',','.') ?></td>

<td><strong>R$ <?= number_format($total,2,',','.') ?></strong></td>

<td>
R$ <?= number_format($custo_km,2,',','.') ?>
</td>

</tr>

<?php endforeach; ?>

</table>