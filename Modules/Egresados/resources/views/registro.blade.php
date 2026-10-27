<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Registro Exclusivo de Egresados — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans / Fraunces -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        editorial: ['Fraunces', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .font-editorial { font-family: 'Fraunces', serif; }
        
        .step-badge {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .form-input-focus:focus {
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.18);
            outline: none;
        }

        /* Ambient Glow */
        .glow-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#F4F7F6] font-sans antialiased text-[#1A2E22] min-h-screen flex flex-col justify-between selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. HEADER EXCLUSIVO DEL PORTAL DE REGISTRO -->
    <!-- ============================================== -->
    <header class="bg-[#001A29] text-white border-b-2 border-[#39A900] shadow-md sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex justify-between items-center">
            
            <!-- Brand -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-3 text-white no-underline group">
                <div class="w-10 h-10 rounded-full overflow-hidden shadow-md border-2 border-white/80 flex items-center justify-center bg-[#39A900] shrink-0 group-hover:scale-105 transition">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-editorial text-2xl font-bold tracking-wider leading-none">SIGE</span>
                        <span class="bg-[#39A900] text-white text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">CEFA</span>
                    </div>
                    <p class="text-[11px] text-green-200/90 font-medium">Portal Exclusivo de Egresados</p>
                </div>
            </a>

            <!-- Right Actions -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('egresados.welcome') }}" class="text-xs sm:text-sm text-gray-300 hover:text-white flex items-center space-x-1.5 transition px-3 py-1.5 rounded-lg hover:bg-white/10">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span class="hidden sm:inline">Volver al Portal</span>
                </a>
                <a href="{{ route('login', ['redirect' => route('egresados.dashboard_egresado')]) }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs sm:text-sm font-semibold px-4 py-1.5 rounded-full transition flex items-center space-x-1.5">
                    <i class="fa-regular fa-user text-xs"></i>
                    <span>¿Ya tienes cuenta? Ingresar</span>
                </a>
            </div>

        </div>
    </header>

    <!-- ============================================== -->
    <!-- 2. CONTENIDO PRINCIPAL: FORMULARIO DE REGISTRO -->
    <!-- ============================================== -->
    <main class="flex-grow py-8 sm:py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <!-- Subtle background glow -->
        <div class="glow-circle w-96 h-96 bg-green-200/40 -top-20 -left-20"></div>
        <div class="glow-circle w-[450px] h-[450px] bg-emerald-100/50 -bottom-20 -right-20"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            
            <!-- Encabezado del Formulario -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center space-x-2 bg-white text-[#001A29] text-xs font-bold px-4 py-1.5 rounded-full shadow-sm border border-green-200/80 mb-3">
                    <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                    <span>Comunidad de Graduados CEFA La Angostura</span>
                </div>
                <h1 class="font-editorial text-3xl sm:text-4xl font-bold text-[#00131E] tracking-tight">
                    Registro de Egresado(a)
                </h1>
                <p class="text-gray-600 text-sm sm:text-base max-w-xl mx-auto mt-2">
                    Ingresa tus datos personales y académicos para activar tu cuenta de egresado, postularte a vacantes exclusivas y responder encuestas de seguimiento.
                </p>
            </div>

            <!-- Alertas de Validación / Sesión -->
            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start space-x-3 shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-red-500 text-lg mt-0.5"></i>
                    <div class="text-sm">
                        <strong class="font-semibold">Atención:</strong> {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 shadow-sm">
                    <div class="flex items-center space-x-2 font-semibold text-sm mb-2">
                        <i class="fa-solid fa-triangle-exclamation text-amber-500 text-lg"></i>
                        <span>Por favor corrige los siguientes campos para continuar:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 text-amber-900 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tarjeta Principal del Formulario -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                
                <!-- Barra superior de diseño -->
                <div class="h-2.5 bg-gradient-to-r from-[#001A29] via-[#39A900] to-[#62E31D]"></div>

                <form action="{{ route('egresados.registro.post') }}" method="POST" class="p-6 sm:p-10 space-y-8" id="registroEgresadoForm">
                    @csrf

                    <!-- ------------------------------------------------------------- -->
                    <!-- SECCIÓN 1: DATOS PERSONALES Y DOCUMENTO DE IDENTIDAD -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 pb-3 border-b border-gray-100">
                            <span class="step-badge bg-[#001A29] text-[#62E31D]">1</span>
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-[#00131E]">Identificación y Datos Personales</h3>
                                <p class="text-xs text-gray-500">Información básica del aprendiz egresado</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            
                            <!-- Tipo de Documento -->
                            <div class="sm:col-span-4">
                                <label for="document_type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Tipo de Documento <span class="text-red-500">*</span>
                                </label>
                                <select id="document_type" name="document_type" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <option value="Cédula de ciudadanía" {{ old('document_type') == 'Cédula de ciudadanía' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                                    <option value="Tarjeta de identidad" {{ old('document_type') == 'Tarjeta de identidad' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                                    <option value="Cédula de extranjería" {{ old('document_type') == 'Cédula de extranjería' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
                                    <option value="Permiso Especial de Permanencia" {{ old('document_type') == 'Permiso Especial de Permanencia' ? 'selected' : '' }}>Permiso Especial (PEP)</option>
                                    <option value="Pasaporte" {{ old('document_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                </select>
                            </div>

                            <!-- Número de Documento -->
                            <div class="sm:col-span-8">
                                <label for="document_number" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Número de Documento <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="document_number" name="document_number" value="{{ old('document_number') }}" required placeholder="Ej: 1075284910" class="w-full pl-10 pr-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <i class="fa-solid fa-id-card absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Nombres -->
                            <div class="sm:col-span-4">
                                <label for="first_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Nombres <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="Ej: Juan Carlos" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                            </div>

                            <!-- Primer Apellido -->
                            <div class="sm:col-span-4">
                                <label for="first_last_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Primer Apellido <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="first_last_name" name="first_last_name" value="{{ old('first_last_name') }}" required placeholder="Ej: Gómez" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                            </div>

                            <!-- Segundo Apellido -->
                            <div class="sm:col-span-4">
                                <label for="second_last_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Segundo Apellido <span class="text-gray-400 font-normal">(Opcional)</span>
                                </label>
                                <input type="text" id="second_last_name" name="second_last_name" value="{{ old('second_last_name') }}" placeholder="Ej: Pérez" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                            </div>

                            <!-- Teléfono Celular -->
                            <div class="sm:col-span-6">
                                <label for="telephone1" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Teléfono / Celular de Contacto <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="tel" id="telephone1" name="telephone1" value="{{ old('telephone1') }}" required placeholder="Ej: 3124567890" class="w-full pl-10 pr-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <i class="fa-solid fa-phone absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Género -->
                            <div class="sm:col-span-6">
                                <label for="gender" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Género <span class="text-gray-400 font-normal">(Opcional)</span>
                                </label>
                                <select id="gender" name="gender" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
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
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center space-x-3 pb-3 border-b border-gray-100">
                            <span class="step-badge bg-[#39A900] text-white">2</span>
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-[#00131E]">Programa y Formación en el CEFA</h3>
                                <p class="text-xs text-gray-500">Selecciona el programa del cual egresaste en el Centro La Angostura</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            
                            <!-- Programa / Ficha de Formación -->
                            <div class="sm:col-span-8">
                                <label for="course_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Programa de Formación / Ficha <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="course_id" name="course_id" required class="w-full pl-10 pr-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
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
                                    <i class="fa-solid fa-graduation-cap absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Estado Actual de Graduación -->
                            <div class="sm:col-span-4">
                                <label for="estado_egresado" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Condición de Egreso
                                </label>
                                <select id="estado_egresado" name="estado_egresado" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
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
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center space-x-3 pb-3 border-b border-gray-100">
                            <span class="step-badge bg-[#002336] text-[#39A900]">3</span>
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-[#00131E]">Cuenta y Credenciales de Acceso</h3>
                                <p class="text-xs text-gray-500">Crea tu correo y contraseña para ingresar al portal</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            
                            <!-- Correo Personal / Institucional -->
                            <div class="sm:col-span-6">
                                <label for="personal_email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Correo Electrónico Principal <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" id="personal_email" name="personal_email" value="{{ old('personal_email') }}" required placeholder="ejemplo@correo.com" class="w-full pl-10 pr-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <i class="fa-solid fa-envelope absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                </div>
                                <span class="text-[11px] text-gray-500 mt-1 block">Este correo será tu usuario para iniciar sesión en el ERP.</span>
                            </div>

                            <!-- Correo MiSENA (Opcional) -->
                            <div class="sm:col-span-6">
                                <label for="misena_email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Correo Institucional MiSENA <span class="text-gray-400 font-normal">(Opcional)</span>
                                </label>
                                <div class="relative">
                                    <input type="email" id="misena_email" name="misena_email" value="{{ old('misena_email') }}" placeholder="usuario@soy.sena.edu.co" class="w-full pl-10 pr-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <i class="fa-solid fa-at absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="sm:col-span-6">
                                <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Contraseña <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required placeholder="Mínimo 8 caracteres" class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <i class="fa-solid fa-lock absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3.5 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i id="eyeIcon1" class="fa-regular fa-eye text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="sm:col-span-6">
                                <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                    Confirmar Contraseña <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repite tu contraseña" class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 form-input-focus transition">
                                    <i class="fa-solid fa-shield-halved absolute left-3.5 top-3 text-gray-400 text-xs"></i>
                                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute right-3.5 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i id="eyeIcon2" class="fa-regular fa-eye text-xs"></i>
                                    </button>
                                </div>
                                <span id="passMatchMessage" class="text-[11px] mt-1 font-medium hidden"></span>
                            </div>

                        </div>
                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <!-- TRATAMIENTO DE DATOS Y HABEAS DATA -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="p-4 rounded-xl bg-green-50/70 border border-green-200/70 space-y-3">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="habeas_data" id="habeas_data" value="1" required class="mt-1 h-4 w-4 rounded border-gray-300 text-[#39A900] focus:ring-[#39A900]">
                            <span class="text-xs text-gray-700 leading-relaxed">
                                Acepto los términos de uso y autorizo el tratamiento de mis datos personales de conformidad con la <strong>Ley Estatutaria 1581 de 2012 (Habeas Data)</strong> del SENA, para fines exclusivos de intermediación laboral, seguimiento ocupacional, encuestas de egresados y convocatorias institucionales del CEFA.
                            </span>
                        </label>
                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <!-- BOTÓN DE ENVÍO Y ENLACES -->
                    <!-- ------------------------------------------------------------- -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-100">
                        <a href="{{ route('egresados.welcome') }}" class="text-xs sm:text-sm font-semibold text-gray-500 hover:text-gray-800 transition flex items-center space-x-1.5">
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                            <span>Cancelar y volver al portal</span>
                        </a>

                        <button type="submit" id="btnSubmitRegistro" class="w-full sm:w-auto bg-[#39A900] hover:bg-[#2a7c00] text-white font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition flex items-center justify-center space-x-2 text-sm sm:text-base">
                            <i class="fa-solid fa-user-check text-sm"></i>
                            <span>Completar Registro de Egresado</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </main>

    <!-- ============================================== -->
    <!-- 3. FOOTER SENA INSTITUCIONAL -->
    <!-- ============================================== -->
    <footer class="bg-[#00131E] text-white py-6 border-t border-white/10 text-xs text-center text-gray-400">
        <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>© {{ date('Y') }} SENA Empresa — Centro de Formación Agroindustrial La Angostura (CEFA).</p>
            <p class="flex items-center space-x-2">
                <span class="w-2 h-2 rounded-full bg-[#62E31D]"></span>
                <span>Módulo Oficial SIGE — Sistema Integrado de Gestión de Egresados</span>
            </p>
        </div>
    </footer>

    <!-- Scripts de Interacción Segura -->
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
                matchMsg.className = 'text-[11px] mt-1 font-medium text-green-600 block';
            } else {
                matchMsg.textContent = '✗ Las contraseñas no coinciden';
                matchMsg.className = 'text-[11px] mt-1 font-medium text-red-500 block';
            }
        }

        pass1.addEventListener('input', checkPasswords);
        pass2.addEventListener('input', checkPasswords);
    </script>

</body>
</html>
