<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bitácora</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body class="bg-gray-100 p-3">

    <div class="container">

        <!-- MENSAJES -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded text-center mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded text-center mb-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORMULARIO -->
        <div class="bg-white p-4 rounded shadow mb-4">

            <h2 class="text-lg font-semibold mb-3">Registro de ingreso</h2>

            <form method="POST" action="{{ route('registro') }}">
                @csrf

                <!-- CEDULA + NOMBRE -->
                <div class="form-grid">

                    <div>
                        <input name="cedula" value="{{ old('cedula') }}" placeholder="Cédula" class="input">
                        @error('cedula')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" class="input">
                        @error('nombre')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- ACTIVIDAD -->
                <div>
                    <input name="actividad" value="{{ old('actividad') }}" placeholder="Actividad" class="input">
                    @error('actividad')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TIPO USUARIO -->
                <div class="radio-group mt-2">

                    <label>
                        <input type="radio" name="tipo_usuario" value="interno"
                            {{ old('tipo_usuario') == 'interno' ? 'checked' : '' }}>
                        Interno
                    </label>

                    <label>
                        <input type="radio" name="tipo_usuario" value="externo"
                            {{ old('tipo_usuario') == 'externo' ? 'checked' : '' }}>
                        Externo
                    </label>

                </div>

                @error('tipo_usuario')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <!-- BOTÓN -->
                <button class="btn bg-blue-500 text-white rounded mt-3">
                    Registrar entrada
                </button>

            </form>
        </div>

        <!-- HISTORIAL -->
        <h3 class="text-lg font-semibold mb-2">Historial</h3>

        <!-- 📱 MÓVIL -->
        <div class="mobile-cards">

            @forelse($logs as $log)
                <div class="log-card">

                    <strong>{{ $log->visitante?->nombre }}</strong><br>

                    Cédula: {{ $log->visitante?->cedula }}<br>

                    Tipo: {{ $log->visitante?->tipo_usuario }}<br>

                    Actividad: {{ $log->actividad }}<br>

                    Entrada: {{ $log->hora_entrada }}<br>

                    Salida: {{ $log->hora_salida ?? 'Pendiente' }}<br>

                    <!-- ESTADO -->
                    @if (!$log->hora_salida)
                        <span class="text-green-600 font-semibold">Dentro</span>
                    @else
                        <span class="text-gray-500">Fuera</span>
                    @endif

                    <!-- BOTÓN SALIDA -->
                    @if (!$log->hora_salida && \Carbon\Carbon::parse($log->hora_entrada)->isToday())
                        <form method="POST" action="{{ route('salida', $log->id) }}">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded mt-2">
                                Marcar salida
                            </button>
                        </form>
                    @endif

                </div>

            @empty
                <p>No hay registros</p>
            @endforelse

        </div>

        <!-- 💻 DESKTOP -->
        <div class="table-container">

            <table class="w-full bg-white shadow rounded">

                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Actividad</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                        <tr>

                            <td>{{ $log->visitante?->cedula }}</td>
                            <td>{{ $log->visitante?->nombre }}</td>
                            <td>{{ $log->visitante?->tipo_usuario }}</td>
                            <td>{{ $log->actividad }}</td>
                            <td>{{ $log->hora_entrada }}</td>
                            <td>{{ $log->hora_salida ?? '-' }}</td>

                            <!-- ESTADO -->
                            <td>
                                @if (!$log->hora_salida)
                                    <span class="text-green-600">Dentro</span>
                                @else
                                    <span class="text-gray-500">Fuera</span>
                                @endif
                            </td>

                            <!-- ACCIÓN -->
                            <td>

                                @if (!$log->hora_salida && \Carbon\Carbon::parse($log->hora_entrada)->isToday())
                                    <form method="POST" action="{{ route('salida', $log->id) }}">
                                        @csrf
                                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                                            Salida
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
