<h1>Atrelar Cavalo + Implementos</h1>

<form method="POST" action="/vehicle-combinations/store">

<div class="form-grid">

<label>Cavalo (Trator)</label>
<select name="tractor_id" required>
<option value="">Selecione o cavalo</option>

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= htmlspecialchars($v['plate']) ?> - <?= htmlspecialchars($v['model']) ?>
</option>

<?php endforeach; ?>

</select>

<label>Implemento 1</label>
<select name="trailer_1">
<option value="">Selecione</option>

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= htmlspecialchars($v['plate']) ?> - <?= htmlspecialchars($v['model']) ?>
</option>

<?php endforeach; ?>

</select>



<label>Implemento 2</label>
<select name="dolly">
<option value="">Selecione</option>

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= htmlspecialchars($v['plate']) ?> - <?= htmlspecialchars($v['model']) ?>
</option>

<?php endforeach; ?>

</select>

<label>Implemento 3</label>
<select name="trailer_2">
<option value="">Selecione</option>

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= htmlspecialchars($v['plate']) ?> - <?= htmlspecialchars($v['model']) ?>
</option>

<?php endforeach; ?>

</select>



<label>Implemento 4</label>
<select name="trailer_3">
<option value="">Selecione</option>

<?php foreach($vehicles as $v): ?>

<option value="<?= $v['id'] ?>">
<?= htmlspecialchars($v['plate']) ?> - <?= htmlspecialchars($v['model']) ?>
</option>

<?php endforeach; ?>

</select>

</div>

<br>

<button class="btn">Atrelar Conjunto</button>

</form>


<style>

.form-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
max-width:700px;
}

select{
padding:10px;
border:1px solid #ccc;
border-radius:6px;
}

</style>