<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas - Restaurante</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vue.js -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="/" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">Sistema de Reservas</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('reservations.create') }}" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Nueva Reserva</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>