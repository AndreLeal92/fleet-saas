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
}

.sidebar a:hover{
background:#2563eb;
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
}

/* MAIN */

.main{
margin-left:230px;
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
}

/* CONTENT */

.content{
padding:30px;
}

/* DASHBOARD */

.dashboard-cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:20px;
border-radius:10px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.card-info h3{
margin:0;
font-size:14px;
color:#6b7280;
}

.card-info p{
font-size:28px;
font-weight:bold;
margin-top:5px;
}

.card-icon{
font-size:32px;
}

/* cores */

.blue{border-left:5px solid #2563eb;}
.green{border-left:5px solid #10b981;}
.orange{border-left:5px solid #f59e0b;}
.purple{border-left:5px solid #8b5cf6;}
.red{border-left:5px solid #ef4444;}

/* charts */

.charts{
display:grid;
grid-template-columns:1fr 1fr;
gap:20px;
}

.chart-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

</style>

</head>

<body>

<?php
$current = $_SERVER['REQUEST_URI'];
?>

<div class="sidebar">

<div class="sidebar-title">
<img src="/assets/images/Neofleet_branco.png" style="width:170px;">
</div>

<a href="/" class="<?= $current=='/'?'active':'' ?>">🏠 Dashboard</a>

<button class="dropdown-btn">🚚 Operação</button>

<div class="dropdown-container"
style="<?= (strpos($current,'/trips')!==false || strpos($current,'/fuel')!==false) ? 'display:block':'' ?>">

<a href="/trips">Viagens</a>
<a href="/fuel">Abastecimentos</a>
<a href="/trip-expenses/create">Despesas</a>

</div>

<button class="dropdown-btn">📊 Relatórios</button>

<div class="dropdown-container"
style="<?= strpos($current,'/trip-report')!==false?'display:block':'' ?>">

<a href="/trip-report">Relatório de Viagens</a>

</div>

<button class="dropdown-btn">📁 Cadastros</button>

<div class="dropdown-container"
style="<?= (strpos($current,'/vehicles')!==false || strpos($current,'/drivers')!==false || strpos($current,'/users')!==false)?'display:block':'' ?>">

<a href="/vehicles">Veículos</a>
<a href="/drivers">Motoristas</a>
<a href="/users">Usuários</a>

</div>

<a href="/logout">🚪 Sair</a>

</div>

<div class="main">

<div class="topbar">

<div style="font-size:20px;">☰</div>

<div>
<?= $_SESSION['user_name'] ?? 'Admin' ?>
</div>

</div>

<div class="content" id="app-content">

<?php require __DIR__ . '/' . $view . '.php'; ?>

</div>

</div>


<script>

/* dropdown */

var dropdown = document.getElementsByClassName("dropdown-btn");

for (var i = 0; i < dropdown.length; i++) {

dropdown[i].addEventListener("click", function() {

var dropdownContent = this.nextElementSibling;

dropdownContent.style.display =
dropdownContent.style.display === "block"
? "none"
: "block";

});

}

/* SPA */

function loadPage(url,push=true){

const container=document.getElementById("app-content");

fetch(url)
.then(res=>res.text())
.then(html=>{

let parser=new DOMParser();
let doc=parser.parseFromString(html,"text/html");
let newContent=doc.querySelector("#app-content");

if(newContent){
container.innerHTML=newContent.innerHTML;
}

if(push){
history.pushState(null,null,url);
}

});

}

document.querySelectorAll(".sidebar a").forEach(link=>{

link.addEventListener("click",function(e){

let url=this.getAttribute("href");

if(url.startsWith("/")){

e.preventDefault();
loadPage(url);

}

});

});

window.addEventListener("popstate",function(){
loadPage(location.pathname,false);
});

</script>

</body>
</html>