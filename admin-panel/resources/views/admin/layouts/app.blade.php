<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - NantiKita.</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Warna brand resmi NantiKita. dari Canva */
        .bg-brand-green {
            background-color: #2f3e36;
        }

        .text-brand-green {
            color: #2f3e36;
        }

        .bg-brand-white {
            background-color: #f7f7f7;
        }

        .border-brand-green {
            border-color: #2f3e36;
        }
    </style>
</head>

<body class="bg-brand-white font-sans text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <div id="sidebar"
            class="w-64 bg-brand-green text-white flex flex-col fixed inset-y-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">

            <a href="{{ route('admin.dashboard') }}"
                class="p-5 flex flex-col items-center border-b border-stone-600/50 hover:bg-white/5 transition w-full">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo NantiKita"
                    class="w-20 h-20 object-cover rounded-full shadow-md mb-3 border-2 border-white">
                <div class="text-lg font-bold tracking-wider">ADMIN NANTIKITA.</div>
            </a>

            <nav class="flex-1 p-4 space-y-2 text-sm">
                <a href="{{ route('admin.weddings.index') }}"
                    class="flex items-center space-x-3 p-3 rounded-lg hover:bg-white/10 transition">
                    <span>📋</span> <span>Data Client</span>
                </a>
                <a href="{{ route('admin.weddings.create') }}"
                    class="flex items-center space-x-3 p-3 rounded-lg bg-white/10 hover:bg-white/20 transition font-medium">
                    <span>[+]</span> <span>Tambah Undangan</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 p-3 rounded-lg hover:bg-white/5 transition opacity-50 cursor-not-allowed">
                    <span>🎨</span> <span>Template (Soon)</span>
                </a>
                <span class="text-stone-400">📩 RSVP (Soon)</span>

                <a href="{{ route('admin.rsvps.global') }}"
                    class="flex items-center space-x-3 p-3 rounded-lg hover:bg-white/10 transition">
                    <span>📩</span> <span>Data RSVP Global</span>
                </a>
            </nav>

            <div class="p-4 border-t border-stone-600/50 text-xs text-stone-300 text-center">
                V.1.0 © 2026 NantiKita.
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto min-h-screen md:ml-64 bg-brand-white">

            <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-gray-200">
                <div class="flex items-center space-x-4">
                    <button id="burgerBtn"
                        class="text-gray-700 focus:outline-none hover:text-brand-green p-1 rounded-md md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-700">Manajemen Undangan Digital</h1>
                </div>
                <div class="text-sm font-medium text-brand-green flex items-center space-x-2">
                    <span>Owner NantiKita </span>
                </div>
            </header>

            <main class="p-6 md:p-10 flex-1 bg-brand-white">
                @if (session('success'))
                    <div
                        class="max-w-full mb-4 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="w-full max-w-4xl">
                    @yield('content')
                </div>
            </main>
        </div>

        <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"></div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const burgerBtn = document.getElementById('burgerBtn');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        burgerBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                confirmButtonColor: '#2f3e36'
            });
        </script>
    @endif
</body>

</html>
