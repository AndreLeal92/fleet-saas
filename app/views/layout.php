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

/* MAIN */

.main{
margin-left:230px;
padding:30px;
}

/* BOTÕES */

.btn{
display:inline-block;
padding:10px 18px;
background:#2563eb;
color:white;
text-decoration:none;
border-radius:6px;
font-weight:500;
margin-bottom:20px;
}

.btn:hover{
background:#1d4ed8;
}

/* DASHBOARD CARDS */

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

<div class="sidebar">

<div class="sidebar-title">
<img src="/assets/images/Neofleet_branco.png" style="width:190px;">
</div>

<a href="/">Dashboard</a>
<a href="/trip-expenses">Despesas de Viagem</a>
<a href="/trips">Viagens</a>
<a href="/vehicles">Veículos</a>
<a href="/drivers">Motoristas</a>
<a href="/fuel">Abastecimentos</a>
<a href="/users">Usuários</a>
<a href="/logout">Sair</a>

</div>

<div class="main">

<?php require __DIR__ . '/' . $view . '.php'; ?>

</div>

</body>
</html>