<h1 style="margin-bottom:25px;">Dashboard</h1>

<div class="dashboard-cards">

<div class="card blue">
<div class="card-info">
<h3>Veículos</h3>
<p><?= $vehicles ?? 0 ?></p>
</div>
<div class="card-icon">🚚</div>
</div>

<div class="card green">
<div class="card-info">
<h3>Motoristas</h3>
<p><?= $drivers ?? 0 ?></p>
</div>
<div class="card-icon">👨‍✈️</div>
</div>

<div class="card orange">
<div class="card-info">
<h3>Abastecimentos</h3>
<p><?= $fuel ?? 0 ?></p>
</div>
<div class="card-icon">⛽</div>
</div>

<div class="card purple">
<div class="card-info">
<h3>Viagens</h3>
<p><?= $trips ?? 0 ?></p>
</div>
<div class="card-icon">🛣️</div>
</div>

<div class="card red">
<div class="card-info">
<h3>Despesas</h3>
<p><?= $expenses ?? 0 ?></p>
</div>
<div class="card-icon">💰</div>
</div>

</div>


<div class="charts">

<div class="chart-box">
<h3>Viagens por mês</h3>
<canvas id="tripChart"></canvas>
</div>

<div class="chart-box">
<h3>Despesas</h3>
<canvas id="expenseChart"></canvas>
</div>

</div>


<script>

new Chart(document.getElementById('tripChart'),{
type:'bar',
data:{
labels:['Jan','Fev','Mar','Abr','Mai','Jun'],
datasets:[{
label:'Viagens',
data:[12,19,8,15,10,14]
}]
}
});

new Chart(document.getElementById('expenseChart'),{
type:'doughnut',
data:{
labels:['Combustível','Pedágio','Manutenção'],
datasets:[{
data:[55,25,20]
}]
}
});

</script>