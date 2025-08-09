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
                
                <div class="w-full h-[83%] flex items-center pt-5.5 gap-4.5 flex-col overflow-auto">
                    
                    <div id="open-edit-modal-button" class="w-[60%] h-40 flex flex-row hover:cursor-pointer bg-white rounded-2xl">
                        <div class="w-[30%] h-full flex justify-center items-center">
                            <img src="../imgs/test-img.jpg" class="size-3/4 rounded-2xl" alt="">
                        </div>
                        <div class="w-[50%] h-full flex flex-col items-center justify-center">
                            <h1 class="text-2xl text-center">Nome da Encomenda</h1>
                            <p class="text-lg text-center">Descrição da Encomenda</p>
                            <p class="text-lg text-center">Peso: 100,00Kg</p>
                        </div>
                        <div class="w-[20%] h-full flex flex-col items-center pt-5">
                            <label for="status" class="border text-center text-xl rounded-2xl w-28 bg-[#bf6e33] text-white h-8">Status?</label>
                        </div>
                    </div>
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
                                <textarea id="description-" name="description" placeholder="Descrição da Encomenda" id="" class=" bg-[#bf6e33] text-white w-full h-50 rounded-2xl pl-2 "></textarea>
                            </div>
                            <button type="submit" class="bg-[#003042] hover:bg-[#bf6e33] text-white font-bold py-2 px-4 rounded self-end">
                                Salvar Alterações
                            </button>
                            <button type="submit" class="bg-[#003042] hover:bg-[#bf6e33] fixed bottom-[12.93rem] right-224 text-white font-bold py-2 px-4 rounded self-end">
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
const openEditModalBtn = document.getElementById('open-edit-modal-button');
const closeEditModalBtn = document.querySelector('.close-button-edit');

function toggleEditModal() {
    editModal.classList.toggle('hidden');
}

openEditModalBtn.addEventListener('click', toggleEditModal);
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
</script>
</html>