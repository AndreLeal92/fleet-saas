<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>NeoFleet</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

/* SIDEBAR */

.sidebar{
width:230px;
height:100vh;
background:#111827;
color:white;
position:fixed;
overflow-y:auto;
transition:0.3s;
}

.sidebar-title{
text-align:center;
padding:20px;
border-bottom:1px solid #333;
}

.sidebar a{
display:block;
padding:14px 20px;
color:white;
text-decoration:none;
transition:0.2s;
}

.sidebar a:hover{
background:#2563eb;
padding-left:25px;
}

.sidebar a.active{
background:#2563eb;
font-weight:bold;
}

/* DROPDOWN */

.dropdown-btn{
width:100%;
background:none;
border:none;
color:white;
padding:14px 20px;
text-align:left;
cursor:pointer;
font-size:15px;
}

.dropdown-btn:hover{
background:#2563eb;
}

.dropdown-container{
display:none;
background:#1f2937;
}

.dropdown-container a{
padding-left:40px;
font-size:14px;
}

/* MAIN */

.main{
margin-left:230px;
transition:0.3s;
}

/* TOPBAR */

.topbar{
height:60px;
background:white;
border-bottom:1px solid #ddd;
display:flex;
align-items:center;
justify-content:space-between;
padding:0 20px;
position:sticky;
top:0;
z-index:10;
}

/* CONTENT */

.content{
padding:30px;
}

/* BOTÕES */

.btn{
display:inline-block;
padding:10px 16px;
background:#2563eb;
color:white;
text-decoration:none;
border-radius:6px;
border:none;
cursor:pointer;
}

.btn:hover{
background:#1e4ed8;
}

/* FORMULÁRIOS */

.form-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
background:white;
padding:20px;
border-radius:10px;
margin-bottom:20px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

.form-grid h3{
grid-column:1/3;
margin-bottom:10px;
}

input,select{
padding:10px;
border:1px solid #ddd;
border-radius:6px;
}

/* TABELAS */

.table-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
margin-top:20px;
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
}

table th{
background:#f3f4f6;
padding:12px;
text-align:left;
font-size:14px;
}

table td{
padding:12px;
border-bottom:1px solid #eee;
}

table tr:hover{
background:#f9fafb;
}

/* RESPONSIVO */

@media(max-width:768px){

.sidebar{
left:-230px;
}

.sidebar.active{
left:0;
}

.main{
margin-left:0;
}

}

</style>

</head>

<body>

<?php $current = $_SERVER['REQUEST_URI']; ?>

<div class="sidebar" id="sidebar">

<div class="sidebar-title">
<img src="/assets/images/Neofleet_branco.png" style="width:170px;">
</div>

<a href="/" class="<?= $current=='/'?'active':'' ?>">🏠 Dashboard</a>

<button class="dropdown-btn">🚚 Operação</button>

<div class="dropdown-container"
style="<?= (
strpos($current,'/trips')!==false || 
strpos($current,'/fuel')!==false ||
strpos($current,'/maintenance')!==false ||
strpos($current,'/trip-expenses')!==false
)?'display:block':'' ?>">

<a href="/trips">🛣️ Viagens</a>
<a href="/fuel">⛽ Abastecimentos</a>
<a href="/maintenance">🛠️ Manutenção</a>
<a href="/trip-expenses/create">💰 Despesas</a>

</div>

<button class="dropdown-btn">📊 Relatórios</button>

<div class="dropdown-container"
style="<?= strpos($current,'/trip-report')!==false?'display:block':'' ?>">

<a href="/trip-report">📊 Relatório de Viagens</a>

</div>

<button class="dropdown-btn">📁 Cadastros</button>

<div class="dropdown-container"
style="<?= (
strpos($current,'/vehicles')!==false || 
strpos($current,'/drivers')!==false || 
strpos($current,'/users')!==false ||
strpos($current,'/vehicle-combinations')!==false
)?'display:block':'' ?>">

<a href="/vehicles">🚛 Veículos</a>
<a href="/drivers">👤 Motoristas</a>
<a href="/vehicle-combinations">🔗 Atrelar Cavalo+Carreta</a>
<a href="/users">👥 Usuários</a>
<a href="/maintenance-plans">🧠 Preventivas</a>

</div>

<a href="/logout">🚪 Sair</a>

</div>

<div class="main">

<div class="topbar">

<div onclick="toggleSidebar()" style="cursor:pointer;font-size:20px;">☰</div>

<div>
<?= $_SESSION['user_name'] ?? 'Admin' ?>
</div>

</div>

<div class="content" id="app-content">
<?php require __DIR__ . '/' . $view . '.php'; ?>
</div>

</div>

<script>

// SIDEBAR MOBILE
function toggleSidebar(){
document.getElementById("sidebar").classList.toggle("active");
}

// DROPDOWN
function initDropdown(){
let dropdown=document.getElementsByClassName("dropdown-btn");

for(let i=0;i<dropdown.length;i++){
dropdown[i].onclick=function(){
let content=this.nextElementSibling;
content.style.display = content.style.display==="block"?"none":"block";
}
}
}

// SPA MELHORADO
function loadPage(url,push=true){

fetch(url)
.then(res=>res.text())
.then(html=>{

let parser=new DOMParser();
let doc=parser.parseFromString(html,"text/html");
let newContent=doc.querySelector("#app-content");

if(newContent){
document.getElementById("app-content").innerHTML=newContent.innerHTML;
initDropdown();
}

if(push){
history.pushState(null,null,url);
}

});
}

document.querySelectorAll(".sidebar a").forEach(link=>{
link.addEventListener("click",function(e){

let url=this.getAttribute("href");

if(url === "/logout") return;

if(url.startsWith("/")){
e.preventDefault();
loadPage(url);
}

});
});

window.addEventListener("popstate",()=>{
loadPage(location.pathname,false);
});

document.addEventListener("DOMContentLoaded",()=>{
initDropdown();
});

</script>

</body>
</html>