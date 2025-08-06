<?php
session_start();
$host = "localhost";
$usuario = "root";
$bdsenha = "Q3A3Q7A1Q4A3Q9";
$database = "bd_gerenciamento_tcc";
$port = "3306";

if(isset($_GET['cnpj']) && isset($_GET['senha'])) {
    $cnpj = $_GET['cnpj'];
    $senha_usuario = $_GET['senha'];

    $conexao = new mysqli($host, $usuario, $bdsenha, $database, $port);

    if ($conexao->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
    }

    $query = "SELECT * FROM tb_login WHERE id_login = '$cnpj' AND cd_senha = '$senha_usuario'";
    $resultado = $conexao->query($query);

    if ($resultado->num_rows > 0) {
        $_SESSION['usuario'] = $resultado->fetch_assoc();
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('CNPJ ou senha inválidos.');</script>";
    }

    mysqli_close($conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>Login</title>
</head>
<body class="min-h-screen h-screen flex items-center justify-center bg-[#003042]">
    <div class="size-130 flex flex-col  items-center justify-center bg-[#C27534] rounded-xl shadow-xl shadow-black">
        <div class="flex items-center justify-center mb-10">
            <div class="w-32 h-32 rounded-full bg-[#353535] flex flex-col items-center justify-center">
                <div class="w-12 h-12 rounded-full bg-white"></div>
                <div class="w-20 h-8 bg-white rounded-b-full mt-2"></div>
            </div>
        </div>
        <form class="flex flex-col items-center justify-center gap-2 " action="" method="get">
            <input
                placeholder="CNPJ"
                name="cnpj"
                class="border w-70 h-8.5 bg-[#353535] placeholder-white text-white border-black appearance-none rounded-lg pl-2"
                type="text"
                maxlength="18"
                oninput="this.value = formatCNPJ(this.value)"
            />
            <input placeholder="Senha" name="senha" class="border w-70 h-8.5 bg-[#353535] placeholder-white text-white border-black rounded-lg pl-2" type="password">
            <button class=" rounded-md w-45 h-10 bg-white mt-10 hover:bg-gray-200 cursor-pointer" type="submit">Entrar</button>
        </form>
    </div>
</body>
<script>
function formatCNPJ(value) {
    value = value.replace(/\D/g, '').slice(0, 14);
    return value
        .replace(/^(\d{2})(\d)/, '$1.$2')
        .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
        .replace(/\.(\d{3})(\d)/, '.$1/$2')
        .replace(/(\d{4})(\d)/, '$1-$2');
}
</script>
</html>