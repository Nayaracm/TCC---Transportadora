<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($_POST["acao"])  === "salvar") {
        // Lógica para salvar as alterações
        /*$id_encomenda = $_POST['id_encomenda'];
        $nome = $_POST['nome'];
        $cliente = $_POST['cliente'];
        $rua = $_POST['rua'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $descricao = $_POST['descricao'];
        $cep = $_POST['cep'];
        $casa = $_POST['casa'];
        $complemento = $_POST['complemento'];
        $status = $_POST['status'];

        try {
        // Atualiza encomenda
        $sql_encomenda = "UPDATE tb_encomenda 
                          SET nm_encomenda = ?, ds_encomenda = ?, qt_peso_encomenda = ?, nm_status_encomenda = ? 
                          WHERE id_encomenda = ?";
        $stmt = $conn->prepare($sql_encomenda);
        $stmt->bind_param("ssisi", $nome, $descricao, $peso, $status, $id_encomenda);
        $stmt->execute();
        $stmt->close();

        // Atualiza cliente
        $sql_cliente = "UPDATE tb_cliente 
                        SET nm_cliente = ? 
                        WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql_cliente);
        $stmt->bind_param("si", $cliente, $id_cliente);
        $stmt->execute();
        $stmt->close();

        // Atualiza endereço
        $sql_endereco = "UPDATE tb_endereco 
                         SET rua = ?, cidade = ?, estado = ?, cep = ? 
                         WHERE id_endereco = ?";
        $stmt = $conn->prepare($sql_endereco);
        $stmt->bind_param("ssssi", $rua, $cidade, $estado, $cep, $id_endereco);
        $stmt->execute();
        $stmt->close();

        // Se tudo der certo
        $conn->commit();
        echo "Dados atualizados com sucesso!";
        } catch (Exception $e) {
            $conn->rollback();
            echo "Erro ao atualizar dados: " . $e->getMessage();
        }*/
    } elseif (($_POST["acao"])  === "excluir") {
        // Lógica para excluir a encomenda
        $encomenda = $_POST['id_encomenda'];
        $sql = "DELETE FROM tb_encomenda WHERE id_encomenda = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $encomenda);

        if ($stmt->execute()) {
            echo "Encomenda excluída com sucesso.";
        } else {
            echo "Erro ao excluir a encomenda: " . $stmt->error;
        }
        
    }
    exit;
}
?>