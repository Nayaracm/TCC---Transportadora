<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["acao"]) && $_POST["acao"] === "adicionar") {
        // Cadastro de nova encomenda
        $nm_encomenda = $_POST['nm_encomenda'] ?? '';
        $ds_encomenda = $_POST['ds_encomenda'] ?? '';
        $qt_peso_encomenda = $_POST['qt_peso_encomenda'] ?? '';
        $nm_status_encomenda = $_POST['nm_status_encomenda'] ?? '';
        $id_cliente = $_POST['id_cliente'] ?? '';

        if ($nm_encomenda && $qt_peso_encomenda && $nm_status_encomenda && $id_cliente) {
            $sql = "INSERT INTO tb_encomenda (nm_encomenda, ds_encomenda, qt_peso_encomenda, nm_status_encomenda, id_cliente) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            if ($stmt->execute([$nm_encomenda, $ds_encomenda, $qt_peso_encomenda, $nm_status_encomenda, $id_cliente])) {
                echo "Encomenda cadastrada com sucesso!";
            } else {
                $erro = $stmt->errorInfo();
                echo "Erro ao cadastrar encomenda: " . $erro[2];
            }
            $stmt = null;
        } else {
            echo "Preencha todos os campos obrigatórios.";
        }
        exit;
    }

    if (isset($_POST["acao"]) && $_POST["acao"] === "salvar") {
        // Lógica para editar encomenda
        $id_encomenda = $_POST['id_encomenda'] ?? '';
        $nm_encomenda = $_POST['nm_encomenda'] ?? '';
        $ds_encomenda = $_POST['ds_encomenda'] ?? '';
        $qt_peso_encomenda = $_POST['qt_peso_encomenda'] ?? '';
        $nm_status_encomenda = $_POST['nm_status_encomenda'] ?? '';
        $id_cliente = $_POST['id_cliente'] ?? '';

        if ($id_encomenda && $nm_encomenda && $qt_peso_encomenda && $nm_status_encomenda && $id_cliente) {
            $sql = "UPDATE tb_encomenda SET nm_encomenda = ?, ds_encomenda = ?, qt_peso_encomenda = ?, nm_status_encomenda = ?, id_cliente = ? WHERE id_encomenda = ?";
            $stmt = $conexao->prepare($sql);
            if ($stmt->execute([$nm_encomenda, $ds_encomenda, $qt_peso_encomenda, $nm_status_encomenda, $id_cliente, $id_encomenda])) {
                echo "Encomenda alterada com sucesso!";
            } else {
                $erro = $stmt->errorInfo();
                echo "Erro ao alterar encomenda: " . $erro[2];
            }
            $stmt = null;
        } else {
            echo "Preencha todos os campos obrigatórios.";
        }
        exit;
    }

    if (isset($_POST["acao"]) && $_POST["acao"] === "excluir") {
        // Lógica para excluir a encomenda
        $encomenda = $_POST['id_encomenda'];
        $sql = "DELETE FROM tb_encomenda WHERE id_encomenda = ?";
        $stmt = $conexao->prepare($sql);
        if ($stmt->execute([$encomenda])) {
            echo "Encomenda excluída com sucesso.";
        } else {
            $erro = $stmt->errorInfo();
            echo "Erro ao excluir a encomenda: " . $erro[2];
        }
        $stmt = null;
        exit;
    }
}
?>