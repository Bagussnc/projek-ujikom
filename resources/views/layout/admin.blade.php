<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- Add Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Custom Transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        #submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 1s ease-in-out;
        }

        #submenu.open {
            max-height: 500px;
            /* Adjust based on content */
        }

        #submenu-inventaris,
        #submenu-laporan {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        #submenu-inventaris.open,
        #submenu-laporan.open {
            max-height: 500px;
            /* Sesuaikan dengan tinggi konten */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <nav class="bg-indigo-600 w-full md:w-64 text-white flex flex-col h-screen">
            <div class="p-4 text-center text-2xl font-bold border-b border-indigo-500">Inventory System</div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-auto">
            <header class="bg-white shadow p-4 flex items-center justify-end">
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405a2.032 2.032 0 00-.595-1.395L16 12m-6 5l-4-4 1.405-1.405c.367-.367.911-.53 1.395-.595L12 10" />
                        </svg>
                    </button>
                    <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                </div>
            </header>
            @yield('content')
        </div>
    </div>

    <!-- Add Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleSubmenu(submenuId) {
            const allSubmenus = document.querySelectorAll("ul[id^='submenu']");

            // Tutup semua submenu lainnya
            allSubmenus.forEach((submenu) => {
                if (submenu.id !== submenuId) {
                    submenu.classList.remove('open');
                }
            });

            // Toggle submenu yang sesuai tombolnya
            const submenu = document.getElementById(submenuId);
            submenu.classList.toggle('open');
        }
    </script>


    @stack('scripts')

</body>

</html>
