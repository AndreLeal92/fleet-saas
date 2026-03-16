<h1>Editar Veículo</h1>

<form method="POST" action="/vehicles/update" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $vehicle['id'] ?>">

<!-- ABAS -->

<div class="tabs">

<button type="button" class="tab-btn active" onclick="openTab('dados')">Dados do Veículo</button>
<button type="button" class="tab-btn" onclick="openTab('proprietario')">Proprietário</button>
<button type="button" class="tab-btn" onclick="openTab('endereco')">Endereço</button>
<button type="button" class="tab-btn" onclick="openTab('documentos')">Documentos</button>

</div>


<!-- DADOS DO VEÍCULO -->

<div id="dados" class="tab-content active">

<div class="form-grid">

<label>Placa</label>
<input name="plate" value="<?= htmlspecialchars($vehicle['plate']) ?>">

<label>Tipo do Veículo</label>
<input name="vehicle_type" value="<?= htmlspecialchars($vehicle['vehicle_type'] ?? '') ?>">

<label>Ano Fabricação</label>
<input name="year_fab" type="number" value="<?= htmlspecialchars($vehicle['year_fab'] ?? '') ?>">

<label>Marca</label>
<input name="brand" value="<?= htmlspecialchars($vehicle['brand'] ?? '') ?>">

<label>Modelo</label>
<input name="model" value="<?= htmlspecialchars($vehicle['model'] ?? '') ?>">

<label>Renavam</label>
<input name="renavam" value="<?= htmlspecialchars($vehicle['renavam'] ?? '') ?>">

<label>Chassis</label>
<input name="chassis" value="<?= htmlspecialchars($vehicle['chassis'] ?? '') ?>">

<label>Tipo Combustível</label>
<input name="fuel_type" value="<?= htmlspecialchars($vehicle['fuel_type'] ?? '') ?>">

<label>Usa Arla32</label>
<input type="checkbox" name="uses_arla32" value="1"
<?= !empty($vehicle['uses_arla32']) ? 'checked' : '' ?>>

<label>Medida do Pneu</label>
<input name="tire_size" value="<?= htmlspecialchars($vehicle['tire_size'] ?? '') ?>">

<label>Capacidade Tanque Combustível</label>
<input name="fuel_tank_capacity" value="<?= htmlspecialchars($vehicle['fuel_tank_capacity'] ?? '') ?>">

<label>Capacidade Tanque Arla32</label>
<input name="arla_tank_capacity" value="<?= htmlspecialchars($vehicle['arla_tank_capacity'] ?? '') ?>">

<label>Capacidade de Carga</label>
<input name="cargo_capacity" value="<?= htmlspecialchars($vehicle['cargo_capacity'] ?? '') ?>">

<label>PBT</label>
<input name="pbt" value="<?= htmlspecialchars($vehicle['pbt'] ?? '') ?>">

</div>

</div>


<!-- PROPRIETÁRIO -->

<div id="proprietario" class="tab-content">

<div class="form-grid">

<label>Proprietário</label>
<input name="owner_name" value="<?= htmlspecialchars($vehicle['owner_name'] ?? '') ?>">

<label>CNPJ / CPF</label>
<input name="owner_document" value="<?= htmlspecialchars($vehicle['owner_document'] ?? '') ?>">

<label>Telefone</label>
<input name="owner_phone" value="<?= htmlspecialchars($vehicle['owner_phone'] ?? '') ?>">

<label>Responsável</label>
<input name="responsible_name" value="<?= htmlspecialchars($vehicle['responsible_name'] ?? '') ?>">

<label>Email</label>
<input name="owner_email" value="<?= htmlspecialchars($vehicle['owner_email'] ?? '') ?>">

</div>

</div>


<!-- ENDEREÇO -->

<div id="endereco" class="tab-content">

<div class="form-grid">

<label>CEP</label>
<input name="cep" value="<?= htmlspecialchars($vehicle['cep'] ?? '') ?>">

<label>Logradouro</label>
<input name="logradouro" value="<?= htmlspecialchars($vehicle['logradouro'] ?? '') ?>">

<label>Número</label>
<input name="numero" value="<?= htmlspecialchars($vehicle['numero'] ?? '') ?>">

<label>Bairro</label>
<input name="bairro" value="<?= htmlspecialchars($vehicle['bairro'] ?? '') ?>">

<label>Cidade</label>
<input name="cidade" value="<?= htmlspecialchars($vehicle['cidade'] ?? '') ?>">

<label>Estado</label>
<input name="estado" value="<?= htmlspecialchars($vehicle['estado'] ?? '') ?>">

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

</style>



<script>

function openTab(tab){

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