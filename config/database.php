<?php

$conn = new mysqli(
    "localhost",
    "root",
    "root123",
    "fleet_saas"
);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}