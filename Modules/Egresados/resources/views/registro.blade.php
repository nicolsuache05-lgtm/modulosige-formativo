<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Registro Exclusivo de Egresados — SENA CEFA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Poppins & Nunito (Tipografía Oficial SENA ERP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        senaGreen: '#39A900',
                        senaGreenDark: '#2a7c00',
                        senaNeon: '#62E31D',
                        senaNavy: '#001A29',
                        senaNavyLight: '#002336',
                        senaDark: '#00131E',
                        senaLight: '#F4F7F6',
                    },
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F4F7F6;
            color: #00131E;
        }
        h1, h2, h3, h4, h5, h6, .font-poppins {
            font-family: 'Poppins', sans-serif !important;
        }
        
        .step-badge {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 12px;
            flex-shrink: 0;
        }

        .form-input-compact {
            width: 100%;
            background-color: #F8FAFC;
            border: 1px solid #CBD5E1;
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 13px;
            color: #00131E;
            transition: all 0.2s ease;
        }
        .form-input-compact:focus {
            background-color: #FFFFFF;
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.16);
            outline: none;
        }

        .form-label-compact {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #334155;
            margin-bottom: 4px;
        }

        .glow-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#F4F7F6] font-sans antialiased text-[#00131E] min-h-screen flex flex-col justify-between selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. HEADER INSTITUCIONAL SENA ERP -->
    <!-- ============================================== -->
    <header class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#00131E] text-white border-b-[3px] border-[#39A900] shadow-lg sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-2.5 flex justify-between items-center">
            
            <!-- Brand -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-2.5 text-white no-underline group font-poppins">
                <div class="w-9 h-9 rounded-full overflow-hidden shadow-md border-2 border-white/80 flex items-center justify-center bg-[#39A900] shrink-0 group-hover:scale-105 transition">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover">
                </div>
                <div>
                    <span class="text-xl font-black tracking-wider leading-none text-white font-poppins">SIGE</span>
                    <p class="text-[10px] text-[#62E31D] font-bold font-sans">Centro de Formación Agroindustrial</p>
                </div>
            </a>

            <!-- Right Actions -->
            <div class="flex items-center space-x-2 font-poppins">
                <a href="{{ route('egresados.welcome') }}" class="text-xs text-gray-300 hover:text-white flex items-center space-x-1 transition px-3 py-1.5 rounded-lg hover:bg-white/10">
                    <i class="fa-solid fa-arrow-left text-[11px]"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
                <a href="{{ route('login', ['redirect' => route('egresados.dashboard_egresado')]) }}" class="bg-[#002336] hover:bg-[#00324D] border border-white/20 hover:border-[#62E31D] text-white text-xs font-bold px-3.5 py-1.5 rounded-full transition flex items-center space-x-1.5">
                    <i class="fa-regular fa-user text-xs text-[#62E31D]"></i>
                    <span>¿Ya tienes cuenta? Ingresar</span>
                </a>
            </div>

        </div>
    </header>

    <!-- ============================================== -->
    <!-- 2. CONTENIDO PRINCIPAL: FORMULARIO COMPACTO ERP -->
    <!-- ============================================== -->
    <main class="flex-grow py-6 sm:py-8 px-4 sm:px-6 relative overflow-hidden">
        
        <!-- Ambient ERP glow circles -->
        <div class="glow-circle w-72 h-72 bg-[#39A900]/15 -top-10 -left-10"></div>
        <div class="glow-circle w-80 h-80 bg-[#62E31D]/15 -bottom-10 -right-10"></div>

                @if(session('registro_exitoso'))
            <!-- ============================================== -->
            <!-- PANTALLA / ANUNCIO DE SOLICITUD EN REVISIÓN    -->
            <!-- ============================================== -->
            <div class="max-w-[580px] mx-auto bg-white rounded-3xl shadow-2xl border border-amber-100 overflow-hidden text-center relative z-10 transform transition-all animate-fade-in my-4">
                
                <!-- Barra superior degradada institucional SENA ERP & Alerta Ámbar -->
                <div class="h-2.5 bg-gradient-to-r from-[#00131E] via-[#D97706] to-[#39A900]"></div>
                
                <div class="p-6 sm:p-9">
                    <!-- Icono Animado con Anillos de Resplandor Institucional de Validación -->
                    <div class="relative w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full bg-[#D97706]/20 animate-ping opacity-60" style="animation-duration: 2.2s;"></div>
                        <div class="absolute inset-1 rounded-full bg-[#FEF3C7] border border-[#D97706]/30"></div>
                        <div class="relative w-14 h-14 rounded-2xl bg-gradient-to-br from-[#D97706] to-[#B45309] text-white flex items-center justify-center shadow-lg shadow-[#D97706]/35 transform hover:scale-105 transition-transform">
                            <i class="fa-solid fa-user-clock text-2xl text-white"></i>
                        </div>
                    </div>

                    <!-- Píldora de estado de revisión -->
                    <div class="inline-flex items-center space-x-1.5 px-3.5 py-1 rounded-full bg-[#FEF3C7] border border-[#D97706]/30 text-[#92400E] text-xs font-bold mb-3 shadow-sm">
                        <i class="fa-solid fa-hourglass-half text-[#D97706] animate-pulse"></i>
                        <span>Solicitud en Proceso de Revisión Institucional</span>
                    </div>

                    <!-- Título principal -->
                    <h1 class="font-poppins text-2xl sm:text-3xl font-black text-[#00131E] tracking-tight mb-2">
                        ¡Solicitud Recibida con Éxito!
                    </h1>

                    <p class="text-gray-600 text-xs sm:text-sm font-medium mb-6 leading-relaxed">
                        Hola, <strong class="text-[#00131E]">{{ session('registrado_nombre') }}</strong>. Tus datos han sido recibidos en el sistema del <strong class="text-[#166534]">Centro de Formación Agroindustrial La Angostura</strong> y se encuentran en proceso de revisión de datos académicos.
                    </p>

                    <!-- Resumen de datos registrados -->
                    <div class="bg-gradient-to-br from-[#F8FAFC] to-[#F1F5F9] border border-gray-200/80 rounded-2xl p-4 sm:p-5 text-left mb-6 shadow-inner space-y-2.5 text-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-gray-200/60">
                            <span class="text-gray-500 font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-id-card text-gray-400"></i> Número de Identificación:
                            </span>
                            <span class="font-bold text-[#00131E] font-mono text-xs sm:text-sm">{{ session('registrado_doc') }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-gray-200/60">
                            <span class="text-gray-500 font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-envelope text-gray-400"></i> Correo Electrónico:
                            </span>
                            <span class="font-bold text-[#00131E] truncate max-w-[210px]">{{ session('registrado_email') }}</span>
                        </div>
                        @if(session('registrado_programa'))
                        <div class="flex items-center justify-between pb-2 border-b border-gray-200/60">
                            <span class="text-gray-500 font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-graduation-cap text-gray-400"></i> Programa de Formación:
                            </span>
                            <span class="font-bold text-[#00131E] truncate max-w-[210px]">{{ session('registrado_programa') }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-[#D97706]"></i> Estado de Acceso:
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#FEF3C7] text-[#92400E] font-extrabold text-[11px] border border-[#D97706]/30">
                                <span class="w-2 h-2 rounded-full bg-[#D97706] animate-pulse"></span>
                                Pendiente de Aprobación
                            </span>
                        </div>
                    </div>

                    <!-- Mensaje institucional explicativo -->
                    <div class="bg-[#FFFBEB] border border-[#D97706]/35 rounded-2xl p-4 text-[12px] text-[#92400E] mb-6 flex items-start space-x-3 text-left shadow-sm">
                        <div class="w-8 h-8 rounded-xl bg-[#FEF3C7] text-[#D97706] flex items-center justify-center flex-shrink-0 mt-0.5 font-bold shadow-inner">
                            <i class="fa-solid fa-user-shield text-base"></i>
                        </div>
                        <div class="space-y-1">
                            <strong class="block font-poppins text-xs text-[#78350F]">Validación Académica por Coordinación e Instructores</strong>
                            <p class="leading-relaxed text-gray-700">
                                Por políticas de seguridad institucional, la coordinación académica y los instructores de seguimiento del CEFA La Angostura revisarán tus datos antes de habilitar tu acceso al portal. Te notificaremos en cuanto tu cuenta sea validada y aprobada.
                            </p>
                        </div>
                    </div>

                    <!-- Botones de Acción SENA ERP -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('egresados.welcome') }}" class="w-full sm:w-auto bg-gradient-to-r from-[#001A29] to-[#002b44] hover:from-[#002b44] hover:to-[#001A29] text-white font-extrabold px-6 py-2.5 rounded-xl shadow-md transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2 text-xs sm:text-sm font-poppins">
                            <i class="fa-solid fa-house text-xs text-[#62E31D]"></i>
                            <span>Volver al Inicio del Portal</span>
                        </a>

                        <a href="{{ route('egresados.registro') }}" class="w-full sm:w-auto bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2.5 rounded-xl shadow-sm transition flex items-center justify-center space-x-2 text-xs sm:text-sm font-poppins">
                            <i class="fa-solid fa-user-plus text-xs text-gray-500"></i>
                            <span>Registrar a otro egresado</span>
                        </a>
                    </div>

                </div>
            </div>
        @else
<div class="max-w-[720px] mx-auto relative z-10">
            
            <!-- Encabezado del Formulario (Compacto y Elegante) -->
            <div class="text-center mb-5">
                <h1 class="font-poppins text-2xl sm:text-3xl font-black text-[#00131E] tracking-tight">
                    Registro de Egresado(a)
                </h1>
                <p class="text-gray-600 text-xs sm:text-sm max-w-lg mx-auto mt-1 font-medium">
                    Completa tus datos para registrar tu solicitud de cuenta de egresado(a) del CEFA y acceder a noticias, eventos y encuestas institucionales.
                </p>
            </div>

            <!-- Alertas de Validación / Sesión -->
            @if(session('error'))
                <div class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start space-x-2.5 shadow-sm text-xs">
                    <i class="fa-solid fa-circle-exclamation text-red-500 text-base mt-0.5"></i>
                    <div>
                        <strong class="font-bold">Atención:</strong> {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="mb-4 p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 shadow-sm text-xs">
                    <div class="flex items-center space-x-2 font-bold mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-amber-500 text-base"></i>
                        <span>Por favor corrige los siguientes campos:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-amber-900 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tarjeta Principal del Formulario (Colores y Proporciones ERP) -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200/80 overflow-hidden">
                
                <!-- Barra superior de diseño ERP -->
                <div class="h-2 bg-gradient-to-r from-[#001A29] via-[#39A900] to-[#62E31D]"></div>

                <form action="{{ route('egresados.registro.post') }}" method="POST" class="p-5 sm:p-7 space-y-5" id="registroEgresadoForm">
                    @csrf

                    <!-- ------------------------------------------------------------- -->
                    <!-- SECCIÓN 1: DATOS PERSONALES Y DOCUMENTO DE IDENTIDAD -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2.5 pb-2 border-b border-gray-100">
                            <span class="step-badge bg-[#001A29] text-[#62E31D] border border-[#62E31D]/30">1</span>
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-[#00131E] leading-tight font-poppins">Identificación y Datos Personales</h3>
                                <p class="text-[11px] text-gray-500">Información básica del aprendiz egresado</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                            
                            <!-- Tipo de Documento -->
                            <div class="sm:col-span-5">
                                <label for="document_type" class="form-label-compact">
                                    Tipo de Documento <span class="text-red-500">*</span>
                                </label>
                                <select id="document_type" name="document_type" required class="form-input-compact">
                                    <option value="Cédula de ciudadanía" {{ old('document_type') == 'Cédula de ciudadanía' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                                    <option value="Tarjeta de identidad" {{ old('document_type') == 'Tarjeta de identidad' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                                    <option value="Cédula de extranjería" {{ old('document_type') == 'Cédula de extranjería' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
                                    <option value="Permiso de Protección Temporal" {{ old('document_type') == 'Permiso de Protección Temporal' || old('document_type') == 'Permiso Especial de Permanencia' ? 'selected' : '' }}>Permiso de Protección Temporal (PPT)</option>
                                    <option value="Pasaporte" {{ old('document_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                </select>
                            </div>

                            <!-- Número de Documento -->
                            <div class="sm:col-span-7">
                                <label for="document_number" class="form-label-compact">
                                    Número de Documento <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="document_number" name="document_number" value="{{ old('document_number') }}" required placeholder="Ej: 1075284910" class="form-input-compact pl-9">
                                    <i class="fa-solid fa-id-card absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Nombres -->
                            <div class="sm:col-span-4">
                                <label for="first_name" class="form-label-compact">
                                    Nombres <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="Ej: Juan Carlos" class="form-input-compact">
                            </div>

                            <!-- Primer Apellido -->
                            <div class="sm:col-span-4">
                                <label for="first_last_name" class="form-label-compact">
                                    Primer Apellido <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="first_last_name" name="first_last_name" value="{{ old('first_last_name') }}" required placeholder="Ej: Gómez" class="form-input-compact">
                            </div>

                            <!-- Segundo Apellido -->
                            <div class="sm:col-span-4">
                                <label for="second_last_name" class="form-label-compact">
                                    Segundo Apellido <span class="text-gray-400 font-normal lowercase">(opcional)</span>
                                </label>
                                <input type="text" id="second_last_name" name="second_last_name" value="{{ old('second_last_name') }}" placeholder="Ej: Pérez" class="form-input-compact">
                            </div>

                            <!-- Teléfono Celular -->
                            <div class="sm:col-span-6">
                                <label for="telephone1" class="form-label-compact">
                                    Teléfono / Celular <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="tel" id="telephone1" name="telephone1" value="{{ old('telephone1') }}" required placeholder="Ej: 3124567890" class="form-input-compact pl-9">
                                    <i class="fa-solid fa-phone absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Género -->
                            <div class="sm:col-span-6">
                                <label for="gender" class="form-label-compact">
                                    Género <span class="text-gray-400 font-normal lowercase">(opcional)</span>
                                </label>
                                <select id="gender" name="gender" class="form-input-compact">
                                    <option value="">Seleccione una opción</option>
                                    <option value="femenino" {{ old('gender') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="masculino" {{ old('gender') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="otro" {{ old('gender') == 'otro' ? 'selected' : '' }}>Otro / Prefiero no decir</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <!-- SECCIÓN 2: FORMACIÓN ACADÉMICA SENA / CEFA -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="space-y-3 pt-1">
                        <div class="flex items-center space-x-2.5 pb-2 border-b border-gray-100">
                            <span class="step-badge bg-[#39A900] text-white">2</span>
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-[#00131E] leading-tight font-poppins">Programa y Formación en el CEFA</h3>
                                <p class="text-[11px] text-gray-500">Selecciona el programa del cual egresaste en La Angostura</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                            
                            <!-- Programa / Ficha de Formación -->
                            <div class="sm:col-span-8">
                                <label for="course_id" class="form-label-compact">
                                    Programa de Formación / Ficha <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="course_id" name="course_id" required class="form-input-compact pl-9">
                                        <option value="">-- Selecciona tu programa / ficha --</option>
                                        @if(isset($courses) && count($courses) > 0)
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                    Ficha: {{ $course->code }} — {{ $course->program ? $course->program->name : 'Formación CEFA' }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="1">ADSO - Análisis y Desarrollo de Software (Ficha 598369)</option>
                                            <option value="2">Gestión de Empresas Agropecuarias (Ficha 55555)</option>
                                        @endif
                                    </select>
                                    <i class="fa-solid fa-graduation-cap absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Estado Actual de Graduación -->
                            <div class="sm:col-span-4">
                                <label for="estado_egresado" class="form-label-compact">
                                    Condición de Egreso
                                </label>
                                <select id="estado_egresado" name="estado_egresado" class="form-input-compact">
                                    <option value="CERTIFICADO" selected>Certificado / Graduado(a)</option>
                                    <option value="ETAPA_PRACTICA">Por Certificar (Etapa Práctica)</option>
                                    <option value="EN_FORMACION">Culminó Etapa Lectiva</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <!-- SECCIÓN 3: CREDENCIALES DE ACCESO Y SEGURIDAD -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="space-y-3 pt-1">
                        <div class="flex items-center space-x-2.5 pb-2 border-b border-gray-100">
                            <span class="step-badge bg-[#002336] text-[#62E31D] border border-[#62E31D]/30">3</span>
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-[#00131E] leading-tight font-poppins">Cuenta y Credenciales de Acceso</h3>
                                <p class="text-[11px] text-gray-500">Crea tu correo y contraseña para ingresar al portal</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                            
                            <!-- Correo Personal / Principal -->
                            <div class="sm:col-span-6">
                                <label for="personal_email" class="form-label-compact">
                                    Correo Electrónico <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" id="personal_email" name="personal_email" value="{{ old('personal_email') }}" required placeholder="ejemplo@correo.com" class="form-input-compact pl-9">
                                    <i class="fa-solid fa-envelope absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                </div>
                                <span class="text-[10.5px] text-gray-500 mt-1 block">Tu correo para acceder al portal.</span>
                            </div>

                            <!-- Correo MiSENA (Opcional) -->
                            <div class="sm:col-span-6">
                                <label for="misena_email" class="form-label-compact">
                                    Correo Institucional MiSENA <span class="text-gray-400 font-normal lowercase">(opcional)</span>
                                </label>
                                <div class="relative">
                                    <input type="email" id="misena_email" name="misena_email" value="{{ old('misena_email') }}" placeholder="usuario@soy.sena.edu.co" class="form-input-compact pl-9">
                                    <i class="fa-solid fa-at absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="sm:col-span-6">
                                <label for="password" class="form-label-compact">
                                    Contraseña <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required placeholder="Mínimo 8 caracteres" class="form-input-compact pl-9 pr-9">
                                    <i class="fa-solid fa-lock absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i id="eyeIcon1" class="fa-regular fa-eye text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="sm:col-span-6">
                                <label for="password_confirmation" class="form-label-compact">
                                    Confirmar Contraseña <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repite tu contraseña" class="form-input-compact pl-9 pr-9">
                                    <i class="fa-solid fa-shield-halved absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i id="eyeIcon2" class="fa-regular fa-eye text-xs"></i>
                                    </button>
                                </div>
                                <span id="passMatchMessage" class="text-[10.5px] mt-1 font-semibold hidden"></span>
                            </div>

                        </div>
                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <!-- TRATAMIENTO DE DATOS Y HABEAS DATA -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="p-3 rounded-xl bg-gradient-to-r from-[#F0FDF4] to-[#EAF7EE] border border-[#BBF7D0]">
                        <label class="flex items-start space-x-2.5 cursor-pointer">
                            <input type="checkbox" name="habeas_data" id="habeas_data" value="1" required class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#39A900] focus:ring-[#39A900]">
                            <span class="text-[11.5px] text-[#166534] leading-snug">
                                Acepto los términos de uso y autorizo el tratamiento de mis datos personales de conformidad con la <strong>Ley 1581 de 2012 (Habeas Data)</strong> del SENA, para fines de intermediación laboral, seguimiento ocupacional y convocatorias institucionales del CEFA.
                            </span>
                        </label>
                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <!-- BOTÓN DE ENVÍO Y ENLACES (COLORES SENA ERP) -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="pt-3 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-gray-100">
                        <a href="{{ route('egresados.welcome') }}" class="text-xs font-bold text-gray-500 hover:text-[#00131E] transition flex items-center space-x-1 order-2 sm:order-1">
                            <i class="fa-solid fa-arrow-left text-[11px]"></i>
                            <span>Cancelar y volver al portal</span>
                        </a>

                        <button type="submit" id="btnSubmitRegistro" class="w-full sm:w-auto bg-gradient-to-r from-[#39A900] to-[#2a7c00] hover:from-[#43be04] hover:to-[#319400] text-white font-extrabold px-6 py-2.5 rounded-xl shadow-md shadow-[#39A900]/30 hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2 text-xs sm:text-sm font-poppins order-1 sm:order-2">
                            <i class="fa-solid fa-user-check text-xs"></i>
                            <span>Completar Registro de Egresado</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    
        @endif
</main>

    <!-- ============================================== -->
    <!-- 3. FOOTER SENA INSTITUCIONAL -->
    <!-- ============================================== -->
    <footer class="bg-[#00131E] text-white py-4 border-t-2 border-[#39A900] text-xs text-center text-gray-400">
        <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-[11px]">© {{ date('Y') }} SENA Empresa — Centro de Formación Agroindustrial La Angostura.</p>
            <p class="flex items-center space-x-2 text-[11px] text-[#62E31D] font-bold">
                <span class="w-2 h-2 rounded-full bg-[#62E31D] animate-pulse"></span>
                <span>SIGE · Sistema Integrado de Gestión de Egresados</span>
            </p>
        </div>
    </footer>

    <!-- Scripts de Interacción -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Validación visual en tiempo real de coincidencia de contraseñas
        const pass1 = document.getElementById('password');
        const pass2 = document.getElementById('password_confirmation');
        const matchMsg = document.getElementById('passMatchMessage');

        function checkPasswords() {
            if (!pass2.value) {
                matchMsg.classList.add('hidden');
                return;
            }
            matchMsg.classList.remove('hidden');
            if (pass1.value === pass2.value) {
                matchMsg.textContent = '✓ Las contraseñas coinciden';
                matchMsg.className = 'text-[10.5px] mt-1 font-bold text-green-600 block';
            } else {
                matchMsg.textContent = '✗ Las contraseñas no coinciden';
                matchMsg.className = 'text-[10.5px] mt-1 font-bold text-red-500 block';
            }
        }

        pass1.addEventListener('input', checkPasswords);
        pass2.addEventListener('input', checkPasswords);
    </script>

</body>
</html>
