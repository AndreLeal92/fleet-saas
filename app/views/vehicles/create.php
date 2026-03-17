<h1>Novo Veículo</h1>

<form method="POST" action="/vehicles/store" enctype="multipart/form-data">

<div class="form-grid">

<h3>Dados do veículo</h3>

<label>Placa</label>
<input name="plate" required>

<label>Tipo do Veículo</label>
<input 
name="vehicle_type"
list="vehicle_types"
placeholder="Digite ou selecione"
>

<datalist id="vehicle_types">
<?php if(!empty($vehicleTypes)): ?>
<?php foreach($vehicleTypes as $t): ?>
<option value="<?= htmlspecialchars($t['vehicle_type']) ?>">
<?php endforeach; ?>
<?php endif; ?>
</datalist>

<label>Ano Fabricação</label>
<input name="year_fab" type="number" min="1900">

<label>Marca</label>
<input name="brand">

<label>Modelo</label>
<input name="model">

<label>Renavam</label>
<input name="renavam">

<label>Chassis</label>
<input name="chassis">

<label>Tipo Combustível</label>
<input 
name="fuel_type" 
list="fuel_types"
placeholder="Digite ou selecione"
>

<datalist id="fuel_types">
<?php if(!empty($fuelTypes)): ?>
<?php foreach($fuelTypes as $f): ?>
<option value="<?= htmlspecialchars($f['fuel_type']) ?>">
<?php endforeach; ?>
<?php endif; ?>
</datalist>

<label>Usa Arla32</label>
<input type="hidden" name="uses_arla32" value="0">
<input type="checkbox" name="uses_arla32" value="1">

<label>Medida do Pneu</label>
<input name="tire_size">

<label>Capacidade Tanque Combustível (L)</label>
<input 
name="fuel_tank_capacity" 
type="number" 
step="0.01" 
min="0"
value=""
>

<label>Capacidade Tanque Arla32 (L)</label>
<input 
name="arla_tank_capacity" 
type="number" 
step="0.01" 
min="0"
value=""
>

<label>Capacidade de Carga (Kg)</label>
<input 
name="cargo_capacity" 
type="number" 
min="0"
value=""
>

<label>PBT (Kg)</label>
<input 
name="pbt" 
type="number" 
min="0"
value=""
>

</div>


<div class="form-grid">

<h3>Proprietário</h3>

<label>Proprietário</label>
<input name="owner_name">

<label>CNPJ / CPF</label>
<input name="owner_document">

<label>Telefone</label>
<input name="owner_phone">

<label>Responsável</label>
<input name="responsible_name">

<label>Email</label>
<input name="owner_email" type="email">

</div>


<div class="form-grid">

<h3>Endereço</h3>

<label>CEP</label>
<input id="cep" name="cep">

<label>Logradouro</label>
<input id="logradouro" name="logradouro">

<label>Número</label>
<input name="numero">

<label>Bairro</label>
<input id="bairro" name="bairro">

<label>Cidade</label>
<input id="cidade" name="cidade">

<label>Estado</label>
<input id="estado" name="estado">

</div>


<div class="form-grid">

<h3>Documentos</h3>

<label>CRLV (PDF)</label>
<input type="file" name="crlv_file" accept="application/pdf">

</div>


<div class="form-grid">

<h3>Status</h3>

<label>Veículo Ativo</label>

<select name="status">
<option value="1">Ativo</option>
<option value="0">Inativo</option>
</select>

</div>

<button class="btn">Salvar Veículo</button>

</form>