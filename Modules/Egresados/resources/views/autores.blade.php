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

            <!-- Título Principal -->
            <h1 class="text-3xl sm:text-5xl font-black font-poppins text-white tracking-tight mb-5 leading-tight">
                Equipo de <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#62E31D] via-white to-[#62E31D]">Autores & Desarrolladores</span>
            </h1>

            <p class="max-w-3xl mx-auto text-sm sm:text-base text-gray-300 font-normal leading-relaxed">
                Conoce a los creadores de <strong>SIGE</strong>: aprendices tecnólogos de la ficha <strong>3230026</strong> de <strong>Análisis y Desarrollo de Software (ADSO)</strong> del Centro de Formación Agroindustrial "La Angostura", quienes lideraron la arquitectura, diseño, lógica institucional e interactividad del sistema.
            </p>

        </div>
    </section>

    <!-- ================= CONTENIDO: TARJETAS DE AUTORES ================= -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-14">

        <!-- Mensaje Institucional de Créditos -->
        <div class="bg-gradient-to-r from-[#F0FDF4] via-[#EAF7EE] to-[#DCFCE7] border border-[#BBF7D0] border-l-4 border-l-[#39A900] rounded-2xl p-4 sm:p-5 mb-10 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-[#39A900] text-white flex items-center justify-center text-lg shrink-0 shadow-sm">
                    <i class="fa-solid fa-laptop-code"></i>
                </div>
                <div>
                    <h4 class="font-poppins font-bold text-sm text-[#00131E]">Equipo de Desarrollo y Autoría Institucional</h4>
                    <p class="text-xs text-[#166534] font-medium leading-relaxed">
                        Créditos oficiales y perfil profesional de los autores del Sistema de Gestión de Egresados (SIGE). Formación profesional integral SENA.
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
                            <div class="relative">
                                <div class="w-24 h-24 rounded-2xl avatar-glow bg-white overflow-hidden flex items-center justify-center shadow-md border-2 border-white">
                                    @if(!empty($foto))
                                        <img src="{{ $foto }}" alt="{{ $nombre }}" id="img-autor-{{ $key }}" class="w-full h-full object-cover">
                                    @else
                                        <div id="avatar-fallback-{{ $key }}" class="w-full h-full bg-gradient-to-tr from-[#00131E] to-[#39A900] text-white font-poppins font-black text-2xl flex items-center justify-center tracking-wider">
                                            {{ strtoupper($iniciales) ?: 'AD' }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Insignia Tecnólogo -->
                            <div class="text-right">
                                <span class="inline-block text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    ADSO · 3230026
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

                    <!-- Footer de la Tarjeta con Enlaces y Redes -->
                    <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-center gap-2">
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

</body>
</html>

