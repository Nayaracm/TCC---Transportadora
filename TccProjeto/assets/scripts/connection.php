<?php

$host = "localhost";
$usuario = "root";
$bdsenha = "root";
$database = "bd_gerenciamento_tcc";
$port = "3307";

try {
	$dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8";
	$conexao = new PDO($dsn, $usuario, $bdsenha);
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// Conexão bem-sucedida
} catch (PDOException $e) {
	die("Erro na conexão: " . $e->getMessage());
}

