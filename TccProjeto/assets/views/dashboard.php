<?php
require_once '../scripts/connection.php';

?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>DashBoardt</title>
</head>

<body class="min-h-screen h-screen">

    <div class="flex items-center gap-7 flex-row h-full pt-2.5 pl-8 bg-white">

        <div class="flex flex-col w-80 h-[97%] bg-[#003042] rounded-2xl ">

            <header class="w-full h-30 flex items-center justify-center">
                <div class="size-20">
                    <img class="w-full h-full" src="../assets/img/logo.png" alt="Logo">
                </div>
            </header>

            <aside class="w-full h-190 flex flex-col gap-10 items-center justify-center">
                <button onclick="showTab('encomenda')"
                    class="w-60 h-10 text-2xl border-b text-white border-amber-300">Encomenda</button>
                <!-- <button onclick="showTab('motorista')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Motorista</button> -->
            </aside>

            <footer class="w-full h-32"></footer>

        </div>
        <main class="h-[97%] w-[80%] flex justify-center items-center rounded-2xl relative">

            <div id="encomenda"
                class="tab-content w-full h-full flex flex-col align-center items-center bg-[#003042] rounded-xl">
                <header class="w-full h-[10%] flex flex-row justify-center gap-[70%] items-center">
                    <h1 class="text-[1.5rem] text-center w-[10%] h-{10%} bg-[#bf6e33]  rounded-2xl text-white">Encomendas
                        </h1>
                        <form action="dashboard.php" method="POST">
                        <input placeholder="Pesquisa" name="pesquisa" type="text"
                            class="w-[208px] h-[32px] text-lg bg-white border rounded-2xl pl-2 text-black border-black">
                        </form>
                    </header>
                </header>

                <div class="w-full h-[83%] flex items-center pt-5.5 gap-4.5 flex-col overflow-auto">
                    <?php
                    $pesquisa = $_POST['pesquisa'] ?? '';
                    if($pesquisa) {
                        $stmt = $conexao->prepare("SELECT * FROM tb_encomenda WHERE cd_cliente LIKE ?");
                        $stmt->execute([$pesquisa . '%']);
                    } else {
                    $stmt = $conexao->prepare("SELECT * FROM tb_encomenda");
                    $stmt->execute();
                    }
                    if($stmt->rowCount()) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="open-edit-modal-button w-[60%] h-40 flex flex-row hover:cursor-pointer bg-white rounded-2xl"
                                data-encomenda="<?php echo $row['nm_encomenda']; ?>"
                                data-id="<?php echo $row['id_encomenda']; ?>" data-cliente-id="<?php echo $row['cd_cliente']; ?>"
                            data-descricao="<?php echo $row['ds_encomenda']; ?>"
                            data-peso="<?php echo $row['qt_peso_encomenda']; ?>"
                            data-status="<?php echo $row['nm_status_encomenda']; ?>"
                            data-imagem="data:image/jpeg;base64,<?= base64_encode($row['imagem']) ?>">>
                            
                            <div class="w-[30%] h-full flex justify-center items-center">
                                <img src="data:image/jpeg;base64,<?= base64_encode($row['imagem']) ?>" class="size-3/4 rounded-2xl" alt="">
                            </div>
                            <div class="w-[50%] h-full flex flex-col items-center justify-center">
                                <h1 class="text-2xl text-center"><?php echo $row['nm_encomenda']; ?></h1>
                                <p class="text-lg text-center"><?php echo $row['ds_encomenda']; ?></p>
                                <p class="text-lg text-center">Peso: <?php echo $row['qt_peso_encomenda']; ?>Kg</p>
                            </div>
                            <div class="w-[20%] h-full flex flex-col items-center pt-5">
                                <label for="status"
                                    class="border text-center text-xl rounded-2xl w-28 bg-[#bf6e33] text-white h-8"><?php echo $row['nm_status_encomenda']; ?></label>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    else {
                        echo "<p class='text-white'>Nenhuma encomenda encontrada.</p>";
                    }
                    ?>
                </div>

                <footer class="w-full flex flex-1 justify-end pr-30 bg-[#003042] rounded-xl">
                    <button id="open-add-modal-button"
                        class="bg-white hover:bg-[#bf6e33] hover:text-white text-black h-10 w-50 text-center rounded">
                        Nova encomenda
                    </button>
                </footer>
            </div>
            <div id="edit-modal"
                class="hidden absolute inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center">
                <form id="edit-form"
                    class="modal-content relative bg-white p-6 border border-gray-400 w-full max-w-4xl rounded-xl shadow-2xl">
                    <span
                        class="close-button-edit absolute top-1 right-1 text-gray-400 hover:text-black text-3xl font-bold cursor-pointer">&times;</span>
                    <div class="flex items-center space-x-6">
                        <div class="w-1/4 h-64 bg-[#202737] rounded-lg flex items-center justify-center p-4">
                            <img id="edit-imagem" src="https://via.placeholder.com/150/bf6e33/FFFFFF?text=Caixas"
                                alt="Ícone de Encomenda" class="w-full h-auto">
                        </div>
                        <div class="w-3/4 flex flex-col space-y-4">
                            <label id="id_encomenda"
                                class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold"></label>
                            <input type="hidden" id="id_encomenda_input" name="id_encomenda">
                            <div class="flex items-center space-x-4">
                                <label for="nm_encomenda" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Nome da Encomenda</label>
                                <input type="text" id="nm_encomenda" name="nm_encomenda"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex flex-col  w-full space-x-4 gap-3">
                                <label for="ds_encomenda" class="bg-[#202737] w-25 text-white px-4 py-2 rounded-full font-semibold">Descrição</label>
                                <textarea id="ds_encomenda" name="ds_encomenda" placeholder="Descrição da Encomenda"
                                    class=" bg-[#bf6e33] text-white w-full h-50 rounded-2xl pl-2 "></textarea>
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="qt_peso_encomenda" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Peso (kg)</label>
                                <input type="number" id="qt_peso_encomenda" name="qt_peso_encomenda"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="nm_status_encomenda" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Status</label>
                                <input type="text" id="nm_status_encomenda" name="nm_status_encomenda"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="id_cliente" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Id do Cliente (cpf ou cnpj)</label>
                                <input type="number" id="id_cliente" name="id_cliente"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex justify-end space-x-4">
                            <button type="submit" id="salvar"
                                class="bg-[#003042] hover:bg-[#bf6e33] text-white font-bold py-2 px-4 rounded">
                                Salvar Alterações
                            </button>
                            <button type="submit" id="excluir"
                                class="bg-[#003042] hover:bg-[#bf6e33] text-white font-bold py-2 px-4 rounded">
                                Excluir Encomenda
                            </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="add-modal"
                class="hidden absolute inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center">
                <form id="add-form"
                    class="modal-content relative bg-white p-6 border border-gray-400 w-full max-w-4xl rounded-xl shadow-2xl">
                    <span
                        class="close-button-add absolute top-1 right-1 text-gray-400 hover:text-black text-3xl font-bold cursor-pointer">&times;</span>
                    <div class="flex items-center space-x-6">
                        <div class="w-1/4 h-64 bg-[#202737] rounded-lg flex items-center justify-center p-4">
                            <input type="file" id="encomenda-image" name="encomenda-image"
                                class="w-full h-auto rounded-lg bg-white text-black">
                        </div>
                        <div class="w-3/4 flex flex-col space-y-4">
                            <div class="flex items-center space-x-4">
                                <label for="nm_encomenda_add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Nome da Encomenda</label>
                                <input type="text" id="nm_encomenda_add" name="nm_encomenda" placeholder="Nome da Encomenda"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex flex-col  w-full space-x-4 gap-3">
                                <label for="ds_encomenda_add" class="bg-[#202737] w-25 text-white px-4 py-2 rounded-full font-semibold">Descrição</label>
                                <textarea id="ds_encomenda_add" name="ds_encomenda" placeholder="Descrição da Encomenda"
                                    class=" bg-[#bf6e33] text-white w-full h-50 rounded-2xl pl-2 "></textarea>
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="qt_peso_encomenda_add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Peso (kg)</label>
                                <input type="number" id="qt_peso_encomenda_add" name="qt_peso_encomenda" placeholder="Peso"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="nm_status_encomenda_add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Status</label>
                                <input type="text" id="nm_status_encomenda_add" name="nm_status_encomenda" placeholder="Status"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="id_cliente_add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">ID Cliente (cpf ou cnpj)</label>
                                <input type="number" id="id_cliente_add" name="id_cliente" placeholder="ID do Cliente"
                                    class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <button type="submit"
                                class="bg-[#003042] hover:bg-[#bf6e33] text-white font-bold py-2 px-4 rounded self-end">
                                Adicionar Encomenda
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
<script>
    // ======================= LÓGICA DAS ABAS =======================
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        document.getElementById(tabId).classList.remove('hidden');
    }
    showTab('encomenda');

    // ======================= LÓGICA DO MODAL DE EDIÇÃO =======================
    const editModal = document.getElementById('edit-modal');
    const openEditModalBtn = document.querySelectorAll('.open-edit-modal-button');
    const closeEditModalBtn = document.querySelector('.close-button-edit');

    function toggleEditModal() {
        editModal.classList.toggle('hidden');
    }
    openEditModalBtn.forEach(btn => {
        btn.addEventListener('click', function () {
            toggleEditModal();
            document.getElementById('id_encomenda').textContent = 'Código de Encomenda: ' + btn.getAttribute('data-id');
            document.getElementById('id_encomenda_input').value = btn.getAttribute('data-id');
            document.getElementById('nm_encomenda').value = btn.getAttribute('data-encomenda');
            document.getElementById('ds_encomenda').value = btn.getAttribute('data-descricao');
            document.getElementById('qt_peso_encomenda').value = btn.getAttribute('data-peso');
            document.getElementById('nm_status_encomenda').value = btn.getAttribute('data-status');
            document.getElementById('id_cliente').value = btn.getAttribute('data-cliente-id');
            document.getElementById('edit-imagem').src = btn.getAttribute('data-imagem');
        });
    });

    closeEditModalBtn.addEventListener('click', toggleEditModal);

    // ======================= LÓGICA DO MODAL DE ADIÇÃO =======================
    const addModal = document.getElementById('add-modal');
    const openAddModalBtn = document.getElementById('open-add-modal-button');
    const closeAddModalBtn = document.querySelector('.close-button-add');

    function toggleAddModal() {
        addModal.classList.toggle('hidden');
        // Limpa os campos do modal de adição
        document.getElementById('nm_encomenda_add').value = '';
        document.getElementById('ds_encomenda_add').value = '';
        document.getElementById('qt_peso_encomenda_add').value = '';
        document.getElementById('nm_status_encomenda_add').value = '';
        document.getElementById('id_cliente_add').value = '';
    }
    // ======================= ENVIO DO FORMULÁRIO DE ADIÇÃO =======================
    document.getElementById('add-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = document.getElementById('add-form');
        const formData = new FormData(form);
        formData.append('acao', 'adicionar');

        if (!confirm("Tem certeza que deseja adicionar esta encomenda?")) {
            return;
        }

        fetch('../scripts/edit_modal.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => {
                console.error("Erro:", error);
                alert("Erro ao adicionar encomenda.");
            });
    });

    openAddModalBtn.addEventListener('click', toggleAddModal);
    closeAddModalBtn.addEventListener('click', toggleAddModal);

    // ======================= LÓGICA GERAL PARA FECHAR O MODAL AO CLICAR FORA =======================
    window.addEventListener('click', (event) => {
        if (event.target === editModal) {
            toggleEditModal();
        }
        if (event.target === addModal) {
            toggleAddModal();
        }
    });

    // ======================= LÓGICA PARA BOTÃO DELETE MANDAR O EDIT_MODAL AGIR =======================
    document.getElementById('salvar').addEventListener('click', function (event) {
        event.preventDefault(); // impede envio do formulário

        const id_encomenda = document.getElementById('id_encomenda_input').value;
        const nm_encomenda = document.getElementById('nm_encomenda').value;
        const ds_encomenda = document.getElementById('ds_encomenda').value;
        const qt_peso_encomenda = document.getElementById('qt_peso_encomenda').value;
        const nm_status_encomenda = document.getElementById('nm_status_encomenda').value;
        const id_cliente = document.getElementById('id_cliente').value;

        if (!confirm("Tem certeza que deseja salvar essas alterações?")) {
            return;
        }

        fetch('../scripts/edit_modal.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'acao=salvar&id_encomenda=' + encodeURIComponent(id_encomenda) +
                '&nm_encomenda=' + encodeURIComponent(nm_encomenda) +
                '&ds_encomenda=' + encodeURIComponent(ds_encomenda) +
                '&qt_peso_encomenda=' + encodeURIComponent(qt_peso_encomenda) +
                '&nm_status_encomenda=' + encodeURIComponent(nm_status_encomenda) +
                '&id_cliente=' + encodeURIComponent(id_cliente)
        })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => {
                console.error("Erro:", error);
                alert("Erro ao salvar encomenda.");
            });
    });

    // ======================= LÓGICA PARA BOTÃO DELETE MANDAR O EDIT_MODAL AGIR =======================
    document.getElementById('excluir').addEventListener('click', function (event) {
        event.preventDefault(); // impede envio do formulário

        const id_encomenda = document.getElementById('id_encomenda_input').value;

        if (!confirm("Tem certeza que deseja excluir esta encomenda?")) {
            return;
        }

        fetch('../scripts/edit_modal.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'acao=excluir&id_encomenda=' + encodeURIComponent(id_encomenda)
        })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => {
                console.error("Erro:", error);
                alert("Erro ao excluir encomenda.");
            });
    });
</script>

</html>