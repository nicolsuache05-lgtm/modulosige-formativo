@php
    header("Location: " . route('login', ['redirect' => request('redirect', route('egresados.home'))]));
    exit();
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url={{ route('login', ['redirect' => request('redirect', route('egresados.home'))]) }}">
    <title>Redirigiendo al Login Central ERP...</title>
</head>
<body>
    <p>Redirigiendo al <a href="{{ route('login', ['redirect' => request('redirect', route('egresados.home'))]) }}">Login Central de SENA Empresa ERP</a>...</p>
</body>
</html>
