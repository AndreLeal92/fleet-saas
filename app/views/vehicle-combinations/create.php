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

<?php for($i=1;$i<=4;$i++): ?>
<label>Implemento <?= $i ?></label>
<select name="trailers[]">
    <option value="">Selecione</option>
    <?php foreach($vehicles as $v): ?>
        <option value="<?= $v['id'] ?>">
            <?= htmlspecialchars($v['plate']) ?> - <?= htmlspecialchars($v['model']) ?>
        </option>
    <?php endforeach; ?>
</select>
<?php endfor; ?>

</div>

<br>

<button type="submit" class="btn">Atrelar Conjunto</button>

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

<script>
document.querySelector("form").addEventListener("submit", function(e){

    const tractor = document.querySelector("[name='tractor_id']").value;
    const trailers = document.querySelectorAll("[name='trailers[]']");

    let selected = [];

    trailers.forEach(t => {
        if(t.value) selected.push(t.value);
    });

    if(selected.length === 0){
        alert("Selecione pelo menos um implemento");
        e.preventDefault();
        return;
    }

    const unique = new Set(selected);
    if(unique.size !== selected.length){
        alert("Implementos duplicados");
        e.preventDefault();
        return;
    }

    if(selected.includes(tractor)){
        alert("O cavalo não pode ser implemento");
        e.preventDefault();
        return;
    }

});
</script>