<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>NeoFleet</title>

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
transition:width .2s;
overflow:hidden;
}

.sidebar.collapsed{
width:70px;
}

.sidebar-title{
text-align:center;
padding:20px;
border-bottom:1px solid #333;
}

.sidebar a{
display:block;
padding:15px 20px;
color:white;
text-decoration:none;
white-space:nowrap;
}

.sidebar a:hover{
background:#2563eb;
}

.sidebar a.active{
background:#2563eb;
font-weight:bold;
}

/* MAIN */

.main{
margin-left:230px;
padding:30px;
transition:margin-left .2s;
}

.sidebar.collapsed + .main{
margin-left:70px;
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

.toggle-btn{
cursor:pointer;
font-size:20px;
}

/* LOADER */

.loader{
position:fixed;
top:0;
left:0;
width:100%;
height:3px;
background:#2563eb;
transform:scaleX(0);
transform-origin:left;
transition:transform .3s;
}

.loader.active{
transform:scaleX(1);
}

/* CARDS */

.cards{
display:flex;
gap:20px;
flex-wrap:wrap;
margin-top:20px;
}

.card{
background:white;
padding:25px;
border-radius:10px;
width:200px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.card h3{
margin:0;
font-size:16px;
color:#374151;
}

.card p{
font-size:28px;
font-weight:bold;
margin-top:10px;
}

</style>

</head>

<body>

<div class="loader" id="loader"></div>

<?php
$current = $_SERVER['REQUEST_URI'];
?>

<div class="sidebar" id="sidebar">

<div class="sidebar-title">
<img src="/assets/images/Neofleet_branco.png" style="width:150px;">
</div>

<a href="/" class="<?= $current == '/' ? 'active' : '' ?>">🏠 Dashboard</a>

<a href="/trips" class="<?= strpos($current,'/trips')!==false ? 'active' : '' ?>">🚚 Viagens</a>

<a href="/fuel" class="<?= strpos($current,'/fuel')!==false ? 'active' : '' ?>">⛽ Abastecimentos</a>

<a href="/trip-expenses/create" class="<?= strpos($current,'/trip-expenses')!==false ? 'active' : '' ?>">💰 Despesas</a>

<a href="/trip-report" class="<?= strpos($current,'/trip-report')!==false ? 'active' : '' ?>">📊 Relatório</a>

<a href="/vehicles" class="<?= strpos($current,'/vehicles')!==false ? 'active' : '' ?>">🚛 Veículos</a>

<a href="/drivers" class="<?= strpos($current,'/drivers')!==false ? 'active' : '' ?>">👨‍✈️ Motoristas</a>

<a href="/users" class="<?= strpos($current,'/users')!==false ? 'active' : '' ?>">👥 Usuários</a>

<a href="/logout">🚪 Sair</a>

</div>


<div class="main">

<div class="topbar">

<div class="toggle-btn" onclick="toggleSidebar()">
☰
</div>

<div>
<?php echo $_SESSION['user_name'] ?? 'Usuário'; ?>
</div>

</div>

<div id="app-content">

<?php require __DIR__ . '/' . $view . '.php'; ?>

</div>

</div>


<script>

/* SIDEBAR */

function toggleSidebar(){
document.getElementById("sidebar").classList.toggle("collapsed");
}


/* SPA NAV */

function loadPage(url, push=true){

const container = document.getElementById("app-content");
const loader = document.getElementById("loader");

loader.classList.add("active");

fetch(url)
.then(res => res.text())
.then(html => {

let parser = new DOMParser();
let doc = parser.parseFromString(html,"text/html");

let newContent = doc.querySelector("#app-content");

if(newContent){
container.innerHTML = newContent.innerHTML;
}

if(push){
history.pushState(null,null,url);
}

loader.classList.remove("active");

});

}

document.querySelectorAll(".sidebar a").forEach(link => {

link.addEventListener("click", function(e){

let url = this.getAttribute("href");

if(url.startsWith("/")){

e.preventDefault();
loadPage(url);

}

});

});

window.addEventListener("popstate", function(){
loadPage(location.pathname,false);
});

</script>

</body>
</html>