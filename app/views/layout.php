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
}

.sidebar a:hover{
background:#2563eb;
}

/* MENU DROPDOWN */

.menu-item{
padding:15px 20px;
cursor:pointer;
}

.menu-item:hover{
background:#2563eb;
}

.submenu{
display:none;
background:#1f2937;
}

.submenu a{
padding:12px 40px;
font-size:14px;
}

.submenu a:hover{
background:#2563eb;
}

/* MAIN */

.main{
margin-left:230px;
padding:30px;
}

/* CARDS */

.cards{
display:flex;
gap:20px;
}

.card{
background:white;
padding:25px;
border-radius:10px;
width:220px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.card h3{
margin:0;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="sidebar-title">
<img src="/assets/images/Neofleet_branco.png" style="width:190px;">
</div>

<a href="/">Dashboard</a>

<a href="/trip-expenses">Despesas de Viagem</a>

<a href="/trips">Viagens</a>


<!-- VEICULOS -->

<div class="menu-item" onclick="toggleMenu('menuVeiculos')">
Veículos ▾
</div>

<div id="menuVeiculos" class="submenu">
<a href="/vehicles">Lista de Veículos</a>
<a href="/maintenance">Manutenções</a>
</div>


<!-- MOTORISTAS -->

<div class="menu-item" onclick="toggleMenu('menuMotoristas')">
Motoristas ▾
</div>

<div id="menuMotoristas" class="submenu">
<a href="/drivers">Lista de Motoristas</a>
</div>


<!-- ABASTECIMENTOS -->

<a href="/fuel">Abastecimentos</a>


<!-- USUARIOS -->

<div class="menu-item" onclick="toggleMenu('menuUsuarios')">
Usuários ▾
</div>

<div id="menuUsuarios" class="submenu">
<a href="/users">Lista de Usuários</a>
</div>

<a href="/logout">Sair</a>

</div>

<div class="main">

<?php require __DIR__ . '/' . $view . '.php'; ?>

</div>


<script>

function toggleMenu(menuId){

let menu = document.getElementById(menuId);

if(menu.style.display === "block"){
menu.style.display = "none";
}else{
menu.style.display = "block";
}

}

</script>

</body>
</html>
