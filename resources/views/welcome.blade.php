<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Sistem Inventaris Aset Tetap</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative overflow-hidden">

    {{-- BACKGROUND FOTO (lebih samar banget) --}}
    <div class="absolute inset-0">
        <img src="/assets/jasamarga-bg.jpg"
             class="w-full h-full object-cover object-center brightness-[0.45] blur-[2.5px]">
    </div>

    {{-- GRADIENT OVERLAY lebih halus --}}
    <div class="absolute inset-0"
        style="
            background: linear-gradient(
                to bottom,
                rgba(15,59,137,0.32) 0%,
                rgba(21,77,166,0.28) 40%,
                rgba(0,91,172,0.28) 100%
            );
        ">
    </div>

    {{-- LOGO --}}
    <div class="absolute top-6 left-8 z-20 flex items-center gap-3">
    <img src="/assets/logo_jasamarga.png" class="h-24 drop-shadow-xl">
</div>


    {{-- MAIN CONTENT --}}
    <div class="relative z-10 h-screen flex items-center justify-center px-6">
        <div class="grid md:grid-cols-2 gap-14 max-w-6xl w-full items-center">

            {{-- TEKS KIRI --}}
            <div class="text-white">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-snug mb-5 text-white">
    <span class="block whitespace-nowrap">Selamat Datang di Sistem</span>
    <span class="block text-[#FFCC00]">Inventaris Aset Tetap</span>
</h1>


                <p class="text-lg leading-relaxed max-w-xl opacity-95">
                    Sistem internal yang dirancang untuk mempermudah proses pencatatan,
                    pengawasan, dan pengelolaan aset tetap secara terpadu guna mendukung
                    keakuratan data dan kelancaran operasional di lingkungan 
                    <span class="font-semibold">
                        Representative Office 2 PT Jasamarga Transjawa Tol Area Palikanci.
                    </span>
                </p>
            </div>

            {{-- CARD LOGIN warna biru --}}
            <div class="rounded-2xl p-12 max-w-md w-full mx-auto shadow-2xl
                        bg-[#154da6ff]/90 border border-white/20 backdrop-blur-xl">
                
                <h2 class="text-3xl font-semibold text-white mb-3 text-center">Akses Sistem</h2>
                <p class="text-white/90 mb-7 leading-relaxed">
                    Silakan masuk untuk mengakses sistem pengelolaan aset tetap lebih lanjut.
                </p>

                <a href="/login"
                   class="block w-full text-center bg-[#FFCC00] hover:bg-[#e6b800] 
                          text-gray-900 font-semibold py-3.5 rounded-xl shadow-lg 
                          transition-all duration-200">
                    Login
                </a>
            </div>

        </div>
    </div>

</body>
</html>
