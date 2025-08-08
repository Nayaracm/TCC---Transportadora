<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>DashBoardt</title>
</head>
<body class="min-h-screen h-screen">
<!-- Wrapper -->
    <div class="flex items-center gap-7 flex-row h-full pt-2.5 pl-8 bg-white">
<!--  Barra a esquerda  -->
        <div class=" flex flex-col w-80 h-[97%] bg-[#003042] rounded-2xl ">
            <header class=" w-full h-30 flex items-center justify-center ">
                <div class="size-20 ">
                    <img class="w-full h-full" src="../assets/img/logo.png" alt="Logo">
                </div>
            </header>
            <aside class="w-full h-190 flex flex-col gap-10 items-center justify-center">
                <button onclick="showTab('encomenda')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Encomenda</button>
                <button onclick="showTab('motorista')" class="w-60 h-10 text-2xl border-b text-white border-amber-300">Motorista</button>
            </aside>
            <footer class="w-full h-32 "></footer>
        </div>
        <main class="h-[97%] w-[80%] flex justify-center items-center  bg-amber-300 rounded-2xl">
            <div id="motorista" class="tab-content w-full h-full flex flex-col align-center items-center bg-red-500">
                <header class="w-full h-[10%] flex flex-row justify-center gap-[70%] items-center  bg-sky-700">
                    <h1 class="text-2xl text-center w-[9rem] border rounded-2xl text-white">Motoristas</h1>
                    <input type="text" class="w-[13rem] h-[2rem] text-lg border rounded-2xl pl-2 text-white border-black">
                </header>
                <div class="w-full h-[83%] flex flex-col bg-black overflow-auto">
                    <div class=" w-[40%] h-10 bg-red-200">

                    </div>
                </div>
                <footer class="w-full flex flex-1 justify-end pr-30 bg-pink-900">
                    <button>Test</button>
                </footer>
            </div>
        </main>
<!--Fim barra a esquerda-->        
    </div>
</body>
<script>
function showTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
    document.getElementById(tabId).classList.remove('hidden');
}
showTab('motorista');
</script>
</html>