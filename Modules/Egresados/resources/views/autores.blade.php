<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipo de Autores y Desarrolladores · SIGE — SENA Empresa CEFA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Poppins & Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN oficial) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sena: {
                            green: '#39A900',
                            darkGreen: '#2a7c00',
                            neon: '#62E31D',
                            navy: '#001A29',
                            dark: '#00131E',
                            lightNavy: '#00283D'
                        }
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        sans: ['Nunito', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F8FAFC;
            color: #00131E;
        }
        h1, h2, h3, h4, h5, h6, .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        .author-card {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .author-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px -10px rgba(0, 19, 30, 0.15), 0 0 0 2px rgba(57, 169, 0, 0.4);
        }
        .avatar-glow {
            box-shadow: 0 0 0 4px #FFFFFF, 0 0 0 7px #39A900, 0 10px 20px rgba(57, 169, 0, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-slate-800">

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 z-40 bg-[#00131E]/95 backdrop-blur-md border-b border-white/10 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-white p-1.5 flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                    <img src="{{ route('egresados.assets.image', 'sena-empresa-logo.png') }}" alt="SENA Empresa Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-poppins font-black text-xl text-white tracking-wide">SIGE</span>
                        <span class="bg-[#39A900] text-white text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-full tracking-wider">CEFA</span>
                    </div>
                    <span class="text-[11px] text-gray-300 font-medium block">Sistema de Gestión de Egresados</span>
                </div>
            </a>

            <!-- Acciones -->
            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.welcome') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-gray-200 hover:text-white hover:bg-white/10 transition border border-white/15">
                    <i class="fa-solid fa-arrow-left text-[#62E31D]"></i>
                    <span>Volver al Portal</span>
                </a>
                <a href="{{ route('egresados.login') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-[#39A900] hover:bg-[#2d8500] text-white shadow-md hover:shadow-lg transition">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Ingresar a SIGE</span>
                </a>
            </div>

        </div>
    </header>

    <!-- ================= HERO SECTION ================= -->
    <section class="relative bg-gradient-to-b from-[#00131E] via-[#001A29] to-[#002336] text-white py-16 sm:py-20 overflow-hidden border-b-4 border-[#39A900]">
        <!-- Decoraciones de Fondo -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#62E31D_1px,transparent_1px)] [background-size:24px_24px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#39A900]/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#62E31D]/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            <!-- Badge Superior -->
            <div class="inline-flex items-center gap-2 bg-white/10 border border-[#62E31D]/40 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-[#62E31D] mb-6 shadow-sm">
                <i class="fa-solid fa-users-gear text-sm"></i>
                <span>SENA EMPRESA CEFA · TECNOLOGÍA EN ADSO</span>
            </div>

            <!-- Título Principal -->
            <h1 class="text-3xl sm:text-5xl font-black font-poppins text-white tracking-tight mb-5 leading-tight">
                Equipo de <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#62E31D] via-white to-[#62E31D]">Autores & Desarrolladores</span>
            </h1>

            <p class="max-w-3xl mx-auto text-sm sm:text-base text-gray-300 font-normal leading-relaxed mb-8">
                Conoce a los creadores de <strong>SIGE</strong>: aprendices tecnólogos de la ficha de <strong>Análisis y Desarrollo de Software (ADSO)</strong> del Centro de Formación Agroindustrial "La Angostura", quienes lideraron la arquitectura, diseño, lógica institucional e interactividad del sistema.
            </p>

            <!-- Pill Info del Proyecto -->
            <div class="inline-flex flex-wrap items-center justify-center gap-4 text-xs text-gray-300 bg-white/5 border border-white/10 px-5 py-2.5 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-code text-[#62E31D]"></i>
                    <span>Módulo SIGE — Egresados</span>
                </div>
                <span class="text-white/30 hidden sm:inline">•</span>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-building-columns text-[#62E31D]"></i>
                    <span>CEFA La Angostura</span>
                </div>
                <span class="text-white/30 hidden sm:inline">•</span>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-map-pin text-[#62E31D]"></i>
                    <span>Campoalegre, Huila</span>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= CONTENIDO: TARJETAS DE AUTORES ================= -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-14">

        <!-- Mensaje de Información para Personalizar -->
        <div class="bg-gradient-to-r from-[#F0FDF4] via-[#EAF7EE] to-[#DCFCE7] border border-[#BBF7D0] border-l-4 border-l-[#39A900] rounded-2xl p-4 sm:p-5 mb-10 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-[#39A900] text-white flex items-center justify-center text-lg shrink-0 shadow-sm">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div>
                    <h4 class="font-poppins font-bold text-sm text-[#00131E]">¡Personaliza las fotos e información de tu equipo!</h4>
                    <p class="text-xs text-[#166534] font-medium leading-relaxed">
                        Puedes subir tu fotografía real, editar tu rol, biografía y canales de contacto haciendo clic en el botón <strong>"Editar Información / Foto"</strong> en cada perfil.
                    </p>
                </div>
            </div>
            <span class="text-[11px] font-extrabold uppercase tracking-wider text-[#166534] bg-white/80 px-3 py-1.5 rounded-full border border-[#BBF7D0] shrink-0">
                <i class="fa-solid fa-shield-halved text-[#39A900] mr-1"></i> Créditos Oficiales
            </span>
        </div>

        <!-- Grid de Autores (3 Tarjetas) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @foreach(['hasbleidy', 'juand', 'nicolle'] as $key)
                @php 
                    $autor = $autores[$key] ?? [];
                    $nombre = $autor['nombre'] ?? 'Autor';
                    $rol = $autor['rol'] ?? 'Desarrollador';
                    $bio = $autor['bio'] ?? '';
                    $especialidad = $autor['especialidad'] ?? 'Tecnología en ADSO';
                    $centro = $autor['centro'] ?? 'CEFA La Angostura';
                    $email = $autor['email'] ?? '';
                    $telefono = $autor['telefono'] ?? '';
                    $linkedin = $autor['linkedin'] ?? '';
                    $github = $autor['github'] ?? '';
                    $foto = $autor['foto'] ?? null;
                    $habilidades = $autor['habilidades'] ?? ['Laravel', 'Tailwind', 'MySQL'];
                    
                    // Iniciales para fallback
                    $partes = explode(' ', $nombre);
                    $iniciales = (isset($partes[0][0]) ? $partes[0][0] : '') . (isset($partes[1][0]) ? $partes[1][0] : '');
                @endphp

                <div class="author-card bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between" id="card-autor-{{ $key }}">
                    
                    <div>
                        <!-- Header de la Tarjeta con Gradiente Institucional -->
                        <div class="relative h-28 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] p-4 flex items-start justify-between">
                            <span class="bg-[#39A900]/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#62E31D]/30">
                                <i class="fa-solid fa-medal text-[#62E31D] mr-1"></i> Autor(a) SIGE
                            </span>
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white/80 text-xs">
                                <i class="fa-solid fa-code"></i>
                            </div>
                        </div>

                        <!-- Foto / Avatar Centrado Flotante -->
                        <div class="relative px-6 -mt-14 mb-4 flex items-end justify-between">
                            <div class="relative group">
                                <div class="w-24 h-24 rounded-2xl avatar-glow bg-white overflow-hidden flex items-center justify-center shadow-md border-2 border-white">
                                    @if(!empty($foto))
                                        <img src="{{ $foto }}" alt="{{ $nombre }}" id="img-autor-{{ $key }}" class="w-full h-full object-cover">
                                    @else
                                        <div id="avatar-fallback-{{ $key }}" class="w-full h-full bg-gradient-to-tr from-[#00131E] to-[#39A900] text-white font-poppins font-black text-2xl flex items-center justify-center tracking-wider">
                                            {{ strtoupper($iniciales) ?: 'AD' }}
                                        </div>
                                    @endif
                                </div>
                                <button type="button" onclick="abrirModalEditarAutor('{{ $key }}')" class="absolute -bottom-1 -right-1 w-8 h-8 rounded-xl bg-[#39A900] hover:bg-[#2d8500] text-white flex items-center justify-center text-xs shadow-lg transition border-2 border-white" title="Cambiar fotografía">
                                    <i class="fa-solid fa-camera"></i>
                                </button>
                            </div>

                            <!-- Insignia Tecnólogo -->
                            <div class="text-right">
                                <span class="inline-block text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    ADSO
                                </span>
                            </div>
                        </div>

                        <!-- Información Principal -->
                        <div class="px-6 pb-4">
                            <h3 class="font-poppins font-extrabold text-xl text-[#00131E] tracking-tight mb-1" id="text-nombre-{{ $key }}">
                                {{ $nombre }}
                            </h3>
                            <p class="text-xs font-bold text-[#39A900] mb-3 leading-snug" id="text-rol-{{ $key }}">
                                {{ $rol }}
                            </p>

                            <!-- Centro y Formación -->
                            <div class="space-y-1.5 mb-4 text-[11.5px] text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-graduation-cap text-[#39A900] w-4 text-center"></i>
                                    <span class="truncate">{{ $especialidad }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-building-columns text-[#39A900] w-4 text-center"></i>
                                    <span class="truncate">{{ $centro }}</span>
                                </div>
                            </div>

                            <!-- Biografía -->
                            <p class="text-xs text-slate-600 leading-relaxed mb-4 min-h-[60px]" id="text-bio-{{ $key }}">
                                {{ $bio }}
                            </p>

                            <!-- Habilidades / Tags -->
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                @foreach($habilidades as $hab)
                                    <span class="text-[10px] font-semibold bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded-md border border-slate-200">
                                        {{ $hab }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Footer de la Tarjeta con Enlaces y Botón Editar -->
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-3">
                        <!-- Redes / Contacto -->
                        <div class="flex items-center gap-2">
                            @if(!empty($email))
                                <a href="mailto:{{ $email }}" class="w-8 h-8 rounded-lg bg-white border border-slate-200 hover:border-[#39A900] hover:text-[#39A900] text-slate-600 flex items-center justify-center text-xs transition shadow-2xs" title="Enviar correo">
                                    <i class="fa-solid fa-envelope"></i>
                                </a>
                            @endif
                            @if(!empty($telefono))
                                @php $cleanPhone = preg_replace('/\D/', '', $telefono); @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="w-8 h-8 rounded-lg bg-white border border-slate-200 hover:border-[#39A900] hover:text-[#39A900] text-slate-600 flex items-center justify-center text-xs transition shadow-2xs" title="WhatsApp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            @endif
                            @if(!empty($linkedin))
                                <a href="{{ $linkedin }}" target="_blank" class="w-8 h-8 rounded-lg bg-white border border-slate-200 hover:border-[#0077b5] hover:text-[#0077b5] text-slate-600 flex items-center justify-center text-xs transition shadow-2xs" title="LinkedIn">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            @endif
                            @if(!empty($github))
                                <a href="{{ $github }}" target="_blank" class="w-8 h-8 rounded-lg bg-white border border-slate-200 hover:border-[#00131E] hover:text-[#00131E] text-slate-600 flex items-center justify-center text-xs transition shadow-2xs" title="GitHub">
                                    <i class="fa-brands fa-github"></i>
                                </a>
                            @endif
                        </div>

                        <!-- Botón de Editar Perfil / Foto -->
                        <button type="button" onclick="abrirModalEditarAutor('{{ $key }}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white hover:bg-[#39A900] text-slate-700 hover:text-white border border-slate-200 hover:border-[#39A900] text-xs font-bold transition shadow-xs">
                            <i class="fa-solid fa-user-pen text-[#39A900] group-hover:text-white"></i>
                            <span>Editar</span>
                        </button>
                    </div>

                </div>

            @endforeach

        </div>

        <!-- Banner de Reconocimiento Institucional -->
        <div class="mt-14 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] rounded-3xl p-8 sm:p-10 text-white relative overflow-hidden border border-white/10 shadow-xl">
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-[#39A900]/15 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-white p-2.5 shrink-0 flex items-center justify-center shadow-lg">
                        <img src="{{ route('egresados.assets.image', 'sena-empresa-logo.png') }}" alt="SENA Empresa Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-poppins font-black text-xl text-white mb-1">
                            Desarrollo 100% Hecho en SENA Empresa CEFA
                        </h3>
                        <p class="text-xs text-gray-300 max-w-2xl leading-relaxed font-medium">
                            El Sistema de Gestión de Egresados (SIGE) es producto del talento, la innovación y el compromiso formativo de aprendices e instructores del Centro de Formación Agroindustrial "La Angostura", fortaleciendo la vinculación institucional entre el SENA y sus graduados.
                        </p>
                    </div>
                </div>
                
                <a href="{{ route('egresados.welcome') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#39A900] hover:bg-[#2d8500] text-white font-poppins font-bold text-xs uppercase tracking-wider transition shadow-lg shrink-0">
                    <i class="fa-solid fa-house"></i>
                    <span>Ir al Inicio del Portal</span>
                </a>
            </div>
        </div>

    </main>

    <!-- ================= MODAL EDITAR AUTOR / SUBIR FOTO ================= -->
    <div id="modalEditarAutor" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-[#00131E]/80 backdrop-blur-sm" onclick="if(event.target===this)cerrarModalEditarAutor()">
        <div class="relative bg-white rounded-3xl max-w-lg w-full max-h-[90vh] overflow-hidden shadow-2xl flex flex-col border border-slate-200 animate-zoomIn" onclick="event.stopPropagation()">
            
            <!-- Header Modal con Gradiente SENA ERP -->
            <div class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] px-6 py-4 flex items-center justify-between border-b-2 border-[#39A900] text-white shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-[#39A900]/20 border border-[#62E31D] flex items-center justify-center text-[#62E31D] text-xs">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div>
                        <h3 class="font-poppins font-bold text-sm text-white" id="modal-edit-title">Editar Perfil de Autor(a)</h3>
                        <span class="text-[10px] text-gray-300 block">Actualiza tu fotografía e información personal</span>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalEditarAutor()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-red-500 text-white flex items-center justify-center text-xs transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Formulario con Scroll -->
            <form id="formEditarAutor" action="{{ route('egresados.autores.guardar') }}" method="POST" enctype="multipart/form-data" onsubmit="submitGuardarAutor(event)" class="overflow-y-auto p-6 space-y-4">
                @csrf
                <input type="hidden" name="autor_id" id="edit_autor_id" value="">

                <!-- Alertas -->
                <div id="modal-error-alert" class="hidden bg-red-50 border border-red-200 text-red-800 text-xs font-bold p-3 rounded-xl"></div>
                <div id="modal-success-alert" class="hidden bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold p-3 rounded-xl"></div>

                <!-- Subir Foto / Avatar -->
                <div class="bg-slate-50 border border-slate-200 p-4 rounded-2xl flex items-center gap-4">
                    <div class="relative w-20 h-20 rounded-2xl bg-white border-2 border-[#39A900] overflow-hidden shrink-0 flex items-center justify-center shadow-sm">
                        <img id="preview-foto-autor" src="" alt="Previsualización" class="w-full h-full object-cover hidden">
                        <span id="preview-fallback-autor" class="font-poppins font-extrabold text-xl text-[#39A900]">HP</span>
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-800 mb-1">Fotografía del Autor(a)</label>
                        <p class="text-[11px] text-slate-500 mb-2">Formatos permitidos: JPG, PNG o WebP (Máx. 5MB).</p>
                        <label class="cursor-pointer inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white hover:bg-[#39A900] text-slate-700 hover:text-white border border-slate-300 hover:border-[#39A900] text-xs font-bold transition shadow-xs">
                            <i class="fa-solid fa-upload text-[#39A900] group-hover:text-white"></i>
                            <span>Seleccionar Foto</span>
                            <input type="file" name="foto" id="edit_foto_input" accept="image/*" class="hidden" onchange="previewFotoSeleccionada(this)">
                        </label>
                    </div>
                </div>

                <!-- Nombre -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nombre Completo <span class="text-red-500">*</span></label>
                    <input type="text" name="nombre" id="edit_nombre" required class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2.5 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]">
                </div>

                <!-- Rol en el Proyecto -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Rol / Cargo en el Proyecto <span class="text-red-500">*</span></label>
                    <input type="text" name="rol" id="edit_rol" required class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2.5 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]">
                </div>

                <!-- Biografía -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Biografía / Resumen de Perfil</label>
                    <textarea name="bio" id="edit_bio" rows="3" class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2.5 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]"></textarea>
                </div>

                <!-- Grid Contacto -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Correo Electrónico</label>
                        <input type="email" name="email" id="edit_email" class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Teléfono / WhatsApp</label>
                        <input type="text" name="telefono" id="edit_telefono" class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]">
                    </div>
                </div>

                <!-- Redes Sociales -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fa-brands fa-linkedin text-[#0077b5] mr-1"></i> LinkedIn</label>
                        <input type="url" name="linkedin" id="edit_linkedin" placeholder="https://linkedin.com/in/..." class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fa-brands fa-github text-[#00131E] mr-1"></i> GitHub</label>
                        <input type="url" name="github" id="edit_github" placeholder="https://github.com/..." class="w-full text-xs font-medium border border-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-[#39A900] focus:ring-1 focus:ring-[#39A900]">
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                    <button type="button" onclick="cerrarModalEditarAutor()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                        Cancelar
                    </button>
                    <button type="submit" id="btn-submit-edit-autor" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-[#39A900] hover:bg-[#2d8500] text-white shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-[#00131E] text-white py-10 border-t border-white/10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-400 font-medium text-center sm:text-left">
            <div>
                <p>© {{ date('Y') }} <strong class="text-white font-poppins">SIGE — Sistema de Gestión de Egresados</strong> • SENA Empresa.</p>
                <p class="text-gray-400 mt-1">Créditos y derechos de autor: <strong class="text-white">Hasbleidy Perdomo, Juan D. Lizcano y Nicolle Suache</strong>.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.welcome') }}" class="text-[#62E31D] hover:underline font-bold font-poppins">Centro de Formación Agroindustrial "La Angostura"</a>
            </div>
        </div>
    </footer>

    <!-- ================= SCRIPT INTERACTIVO ================= -->
    <script>
        const autoresData = @json($autores);

        function abrirModalEditarAutor(id) {
            const data = autoresData[id] || {};
            document.getElementById('edit_autor_id').value = id;
            document.getElementById('modal-edit-title').textContent = 'Editar Perfil: ' + (data.nombre || 'Autor(a)');
            document.getElementById('edit_nombre').value = data.nombre || '';
            document.getElementById('edit_rol').value = data.rol || '';
            document.getElementById('edit_bio').value = data.bio || '';
            document.getElementById('edit_email').value = data.email || '';
            document.getElementById('edit_telefono').value = data.telefono || '';
            document.getElementById('edit_linkedin').value = data.linkedin || '';
            document.getElementById('edit_github').value = data.github || '';

            const previewImg = document.getElementById('preview-foto-autor');
            const previewFallback = document.getElementById('preview-fallback-autor');
            if (data.foto) {
                previewImg.src = data.foto;
                previewImg.classList.remove('hidden');
                previewFallback.classList.add('hidden');
            } else {
                previewImg.classList.add('hidden');
                previewFallback.classList.remove('hidden');
                const p = (data.nombre || 'AD').split(' ');
                previewFallback.textContent = ((p[0] ? p[0][0] : '') + (p[1] ? p[1][0] : '')).toUpperCase();
            }

            document.getElementById('modal-error-alert').classList.add('hidden');
            document.getElementById('modal-success-alert').classList.add('hidden');
            document.getElementById('modalEditarAutor').classList.remove('hidden');
            document.getElementById('modalEditarAutor').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function cerrarModalEditarAutor() {
            document.getElementById('modalEditarAutor').classList.add('hidden');
            document.getElementById('modalEditarAutor').classList.remove('flex');
            document.body.style.overflow = '';
        }

        function previewFotoSeleccionada(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('preview-foto-autor');
                    const previewFallback = document.getElementById('preview-fallback-autor');
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    previewFallback.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function submitGuardarAutor(e) {
            e.preventDefault();
            const form = document.getElementById('formEditarAutor');
            const btn = document.getElementById('btn-submit-edit-autor');
            const errBox = document.getElementById('modal-error-alert');
            const sucBox = document.getElementById('modal-success-alert');

            btn.disabled = true;
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';
            errBox.classList.add('hidden');
            sucBox.classList.add('hidden');

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data })))
            .then(({ status, ok, data }) => {
                if (ok && data.success) {
                    sucBox.textContent = data.message || '¡Información guardada con éxito!';
                    sucBox.classList.remove('hidden');
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> ¡Guardado!';
                    btn.classList.remove('bg-[#39A900]');
                    btn.classList.add('bg-emerald-600');

                    // Actualizar memoria local y tarjeta en pantalla
                    const id = document.getElementById('edit_autor_id').value;
                    if (data.autor) {
                        autoresData[id] = data.autor;
                        const nameEl = document.getElementById('text-nombre-' + id);
                        if (nameEl) nameEl.textContent = data.autor.nombre;
                        const rolEl = document.getElementById('text-rol-' + id);
                        if (rolEl) rolEl.textContent = data.autor.rol;
                        const bioEl = document.getElementById('text-bio-' + id);
                        if (bioEl) bioEl.textContent = data.autor.bio;

                        if (data.autor.foto) {
                            const cardImg = document.getElementById('img-autor-' + id);
                            const fallback = document.getElementById('avatar-fallback-' + id);
                            if (cardImg) {
                                cardImg.src = data.autor.foto;
                                cardImg.classList.remove('hidden');
                            }
                            if (fallback) fallback.classList.add('hidden');
                        }
                    }

                    setTimeout(() => {
                        cerrarModalEditarAutor();
                        btn.disabled = false;
                        btn.innerHTML = originalHtml;
                        btn.classList.remove('bg-emerald-600');
                        btn.classList.add('bg-[#39A900]');
                    }, 1200);
                } else {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                    errBox.textContent = data.message || 'Ocurrió un error al guardar la información.';
                    errBox.classList.remove('hidden');
                }
            })
            .catch(err => {
                form.submit();
            });
        }
    </script>

</body>
</html>

