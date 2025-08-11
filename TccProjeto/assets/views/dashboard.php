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
                <button onclick="showTab('encomenda')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Encomenda</button>
               <!-- <button onclick="showTab('motorista')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Motorista</button> -->
            </aside>
            
            <footer class="w-full h-32"></footer>
            
        </div>
        <main class="h-[97%] w-[80%] flex justify-center items-center bg-amber-300 rounded-2xl relative">
            
            <div id="encomenda" class="tab-content w-full h-full flex flex-col align-center items-center bg-[#003042] rounded-2xl">
                
                <header class="w-full h-[10%] flex flex-row justify-center gap-[70%] items-center">
                    <h1 class="text-2xl text-center w-[10rem] h-[2.5rem] bg-[#bf6e33]  rounded-2xl text-white">Encomendas</h1>
                    <input placeholder="Pesquisa" type="text" class="w-[13rem] h-[2rem] text-lg bg-white border rounded-2xl pl-2 text-black border-black">
                </header>
                
                <div class="w-full h-[83%] flex items-center pt-5.5 gap-4.5 flex-col overflow-auto"
                >
                    <?php
                    $stmt = $conexao->prepare("SELECT * FROM vw_cliente_encomenda");
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    while ($row = $resultado->fetch_assoc()) {
                        ?>
                        
                        <div class="open-edit-modal-button w-[60%] h-40 flex flex-row hover:cursor-pointer bg-white rounded-2xl"
                        data-encomenda="<?php echo $row['nm_encomenda']; ?>"
                        data-id="<?php echo $row['id_encomenda']; ?>"
                        data-cliente="<?php echo $row['nm_cliente']; ?>"
                        data-rua="<?php echo $row['ds_rua']; ?>"
                        data-cidade="<?php echo $row['nm_cidade']; ?>"
                        data-bairro="<?php echo $row['nm_bairro']; ?>"
                        data-descricao="<?php echo $row['ds_encomenda']; ?>"
                        data-cep="<?php echo $row['nr_cep']; ?>"
                        data-casa="<?php echo $row['nr_casa']; ?>"
                        data-complemento="<?php echo $row['ds_complemento']; ?>"
                        data-descricao="<?php echo $row['ds_encomenda']; ?>"
                        data-peso="<?php echo $row['qt_peso_encomenda']; ?>"
                        data-status="<?php echo $row['nm_status_encomenda']; ?>">
                            <div class="w-[30%] h-full flex justify-center items-center">
                                <img src="../imgs/test-img.jpg" class="size-3/4 rounded-2xl" alt="">
                            </div>
                            <div class="w-[50%] h-full flex flex-col items-center justify-center">
                                <h1 class="text-2xl text-center"><?php echo $row['nm_encomenda']; ?></h1>
                                <p class="text-lg text-center"><?php echo $row['ds_encomenda']; ?></p>
                                <p class="text-lg text-center">Peso: <?php echo $row['qt_peso_encomenda']; ?>Kg</p>
                            </div>
                            <div class="w-[20%] h-full flex flex-col items-center pt-5">
                                <label for="status" class="border text-center text-xl rounded-2xl w-28 bg-[#bf6e33] text-white h-8"><?php echo $row['nm_status_encomenda']; ?></label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                
                <footer class="w-full flex flex-1 justify-end pr-30 bg-[#003042]">
                    <button id="open-add-modal-button" class="bg-white hover:bg-[#bf6e33] hover:text-white text-black h-10 w-50 text-center rounded">
                        Nova encomenda
                    </button>
                </footer>
            </div>
            <div id="edit-modal" class="hidden absolute inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center">
                <form id="edit-form" class="modal-content relative bg-white p-6 border border-gray-400 w-full max-w-4xl rounded-xl shadow-2xl">
                    <span class="close-button-edit absolute top-4 right-4 text-gray-400 hover:text-black text-3xl font-bold cursor-pointer">&times;</span>
                    <div class="flex items-center space-x-6">
                        <div class="w-1/4 h-64 bg-[#202737] rounded-lg flex items-center justify-center p-4">
                            <img src="https://via.placeholder.com/150/bf6e33/FFFFFF?text=Caixas" alt="Ícone de Encomenda" class="w-full h-auto">
                        </div>
                        <div class="w-3/4 flex flex-col space-y-4">
                            <label id="id_encomenda" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold"></label>
                            <input type="hidden" id="id_encomenda_input" name="id_encomenda">
                            <div class="flex items-center space-x-4">
                                <label for="encomenda-nome" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Nome</label>
                                <input type="text" id="encomenda-nome" name="nome" value="Encomenda 2" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="cliente-nome" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Cliente</label>
                                <input type="text" id="cliente-nome" name="cliente" value="Fulano 1" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="grid grid-cols-2 grid-rows-2 gap-2 space-x-4">
                                <label for="endereco" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Enredeço</label>
                                <input type="text" id="cliente-street-name" name="street-name" placeholder="Nome da Rua" value="" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="number" id="cliente-street-number" name="street-number" placeholder="Numero da Residencia" value="" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="street-complement" name="street-compelment" placeholder="Complemento" value="" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="cliente-neighborhood" name="street-compelment" placeholder="Bairro" value="" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="city" name="city" placeholder="Cidade" value="" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="cep" name="cep" placeholder="Cep" value="" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex flex-col  w-full space-x-4 gap-3">
                                <label for="descricao" class="bg-[#202737] w-25 text-white px-4 py-2 rounded-full font-semibold">Descrição</label>
                                <textarea id="description-encomenda" name="description" placeholder="Descrição da Encomenda" class=" bg-[#bf6e33] text-white w-full h-50 rounded-2xl pl-2 "></textarea>
                            </div>
                            <button type="submit" id="salvar" class="bg-[#003042] hover:bg-[#bf6e33] text-white font-bold py-2 px-4 rounded self-end">
                                Salvar Alterações
                            </button>
                            <button type="submit" id="excluir" class="bg-[#003042] hover:bg-[#bf6e33] fixed bottom-[12.93rem] right-224 text-white font-bold py-2 px-4 rounded self-end">
                                Excluir Encomenda
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="add-modal" class="hidden absolute inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center">
                <form id="add-form" class="modal-content relative bg-white p-6 border border-gray-400 w-full max-w-4xl rounded-xl shadow-2xl">
                    <span class="close-button-add absolute top-4 right-4 text-gray-400 hover:text-black text-3xl font-bold cursor-pointer">&times;</span>
                    <div class="flex items-center space-x-6">
                        <div class="w-1/4 h-64 bg-[#202737] rounded-lg flex items-center justify-center p-4">
                            <input type="file" id="encomenda-image" name="encomenda-image" class="w-full h-auto rounded-lg bg-white text-black">
                        </div>
                        <div class="w-3/4 flex flex-col space-y-4">
                            <div class="flex items-center space-x-4">
                                <label for="encomenda-nome-add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Nome</label>
                                <input type="text" id="encomenda-nome-add" name="nome" placeholder="Nome da Encomenda" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="cliente-nome-add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Cliente</label>
                                <input type="text" id="cliente-nome-add" name="cliente" placeholder="Nome do Cliente" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="grid grid-cols-2 grid-rows-2 gap-2 space-x-4">
                                <label for="endereco-add" class="bg-[#202737] text-white px-4 py-2 rounded-full font-semibold">Cliente</label>
                                <input type="text" id="street-name-add" name="street-new" placeholder="Nome da Rua" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="street-number-add" name="street-number-new" placeholder="Numero da Rua" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="complement-add" name="complement-new" placeholder="Complemento" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="neighborhood-add" name="neighborhood-new" placeholder="Bairro" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="city-add" name="city-new" placeholder="Cidade" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <input type="text" id="cep-add" name="cep-new" placeholder="CEP" class="bg-[#bf6e33] text-white px-4 py-2 rounded-full font-semibold flex-grow focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="flex flex-col  w-full space-x-4 gap-3">
                                <label for="cliente-nome" class="bg-[#202737] w-25 text-white px-4 py-2 rounded-full font-semibold">Descrição</label>
                                <textarea name="" id="" class=" bg-[#bf6e33] text-white w-full h-50 rounded-2xl pl-2 "></textarea>
                            </div>
                            <button type="submit" class="bg-[#003042] hover:bg-[#bf6e33] text-white font-bold py-2 px-4 rounded self-end">
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
    btn.addEventListener('click', function() {
        toggleEditModal();
        document.getElementById('encomenda-nome').value = btn.getAttribute('data-encomenda');
        document.getElementById('cliente-nome').value = btn.getAttribute('data-cliente');
        document.getElementById('cliente-street-name').value = btn.getAttribute('data-rua');
        document.getElementById('cliente-street-number').value = btn.getAttribute('data-casa');
        document.getElementById('street-complement').value = btn.getAttribute('data-complemento');
        document.getElementById('cliente-neighborhood').value = btn.getAttribute('data-bairro');
        document.getElementById('description-encomenda').value = btn.getAttribute('data-descricao');
        document.getElementById('city').value = btn.getAttribute('data-cidade');
        document.getElementById('id_encomenda').textContent = 'Codigo de Encomenda: ' + btn.getAttribute('data-id');
        document.getElementById('id_encomenda_input').value = btn.getAttribute('data-id');
        document.getElementById('cep').value = btn.getAttribute('data-cep');
        // Adicione outros campos conforme necessário

    });
});

