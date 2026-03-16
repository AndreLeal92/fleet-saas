<h1>Novo Abastecimento</h1>

<form method="POST" action="/fuel/store">


<label>Viagem</label>

<select name="trip_id">

<option value="">Selecione</option>

<?php foreach($trips as $t): ?>

<option value="<?= $t['id'] ?>">
<?= str_pad($t['id'],8,'0',STR_PAD_LEFT) ?> 
- <?= $t['origin'] ?> → <?= $t['destination'] ?>
</option>

<?php endforeach; ?>

</select>


<label>Veículo</label>

<select name="vehicle_id">

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= $v['plate'] ?> - <?= $v['model'] ?? '' ?>
</option>

<?php endforeach; ?>

</select>


<label>Motorista</label>

<select name="driver_id">

<?php foreach($drivers as $d): ?>

<option value="<?= $d['id'] ?>">
<?= $d['name'] ?>
</option>

<?php endforeach; ?>

</select>


<label>Litros</label>

<input 
type="number" 
step="0.01" 
name="liters"
id="liters"
oninput="calcularTotal()"
>


<label>Preço por litro</label>

<input 
type="number" 
step="0.01" 
name="price"
id="price"
oninput="calcularTotal()"
>


<label>Total</label>

<input 
type="number" 
step="0.01" 
name="total"
id="total"
readonly
>


<label>KM</label>

<input type="number" name="odometer">


<label>Data</label>

<input type="date" name="fuel_date">


<br><br>

<button type="submit">
Salvar
</button>

</form>


<script>

function calcularTotal(){

let litros = parseFloat(document.getElementById("liters").value) || 0;
let preco  = parseFloat(document.getElementById("price").value) || 0;

let total = litros * preco;

document.getElementById("total").value = total.toFixed(2);

}

</script>