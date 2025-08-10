<?php
$host = "localhost";
$usuario = "root";
$bdsenha = "Q3A3Q7A1Q4A3Q9";
$database = "bd_gerenciamento_tcc";
$port = "3306";

$conexao = new mysqli($host, $usuario, $bdsenha, $database, $port);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}