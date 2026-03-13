<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NeoFleet Dashboard</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#f4f6f9;
}

/* SIDEBAR */

.sidebar{
    width:220px;
    height:100vh;
    background:#111827;
    color:white;
    position:fixed;
}

.sidebar h2{
    text-align:center;
    padding:20px 0;
    border-bottom:1px solid #2c2c2c;
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
    margin-left:220px;
    padding:30px;
}

.cards{
    display:flex;
    gap:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:10px;
    width:200px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="sidebar">

<h2>NeoFleet</h2>

<a href="/users">Usuários</a>
<a href="/">Dashboard</a>
<a href="/vehicles">Veículos</a>
<a href="/drivers">Motoristas</a>
<a href="/fuel">Abastecimentos</a>
<a href="/logout">Sair</a>

</div>

<div class="main">

<h1>Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Veículos</h3>
<p>12</p>
</div>

<div class="card">
<h3>Motoristas</h3>
<p>8</p>
</div>

<div class="card">
<h3>Abastecimentos</h3>
<p>54</p>
</div>

</div>

</div>

</body>
</html>