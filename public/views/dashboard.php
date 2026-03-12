<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>NeoFleet Dashboard</title>
</head>

<body>

<h1>Dashboard NeoFleet</h1>

<p>Bem-vindo <?php echo $_SESSION['user']['name']; ?></p>

<a href="/logout">Sair</a>

</body>
</html>