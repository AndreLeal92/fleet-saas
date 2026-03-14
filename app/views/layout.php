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

.sidebar h2{
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

<h2>NeoFleet</h2>

<a href="/">Dashboard</a>
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
