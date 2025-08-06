<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>DashBoardt</title>
</head>
<body class="min-h-screen h-screen">
    <div class="wrapper flex items-center flex-row h-full bg-white">
        <div class="left-side">
            <header class=" w-full h-30 flex items-center justify-center  ">
                <div class="size-20 ">
                    <img class="w-full h-full" src="../assets/img/logo.png" alt="Logo">
                </div>
            </header>
            <div class="w-full h-190 flex flex-col gap-10 items-center justify-center">
                <button onclick="showTab('encomenda')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Encomenda</button>
                <button onclick="showTab('motorista')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Motorista</button>
            </div>
            <footer class="w-full h-32 "></footer>
        </div>
        <div class="w-400 h-252 ml-3 flex items-center justify-center bg-[#003042] rounded-xl shadow-xl">
            <div id="encomenda" class="tab-content w-full">
                <h1 class="text-2xl">Usuários</h1>
            </div>
            <div id="motorista" class="tab-content w-full">
                <h1>Motorista</h1>
            </div>
        </div>
    </div>
</body>
<script>
function showTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
    document.getElementById(tabId).classList.remove('hidden');
}
showTab('usuarios'); // Exibe a primeira aba por padrão
</script>
</html>