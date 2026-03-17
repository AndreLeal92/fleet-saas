<h2>Nova Viagem</h2>

<form method="POST" action="/trips/store" id="tripForm">

<div class="form-grid">

<label>Motorista *</label>

<select name="driver_id" required>

<option value="">Selecione o motorista</option>

<?php foreach($drivers as $driver): ?>

<option value="<?= $driver['id'] ?>">
<?= htmlspecialchars($driver['name']) ?>
</option>

<?php endforeach; ?>

</select>



<label>Veículo *</label>

<select name="vehicle_id" required>

<option value="">Selecione o veículo</option>

<?php foreach($vehicles as $vehicle): ?>

<option value="<?= $vehicle['id'] ?>">
<?= htmlspecialchars($vehicle['plate']) ?> - <?= htmlspecialchars($vehicle['model'] ?? '') ?>
</option>

<?php endforeach; ?>

</select>



<label>Origem *</label>
<input type="text" name="origin" placeholder="Cidade de origem" required>



<label>Destino *</label>
<input type="text" name="destination" placeholder="Cidade de destino" required>



<label>Data da Viagem *</label>
<input type="date" name="trip_date" required>



<label>KM Inicial *</label>
<input type="number" name="km_start" id="km_start" placeholder="Ex: 152000" required>



<label>KM Final *</label>
<input type="number" name="km_end" id="km_end" placeholder="Ex: 152450" required>



<label>Observações</label>
<textarea name="notes" rows="3" placeholder="Informações adicionais da viagem"></textarea>

</div>

<br>

<button type="submit" class="btn-save">
Salvar Viagem
</button>

</form>



<style>

.form-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
max-width:700px;
}

label{
font-weight:600;
}

input, select, textarea{
padding:8px;
border:1px solid #ccc;
border-radius:5px;
width:100%;
}

textarea{
grid-column:1 / span 2;
}

.btn-save{
background:#2563eb;
color:white;
border:none;
padding:10px 20px;
border-radius:5px;
cursor:pointer;
font-size:15px;
}

.btn-save:hover{
background:#1e40af;
}

</style>



<script>

/* valida KM */

document.getElementById("tripForm").addEventListener("submit", function(e){

let start = parseInt(document.getElementById("km_start").value);
let end = parseInt(document.getElementById("km_end").value);

if(end < start){

alert("KM final não pode ser menor que o KM inicial.");

e.preventDefault();

}

});

</script>