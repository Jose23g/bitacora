<!DOCTYPE html>
<html>
<head>
    <title>Bitácora</title>
</head>
<body>

<h1>Registro de Ingreso</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="">
    @csrf

    <input type="text" name="cedula" placeholder="Cédula"><br>
    <input type="text" name="nombre" placeholder="Nombre"><br>

    <select name="tipo_usuario">
        <option value="">Tipo de usuario</option>
        <option value="bodega">Bodega</option>
        <option value="proveedor">Proveedor</option>
        <option value="visita">Visita</option>
    </select><br>

    <input type="text" name="actividad" placeholder="Actividad"><br>

    <button type="submit">Registrar</button>
</form>

<hr>

<h2>Historial</h2>

<table border="1">
    <tr>
        <th>Cédula</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Actividad</th>
        <th>Entrada</th>
        <th>Salida</th>
    </tr>

    
    </tr>
   

</table>

</body>
</html>