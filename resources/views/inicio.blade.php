<!DOCTYPE html>
<html>
<head>
    <title>Bitácora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-4">

<div class="max-w-mdmx-auto">

    <!-- Título -->
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 text-center md:text-left">
        Registro de Ingreso
    </h1>

    <!-- Mensaje -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario -->
    <div class="bg-white shadow-md rounded-lg p-4 md:p-6 mb-6">
        <form method="POST" action="" class="flex flex-col gap-3">
            @csrf

            <input id="cedula" name="cedula" type="text" placeholder="Cédula"
                class="border rounded p-3 w-full focus:ring-2 focus:ring-blue-400">

            <input id="nombre" name="nombre" type="text" placeholder="Nombre"
                class="border rounded p-3 w-full focus:ring-2 focus:ring-blue-400">

            <select id="tipo_usuario" name="tipo_usuario"
                class="border rounded p-3 w-full focus:ring-2 focus:ring-blue-400">
                <option value="">Tipo de usuario</option>
                <option value="bodega">Bodega</option>
                <option value="proveedor">Proveedor</option>
                <option value="visita">Visita</option>
            </select>

            <input name="actividad" type="text" placeholder="Actividad"
                class="border rounded p-3 w-full focus:ring-2 focus:ring-blue-400">

            <button
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded transition">
                Registrar
            </button>
        </form>
    </div>

    <!-- Tabla -->
    <div class="bg-white shadow-md rounded-lg p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-semibold mb-4 text-center md:text-left">
            Historial
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-2">Cédula</th>
                        <th class="p-2">Nombre</th>
                        <th class="p-2">Tipo</th>
                        <th class="p-2">Actividad</th>
                        <th class="p-2">Entrada</th>
                        <th class="p-2">Salida</th>
                    </tr>
                </thead>

               
            </table>
        </div>

    </div>

</div>

</body>
</html>