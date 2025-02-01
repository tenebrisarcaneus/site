<?php
// config.php

// Configuração do Banco de Dados (MySQL)
$host = 'localhost';
$dbname = 'tenebris';
$user = 'root';
$pass = ''; // Altere conforme sua configuração

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}

// Credenciais do Admin (em produção, armazene de forma segura)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'password');
?>
