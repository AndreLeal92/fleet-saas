<h1>Editar Veículo</h1>

<form method="POST" action="/vehicles/update" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $vehicle['id'] ?>">
<input type="hidden" name="crlv_atual" value="<?= $vehicle['crlv_file'] ?? '' ?>">

<!-- ABAS -->

<div class="tabs">

<button type="button" class="tab-btn active" onclick="openTab(event,'dados')">Dados do Veículo</button>
<button type="button" class="tab-btn" onclick="openTab(event,'proprietario')">Proprietário</button>
<button type="button" class="tab-btn" onclick="openTab(event,'endereco')">Endereço</button>
<button type="button" class="tab-btn" onclick="openTab(event,'documentos')">Documentos</button>

</div>


<!-- DADOS DO VEÍCULO -->

<div id="dados" class="tab-content active">

<div class="form-grid">

<label>Placa</label>
<input type="text" name="plate" required
value="<?= htmlspecialchars($vehicle['plate'] ?? '') ?>">

<label>Tipo do Veículo</label>
<input type="text" name="vehicle_type"
value="<?= htmlspecialchars($vehicle['vehicle_type'] ?? '') ?>">

<label>Ano Fabricação</label>
<input type="number" name="year_fab"
value="<?= htmlspecialchars($vehicle['year_fab'] ?? '') ?>">

<label>Marca</label>
<input type="text" name="brand"
value="<?= htmlspecialchars($vehicle['brand'] ?? '') ?>">

<label>Modelo</label>
<input type="text" name="model"
value="<?= htmlspecialchars($vehicle['model'] ?? '') ?>">

<label>Renavam</label>
<input type="text" name="renavam"
value="<?= htmlspecialchars($vehicle['renavam'] ?? '') ?>">

<label>Chassis</label>
<input type="text" name="chassis"
value="<?= htmlspecialchars($vehicle['chassis'] ?? '') ?>">

<label>Tipo Combustível</label>
<input type="text" name="fuel_type"
value="<?= htmlspecialchars($vehicle['fuel_type'] ?? '') ?>">

<label>Usa Arla32</label>
<input type="checkbox" name="uses_arla32" value="1"
<?= !empty($vehicle['uses_arla32']) ? 'checked' : '' ?>>

<label>Medida do Pneu</label>
<input type="text" name="tire_size"
value="<?= htmlspecialchars($vehicle['tire_size'] ?? '') ?>">

<label>Capacidade Tanque Combustível</label>
<input type="number" name="fuel_tank_capacity"
value="<?= htmlspecialchars($vehicle['fuel_tank_capacity'] ?? '') ?>">

<label>Capacidade Tanque Arla32</label>
<input type="number" name="arla_tank_capacity"
value="<?= htmlspecialchars($vehicle['arla_tank_capacity'] ?? '') ?>">

<label>Capacidade de Carga</label>
<input type="number" name="cargo_capacity"
value="<?= htmlspecialchars($vehicle['cargo_capacity'] ?? '') ?>">

<label>PBT</label>
<input type="number" name="pbt"
value="<?= htmlspecialchars($vehicle['pbt'] ?? '') ?>">

</div>

</div>


<!-- PROPRIETÁRIO -->

<div id="proprietario" class="tab-content">

<div class="form-grid">

<label>Proprietário</label>
<input type="text" name="owner_name"
value="<?= htmlspecialchars($vehicle['owner_name'] ?? '') ?>">

<label>CNPJ / CPF</label>
<input type="text" name="owner_document"
value="<?= htmlspecialchars($vehicle['owner_document'] ?? '') ?>">

<label>Telefone</label>
<input type="text" name="owner_phone"
value="<?= htmlspecialchars($vehicle['owner_phone'] ?? '') ?>">

<label>Responsável</label>
<input type="text" name="responsible_name"
value="<?= htmlspecialchars($vehicle['responsible_name'] ?? '') ?>">

<label>Email</label>
<input type="email" name="owner_email"
value="<?= htmlspecialchars($vehicle['owner_email'] ?? '') ?>">

</div>

</div>


<!-- ENDEREÇO -->

<div id="endereco" class="tab-content">

<div class="form-grid">

<label>CEP</label>
<input type="text" name="cep"
value="<?= htmlspecialchars($vehicle['cep'] ?? '') ?>">

<label>Logradouro</label>
<input type="text" name="logradouro"
value="<?= htmlspecialchars($vehicle['logradouro'] ?? '') ?>">

<label>Número</label>
<input type="text" name="numero"
value="<?= htmlspecialchars($vehicle['numero'] ?? '') ?>">

<label>Bairro</label>
<input type="text" name="bairro"
value="<?= htmlspecialchars($vehicle['bairro'] ?? '') ?>">

<label>Cidade</label>
<input type="text" name="cidade"
value="<?= htmlspecialchars($vehicle['cidade'] ?? '') ?>">

<label>Estado</label>
<input type="text" name="estado"
value="<?= htmlspecialchars($vehicle['estado'] ?? '') ?>">

</div>

</div>


<!-- DOCUMENTOS -->

<div id="documentos" class="tab-content">

<div class="form-grid">

<?php if(!empty($vehicle['crlv_file'])): ?>

<a class="btn" href="<?= $vehicle['crlv_file'] ?>" target="_blank">
Ver CRLV Atual
</a>

<?php endif; ?>

<label>Substituir CRLV</label>
<input type="file" name="crlv_file" accept="application/pdf">

<label>Status</label>

<select name="status">
<option value="1" <?= ($vehicle['status'] ?? 1)==1?'selected':'' ?>>Ativo</option>
<option value="0" <?= ($vehicle['status'] ?? 1)==0?'selected':'' ?>>Inativo</option>
</select>

</div>

</div>


<button class="btn">Salvar Alterações</button>

</form>


<style>

.tabs{
display:flex;
gap:10px;
margin-bottom:20px;
}

.tab-btn{
padding:10px 15px;
border:none;
background:#ddd;
cursor:pointer;
border-radius:5px;
}

.tab-btn.active{
background:#2563eb;
color:white;
}

.tab-content{
display:none;
}

.tab-content.active{
display:block;
}

.form-grid{
display:grid;
grid-template-columns:200px 1fr;
gap:10px;
align-items:center;
max-width:800px;
}

input,select{
padding:8px;
border:1px solid #ccc;
border-radius:5px;
}

.btn{
margin-top:20px;
padding:10px 20px;
background:#2563eb;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

</style>


<script>

function openTab(event,tab){

document.querySelectorAll('.tab-content').forEach(el=>{
el.classList.remove('active')
})

document.querySelectorAll('.tab-btn').forEach(el=>{
el.classList.remove('active')
})

document.getElementById(tab).classList.add('active')

event.target.classList.add('active')

}

</script>