closeEditModalBtn.addEventListener('click', toggleEditModal);

// ======================= LÓGICA DO MODAL DE ADIÇÃO =======================
const addModal = document.getElementById('add-modal');
const openAddModalBtn = document.getElementById('open-add-modal-button');
const closeAddModalBtn = document.querySelector('.close-button-add');

function toggleAddModal() {
    addModal.classList.toggle('hidden');
}

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
document.getElementById('salvar').addEventListener('click', function(event) {
    event.preventDefault(); // impede envio do formulário

    const id_encomenda = document.getElementById('id_encomenda_input').value;
    const nome = document.getElementById('encomenda-nome').value;
    const cliente = document.getElementById('cliente-nome').value;
    const rua = document.getElementById('cliente-street-name').value;
    const cidade = document.getElementById('city').value;
    const bairro = document.getElementById('cliente-neighborhood').value;
    const descricao = document.getElementById('description-encomenda').value;
    const cep = document.getElementById('cep').value;
    const casa = document.getElementById('cliente-street-number').value;
    const complemento = document.getElementById('street-complement').value;
    const status = document.getElementById('status').value;

    if (!confirm("Tem certeza que deseja salvar essas alterações?")) {
        return;
    }

    fetch('../scripts/edit_modal.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'acao=salvar&id_encomenda=' + encodeURIComponent(id_encomenda) + 
        '&nome=' + encodeURIComponent(nome) + 
        '&cliente=' + encodeURIComponent(cliente) + 
        '&rua=' + encodeURIComponent(rua) + 
        '&cidade=' + encodeURIComponent(cidade) + 
        '&bairro=' + encodeURIComponent(bairro) + 
        '&descricao=' + encodeURIComponent(descricao) + 
        '&cep=' + encodeURIComponent(cep) + 
        '&casa=' + encodeURIComponent(casa) + 
        '&complemento=' + encodeURIComponent(complemento) + 
        '&status=' + encodeURIComponent(status)
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
document.getElementById('excluir').addEventListener('click', function(event) {
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