<?php
    /** @var array<string, mixed>|null $noticiaDestacada */
    /** @var array<int, mixed>|null $noticiasPublicadas */
    use Illuminate\Support\Facades\Auth;

    $destacadaId = (string)(isset($noticiaDestacada['id']) ? $noticiaDestacada['id'] : 'NOT-001');
    $noticiasJson = json_encode(isset($noticiasPublicadas) ? $noticiasPublicadas : [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Sistema de Gestión de Egresados — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Poppins & Nunito (Tipografía Oficial SENA Empresa ERP) + Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Nunito:wght@400;500;600;700;800;900&family=Caveat:wght@700&display=swap" rel="stylesheet">
    
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
                        senaForest: '#001A29',
                        senaForestDeep: '#00131E',
                        senaLight: '#F4F7F6',
                        senaLightWarm: '#F8FAF9',
                    },
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                        editorial: ['Poppins', 'sans-serif'],
                        cursive: ['Caveat', 'cursive'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F4F7F6;
        }

        h1, h2, h3, h4, h5, h6, .font-editorial, .font-poppins {
            font-family: 'Poppins', sans-serif !important;
        }

        .font-cursive { font-family: 'Caveat', cursive; }

        /* Floating animation for centerpiece */
        @keyframes float-hero {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(0.6deg); }
        }
        .animate-float-hero {
            animation: float-hero 4.5s ease-in-out infinite;
        }

        /* Logo Ilustrado Flotante con Sombreado Oficial SENA ERP */
        .hero-logo-emblem {
            position: relative;
            z-index: 10;
            width: 100%;
            height: auto;
            object-fit: contain;
            user-select: none;
            filter: drop-shadow(0 18px 30px rgba(0, 19, 30, 0.45)) 
                    drop-shadow(0 0 22px rgba(57, 169, 0, 0.55)) 
                    drop-shadow(0 0 45px rgba(98, 227, 29, 0.3));
            animation: float-hero 4.5s ease-in-out infinite;
            transition: filter 0.4s ease, transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }
        .hero-logo-emblem:hover {
            filter: drop-shadow(0 24px 40px rgba(0, 19, 30, 0.55)) 
                    drop-shadow(0 0 32px rgba(57, 169, 0, 0.75)) 
                    drop-shadow(0 0 60px rgba(98, 227, 29, 0.5));
            transform: scale(1.05) translateY(-16px);
        }

        /* Ambient glowing pulse behind artwork */
        @keyframes glow-pulse {
            0% { transform: scale(0.92); opacity: 0.55; }
            100% { transform: scale(1.12); opacity: 0.95; }
        }
        .animate-glow-pulse {
            animation: glow-pulse 3.8s ease-in-out infinite alternate;
        }

        /* Card Hover Lift */
        .service-card-modern {
            transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .service-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px -8px rgba(0, 19, 30, 0.12);
        }

        /* Scroll Reveal & Movimiento progresivo de texto (¿Quiénes somos?) */
        .sige-reveal-block {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1), transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .sige-reveal-block.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .sige-word {
            display: inline-block;
            opacity: 0;
            transform: translateY(10px);
            filter: blur(2px);
            transition: opacity 0.42s ease, transform 0.42s cubic-bezier(0.22, 1, 0.36, 1), filter 0.42s ease;
            transition-delay: calc(var(--w-idx, 0) * 18ms);
        }
        .sige-reveal-block.is-visible .sige-word {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }

        .sige-mv-card {
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease, border-color 0.35s ease;
        }
        .sige-mv-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px -12px rgba(0, 26, 41, 0.45), 0 0 28px rgba(98, 227, 29, 0.2);
            border-color: rgba(98, 227, 29, 0.7);
        }

        @media (prefers-reduced-motion: reduce) {
            .sige-reveal-block, .sige-word {
                opacity: 1 !important;
                transform: none !important;
                filter: none !important;
                transition: none !important;
            }
        }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-[#F4F7F6] font-sans antialiased text-[#00131E] flex flex-col min-h-screen selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. NAVBAR SUPERIOR INSTITUCIONAL (SENA ERP) -->
    <!-- ============================================== -->
    <?php
        $panelUrl = route('egresados.dashboard');
        if (Auth::check()) {
            /** @var \App\Models\User|null $user */
            $user = Auth::user();
            $roleSlugs = ($user && $user->roles) ? $user->roles->pluck('slug')->toArray() : [];
            $userEmail = $user ? (string)$user->email : '';
            $userNick  = $user ? (string)$user->nickname : '';
            if ($userNick === 'admin' || in_array('egresados.instructor', $roleSlugs) || in_array('sigac.instructor', $roleSlugs) || $userEmail === 'instructor.egresados@sena.edu.co' || $userNick === 'instructor_egresados') {
                $panelUrl = route('egresados.dashboard_instructor');
            } elseif (in_array('egresados.egresado', $roleSlugs) || in_array('senaempresa.apprentice', $roleSlugs) || in_array('sigac.apprentice', $roleSlugs) || $userEmail === 'egresado.sige@sena.edu.co' || $userNick === 'egresado_sige') {
                $panelUrl = route('egresados.dashboard_egresado');
            } else {
                $panelUrl = route('egresados.dashboard');
            }
        }
    ?>
    <header class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#00131E] text-white shadow-xl sticky top-0 z-50 border-b-[3px] border-[#39A900] backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex justify-between items-center gap-4">
            
            <!-- Brand Logo & Name -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-3 text-white no-underline group font-poppins">
                @include('egresados::partials._sidebar_brand_logo')
                <div>
                    <span class="text-2xl font-black tracking-wider leading-none text-white font-poppins">SIGE</span>
                    <p class="text-[11px] text-[#62E31D] font-bold font-sans mt-0.5">Centro de Formación Agroindustrial</p>
                </div>
            </a>

            <!-- Nav Links relacionados a las secciones de la página -->
            <nav class="hidden lg:flex items-center space-x-1.5 text-xs sm:text-[13px] font-bold font-poppins">
                <a href="#inicio" class="flex items-center space-x-1.5 bg-[#002336] text-[#62E31D] px-4 py-2 rounded-full border border-[#62E31D]/30 shadow-inner">
                    <i class="fa-solid fa-house text-xs"></i>
                    <span>Inicio</span>
                </a>
                <a href="#servicios" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-solid fa-newspaper text-xs"></i>
                    <span>Noticias</span>
                </a>
                <a href="#servicios" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-solid fa-clipboard-check text-xs"></i>
                    <span>Encuestas</span>
                </a>
                <a href="#servicios" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-solid fa-calendar-days text-xs"></i>
                    <span>Eventos</span>
                </a>
                <a href="#contacto" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-solid fa-phone text-xs"></i>
                    <span>Contacto</span>
                </a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-2.5 font-poppins">
                @auth
                    <a href="{{ $panelUrl }}" class="bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226700] text-white px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold shadow-md shadow-[#39A900]/30 transition flex items-center space-x-2">
                        <i class="fa-solid fa-gauge-high text-xs"></i>
                        <span>Ir a mi Panel</span>
                    </a>
                    <form action="{{ route('egresados.logout') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white border border-red-400/30 px-3.5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition flex items-center space-x-1.5" title="Cerrar sesión">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                            <span class="hidden sm:inline">Salir</span>
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </header>

            <!-- ============================================== -->
    <!-- 2. HERO PRINCIPAL DE ALTO IMPACTO (SENA ERP) -->
    <!-- ============================================== -->
    <section id="inicio" class="relative bg-gradient-to-b from-[#EAF7EE]/50 via-[#F4F7F6] to-[#ffffff] py-16 lg:py-24 px-4 sm:px-6 lg:px-8 overflow-hidden border-b border-gray-200/70">
        
        <!-- Subtle background curves con colores del ERP -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#39A900]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-24 w-[500px] h-[500px] bg-[#62E31D]/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center relative z-10">
            
            <!-- Columna Izquierda: Texto Principal & Acciones -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <h1 class="font-poppins text-4xl sm:text-5xl lg:text-[52px] font-black text-[#00131E] leading-[1.14] tracking-tight">
                    Impulsa tu crecimiento profesional con el <span class="text-[#39A900] underline decoration-[#62E31D] decoration-[5px] underline-offset-8">Sistema SIGE</span>.
                </h1>

                <p class="font-sans text-slate-600 text-base sm:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0 font-medium">
                    Conecta con eventos de actualización, noticias institucionales y encuestas de seguimiento del <strong class="text-[#00131E] font-bold">Centro de Formación Agroindustrial La Angostura</strong> a través del sistema SIGE.
                </p>

                <!-- Botones CTA con Mayor Presencia -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-3 font-poppins">
                    @auth
                        <a href="{{ $panelUrl }}" class="bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226700] text-white px-8 py-3.5 rounded-full text-base font-bold shadow-lg shadow-[#39A900]/30 hover:shadow-xl hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                            <i class="fa-solid fa-gauge-high text-sm"></i>
                            <span>Ir a mi Panel ({{ Auth::user()->primary_role }})</span>
                        </a>
                    @else
                        <a href="{{ route('egresados.login') }}" class="bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226700] text-white px-8 py-3.5 rounded-full text-base font-bold shadow-lg shadow-[#39A900]/30 hover:shadow-xl hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                            <i class="fa-solid fa-arrow-right-to-bracket text-sm"></i>
                            <span>Iniciar sesión</span>
                        </a>
                    @endauth
                    <a href="{{ route('egresados.registro') }}" class="bg-white hover:bg-[#EAF7EE] text-[#00131E] hover:text-[#39A900] border-2 border-[#001A29] hover:border-[#39A900] px-7 py-3.5 rounded-full text-base font-bold shadow-sm hover:shadow-md hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                        <i class="fa-solid fa-user-plus text-sm text-[#39A900]"></i>
                        <span>Registrarme como egresado</span>
                    </a>
                </div>

                <!-- Módulos principales del sistema SIGE -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs sm:text-sm text-[#00131E] font-bold border-t border-gray-200/60 max-w-lg mx-auto lg:mx-0 font-poppins">
                    <div class="flex items-center gap-2 hover:text-[#39A900] transition-colors">
                        <span class="w-6 h-6 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-sm">
                            <i class="fa-solid fa-newspaper"></i>
                        </span>
                        <span>Noticias Institucionales</span>
                    </div>
                    <div class="flex items-center gap-2 hover:text-[#39A900] transition-colors">
                        <span class="w-6 h-6 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-sm">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </span>
                        <span>Encuestas de Seguimiento</span>
                    </div>
                    <div class="flex items-center gap-2 hover:text-[#39A900] transition-colors">
                        <span class="w-6 h-6 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-sm">
                            <i class="fa-solid fa-calendar-check"></i>
                        </span>
                        <span>Eventos & Convocatorias</span>
                    </div>
                </div>

            </div>

            <!-- Columna Derecha: Ilustración Principal Destacada y Flotante -->
            <div class="lg:col-span-6 flex justify-center items-center relative lg:pl-4">
                <div class="relative w-full max-w-[540px] sm:max-w-[620px] lg:max-w-[680px] flex items-center justify-center">
                    
                    <!-- Aura y Pulso de Fondo en Verde y Dorado Esmeralda -->
                    <div class="absolute w-[360px] h-[360px] sm:w-[480px] sm:h-[480px] rounded-full bg-gradient-to-tr from-[#39A900]/25 via-[#62E31D]/20 to-[#001A29]/20 blur-3xl animate-glow-pulse pointer-events-none"></div>

                    <!-- Imagen Central Ilustrada sin Fondo (Transparente) con Sombreado Oficial ERP y Movimiento -->
                    <img src="{{ route('egresados.assets.image', 'egresados-banner-transparent.png') }}" alt="Egresados CEFA ¡Contigo Siempre!" class="hero-logo-emblem scale-105 sm:scale-110">
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================== -->
    <!-- 4. QUÉ ENCUENTRAS EN SIGE (CARRUSEL DE IMÁGENES / SENA ERP) -->
    <!-- ============================================== -->
    <section id="servicios" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-[#00131E] via-[#001A29] to-[#00131E] text-white relative overflow-hidden border-t-2 border-b-2 border-[#39A900]/40">
        
        <!-- Luces ambientales de fondo -->
        <div class="absolute -top-32 left-1/4 w-96 h-96 bg-[#39A900]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 right-1/4 w-96 h-96 bg-[#62E31D]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            
            <!-- Encabezado de Sección estilo ERP -->
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="inline-flex items-center gap-2 bg-[#EAF7EE]/10 text-[#62E31D] border border-[#62E31D]/30 text-xs font-black tracking-widest uppercase px-3.5 py-1 rounded-full mb-3 font-poppins">
                    <span class="w-2 h-2 rounded-full bg-[#62E31D] animate-pulse"></span>
                    Ecosistema Institucional
                </span>
                <h2 class="font-poppins text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                    ¿Qué encuentras en SIGE?
                </h2>
                <p class="font-sans text-gray-300 text-sm sm:text-base mt-3 leading-relaxed max-w-2xl mx-auto font-medium">
                    Explora los módulos, oportunidades y herramientas creadas para conectar y potenciar a la comunidad de egresados del CEFA.
                </p>
            </div>

            <!-- CONTENEDOR DEL CARRUSEL 3D (COVERFLOW) -->
            <div class="relative max-w-5xl mx-auto my-6" onmouseenter="pausarCoverflowSige()" onmouseleave="reanudarCoverflowSige()">
                
                <!-- Área de Slides con Altura Fija -->
                <div class="relative h-[400px] sm:h-[440px] md:h-[480px] flex items-center justify-center overflow-hidden">
                    
                    <!-- SLIDE 0: NOTICIAS DE SIGE -->
                    <div id="sigeSlide-0" onclick="clickSlideSige(0)" class="sige-slide absolute w-[290px] sm:w-[420px] md:w-[480px] h-[360px] sm:h-[400px] md:h-[440px] rounded-3xl overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 ease-out cursor-pointer select-none">
                        <img src="{{ $noticiaDestacada['image'] ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $noticiaDestacada['title'] ?? 'Noticias de SIGE' }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                            <span class="bg-[#39A900] text-white text-[11px] font-black px-3 py-1 rounded-full uppercase tracking-wider font-poppins shadow-md">
                                <i class="fa-regular fa-newspaper mr-1"></i> Noticias de SIGE</span>
                            @if(!empty($noticiaDestacada['date']))
                            <span class="bg-black/50 backdrop-blur-md text-[#62E31D] text-[10px] font-bold px-2.5 py-1 rounded-full border border-white/10 font-mono shadow-sm">
                                <i class="fa-regular fa-clock mr-1 text-[9px]"></i>{{ $noticiaDestacada['date'] }}
                            </span>
                            @endif
                            <span class="hidden">
                            </span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 text-left text-white">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs text-[#62E31D] font-bold font-sans tracking-wide uppercase">{{ $noticiaDestacada['category'] ?? 'Actualidad & Novedades' }}</span>
                                @if(!empty($noticiaDestacada['target']))
                                <span class="text-[10px] text-gray-300 bg-white/10 px-2 py-0.5 rounded-full font-mono line-clamp-1">
                                    {{ $noticiaDestacada['target'] }}
                                </span>
                                @endif
                            </div>
                            <h3 class="font-poppins text-lg sm:text-xl md:text-2xl font-black leading-tight mt-1 line-clamp-2 drop-shadow-md">
                                {{ $noticiaDestacada['title'] ?? 'Noticias y Logros de Egresados' }}
                            </h3>
                            <p class="font-sans text-xs sm:text-sm text-gray-200 mt-1.5 line-clamp-2 font-medium">
                                {{ $noticiaDestacada['summary'] ?? 'Historias de éxito de nuestros graduados, convenios del CEFA e innovaciones productivas en el Huila.' }}
                            </p>
                            <div class="mt-3 flex items-center gap-2">
                                <button type="button" data-noticia-id="{{ $destacadaId }}" onclick="event.stopPropagation(); abrirModalNoticia(this.getAttribute('data-noticia-id'))" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#62E31D] hover:text-white bg-[#001A29]/80 hover:bg-[#39A900] px-3.5 py-1.5 rounded-full border border-[#62E31D]/40 transition shadow-sm font-poppins">
                                    <span>Leer noticia completa</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </button>
                            </div>
                            
                        </div>
                    </div>

                    <!-- SLIDE 1: EVENTOS Y TALLERES -->
                    <div id="sigeSlide-1" onclick="clickSlideSige(1)" class="sige-slide absolute w-[290px] sm:w-[420px] md:w-[480px] h-[360px] sm:h-[400px] md:h-[440px] rounded-3xl overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 ease-out cursor-pointer select-none">
                        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=800&q=80" alt="Eventos Institucionales" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                            <span class="bg-blue-600 text-white text-[11px] font-black px-3 py-1 rounded-full uppercase tracking-wider font-poppins shadow-md">
                                <i class="fa-solid fa-calendar-days mr-1"></i> Eventos
                            </span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 text-left text-white">
                            <div class="text-xs text-blue-300 font-bold font-sans">Sede La Angostura</div>
                            <h3 class="font-poppins text-lg sm:text-xl md:text-2xl font-black leading-tight mt-1">Encuentros, Ferias y Capacitaciones</h3>
                            <p class="font-sans text-xs sm:text-sm text-gray-200 mt-1.5 line-clamp-2 font-medium">Jornadas de actualización técnica, ruedas de oportunidades y el gran reencuentro de egresados.</p>
                            
                        </div>
                    </div>

                    <!-- SLIDE 2: ENCUESTAS Y SEGUIMIENTO -->
                    <div id="sigeSlide-2" onclick="clickSlideSige(2)" class="sige-slide absolute w-[290px] sm:w-[420px] md:w-[480px] h-[360px] sm:h-[400px] md:h-[440px] rounded-3xl overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 ease-out cursor-pointer select-none">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=80" alt="Encuestas y Seguimiento" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                            <span class="bg-emerald-600 text-white text-[11px] font-black px-3 py-1 rounded-full uppercase tracking-wider font-poppins shadow-md">
                                <i class="fa-solid fa-chart-pie mr-1"></i> Encuestas
                            </span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 text-left text-white">
                            <div class="text-xs text-emerald-300 font-bold font-sans">Seguimiento de Impacto</div>
                            <h3 class="font-poppins text-lg sm:text-xl md:text-2xl font-black leading-tight mt-1">Tu Experiencia Fortalece al CEFA</h3>
                            <p class="font-sans text-xs sm:text-sm text-gray-200 mt-1.5 line-clamp-2 font-medium">Registra tu situación laboral para mejorar la calidad formativa y acceder a cursos exclusivos.</p>
                            
                        </div>
                    </div>

                    <!-- SLIDE 3: EMPRENDIMIENTO FONDO EMPRENDER -->
                    <div id="sigeSlide-3" onclick="clickSlideSige(3)" class="sige-slide absolute w-[290px] sm:w-[420px] md:w-[480px] h-[360px] sm:h-[400px] md:h-[440px] rounded-3xl overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 ease-out cursor-pointer select-none">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80" alt="Emprendimiento Fondo Emprender" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                            <span class="bg-amber-600 text-white text-[11px] font-black px-3 py-1 rounded-full uppercase tracking-wider font-poppins shadow-md">
                                <i class="fa-solid fa-rocket mr-1"></i> Fondo Emprender
                            </span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 text-left text-white">
                            <div class="text-xs text-amber-300 font-bold font-sans">Capital Semilla & Negocios</div>
                            <h3 class="font-poppins text-lg sm:text-xl md:text-2xl font-black leading-tight mt-1">Impulso a Emprendimientos</h3>
                            <p class="font-sans text-xs sm:text-sm text-gray-200 mt-1.5 line-clamp-2 font-medium">Asesoría técnica y recursos no reembolsables para crear tu propia empresa agroindustrial o de servicios.</p>
                            
                        </div>
                    </div>

                    <!-- SLIDE 4: RED DE EGRESADOS Y COMUNIDAD -->
                    <div id="sigeSlide-4" onclick="clickSlideSige(4)" class="sige-slide absolute w-[290px] sm:w-[420px] md:w-[480px] h-[360px] sm:h-[400px] md:h-[440px] rounded-3xl overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 ease-out cursor-pointer select-none">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Red de Egresados CEFA" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                            <span class="bg-purple-600 text-white text-[11px] font-black px-3 py-1 rounded-full uppercase tracking-wider font-poppins shadow-md">
                                <i class="fa-solid fa-users mr-1"></i> Red de Egresados
                            </span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 text-left text-white">
                            <div class="text-xs text-purple-300 font-bold font-sans">Comunidad Activa</div>
                            <h3 class="font-poppins text-lg sm:text-xl md:text-2xl font-black leading-tight mt-1">Conexión entre Promociones</h3>
                            <p class="font-sans text-xs sm:text-sm text-gray-200 mt-1.5 line-clamp-2 font-medium">Reencuéntrate con compañeros de formación, instructores y genera alianzas estratégicas en la región.</p>
                            
                        </div>
                    </div>

                </div>

                <!-- Botones de Navegación Lateral (Prev & Next) -->
                <button type="button" onclick="slideSigePrev()" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-black/40 hover:bg-[#39A900] text-white hover:text-white border border-white/20 backdrop-blur-md flex items-center justify-center transition shadow-xl z-30" title="Slide anterior">
                    <i class="fa-solid fa-chevron-left text-sm sm:text-base"></i>
                </button>
                <button type="button" onclick="slideSigeNext()" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-black/40 hover:bg-[#39A900] text-white hover:text-white border border-white/20 backdrop-blur-md flex items-center justify-center transition shadow-xl z-30" title="Siguiente slide">
                    <i class="fa-solid fa-chevron-right text-sm sm:text-base"></i>
                </button>

            </div>

            <!-- Indicadores de Puntos (Dots estilo Coverflow) -->
            <div class="flex items-center justify-center gap-2.5 mt-6" id="sigeCoverflowDots">
                <button type="button" onclick="irASlideSige(0)" class="sige-dot w-8 h-2.5 rounded-full bg-[#62E31D] transition-all" title="Ir a Noticias de SIGE"></button>
                <button type="button" onclick="irASlideSige(1)" class="sige-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all" title="Ir a Eventos"></button>
                <button type="button" onclick="irASlideSige(2)" class="sige-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all" title="Ir a Encuestas"></button>
                <button type="button" onclick="irASlideSige(3)" class="sige-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all" title="Ir a Emprendimiento"></button>
                <button type="button" onclick="irASlideSige(4)" class="sige-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all" title="Ir a Red de Egresados"></button>
            </div>

        </div>
    </section>


<!-- ============================================== -->
    <!-- 5. ¿QUIÉNES SOMOS? — MISIÓN Y VISIÓN (SENA ERP) -->
    <!-- ============================================== -->
    @php
        $tituloQuienesSomos = preg_split('/\s+/', '¿Quiénes somos?');
        $misionPalabras = preg_split('/\s+/', 'Fortalecer el vínculo entre los egresados del Centro de Formación Agroindustrial La Angostura y el sector productivo mediante una plataforma tecnológica innovadora que permita centralizar información, realizar seguimiento laboral y facilitar el acceso a oportunidades de empleo, capacitaciones, eventos y noticias, contribuyendo al crecimiento personal y profesional de nuestra comunidad de egresados.');
        $visionPalabras = preg_split('/\s+/', 'Para el año 2030, consolidar a SIGE como una plataforma tecnológica de referencia en la gestión y seguimiento de egresados del Centro de Formación Agroindustrial La Angostura, destacándose por su innovación, accesibilidad y eficiencia en la conexión entre egresados, institución y sector productivo, promoviendo la empleabilidad, la formación continua y el desarrollo profesional.');
    @endphp
    <section id="quienes-somos" class="py-16 px-4 sm:px-6 lg:px-8 bg-white border-t border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto">

            <!-- Encabezado Grande con Revelado al Bajar -->
            <div class="sige-reveal-block text-center max-w-3xl mx-auto mb-12 space-y-3" data-sige-reveal>
                <span class="inline-flex items-center gap-2 bg-[#EAF7EE] text-[#2a7c00] border border-[#39A900]/30 text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest font-poppins shadow-xs">
                    <i class="fa-solid fa-seedling text-[#39A900]"></i>
                    <span>Identidad Institucional · SIGE CEFA</span>
                </span>

                <h2 class="font-poppins text-4xl sm:text-5xl lg:text-[54px] font-black tracking-tight text-[#00131E] leading-tight">
                    @foreach($tituloQuienesSomos as $idx => $palabra)
                        <span class="sige-word {{ $loop->last ? 'text-[#39A900]' : '' }}" style="--w-idx: {{ $idx * 4 }};">{{ $palabra }}</span>{{ !$loop->last ? ' ' : '' }}
                    @endforeach
                </h2>

                <div class="w-24 h-1.5 rounded-full bg-[#39A900] mx-auto"></div>
            </div>

            <!-- 2 Cuadros con Colores Fijos y Bordes Oficiales del ERP (Misión y Visión) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 items-stretch">

                <!-- Cuadro 1: MISIÓN -->
                <article class="sige-reveal-block sige-mv-card relative rounded-3xl bg-[#001A29] p-8 sm:p-10 text-white shadow-xl border-[3px] border-[#39A900] flex flex-col justify-between" data-sige-reveal>
                    <div class="relative z-10 space-y-5">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#39A900] text-white flex items-center justify-center text-xl shadow-md shrink-0 border-2 border-[#62E31D]">
                                    <i class="fa-solid fa-bullseye"></i>
                                </div>
                                <div>
                                    <span class="text-[10.5px] font-extrabold uppercase tracking-widest text-[#62E31D] font-poppins block">Propósito SIGE</span>
                                    <h3 class="font-poppins text-2xl sm:text-3xl font-black text-white tracking-tight leading-none">Misión</h3>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-[#002336] text-[#62E31D] border border-[#39A900] font-poppins">CEFA La Angostura</span>
                        </div>

                        <div class="h-0.5 w-full bg-[#39A900]"></div>

                        <p class="font-sans text-[15px] sm:text-base text-slate-100 leading-relaxed font-medium text-justify">
                            @foreach($misionPalabras as $idx => $palabra)
                                <span class="sige-word" style="--w-idx: {{ $idx + 2 }};">{{ $palabra }}</span>{{ !$loop->last ? ' ' : '' }}
                            @endforeach
                        </p>
                    </div>
                </article>

                <!-- Cuadro 2: VISIÓN -->
                <article class="sige-reveal-block sige-mv-card relative rounded-3xl bg-[#2a7c00] p-8 sm:p-10 text-white shadow-xl border-[3px] border-[#001A29] flex flex-col justify-between" style="transition-delay: 140ms;" data-sige-reveal>
                    <div class="relative z-10 space-y-5">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#001A29] text-[#62E31D] border-2 border-[#62E31D] flex items-center justify-center text-xl shadow-md shrink-0">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <div>
                                    <span class="text-[10.5px] font-extrabold uppercase tracking-widest text-[#d9ffbf] font-poppins block">Proyección Estratégica</span>
                                    <h3 class="font-poppins text-2xl sm:text-3xl font-black text-white tracking-tight leading-none">Visión</h3>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-[#001A29] text-[#62E31D] border border-[#62E31D] font-poppins">Horizonte 2030</span>
                        </div>

                        <div class="h-0.5 w-full bg-[#001A29]"></div>

                        <p class="font-sans text-[15px] sm:text-base text-white leading-relaxed font-medium text-justify">
                            @foreach($visionPalabras as $idx => $palabra)
                                <span class="sige-word" style="--w-idx: {{ $idx + 4 }};">{{ $palabra }}</span>{{ !$loop->last ? ' ' : '' }}
                            @endforeach
                        </p>
                    </div>
                </article>

            </div>

        </div>
    </section>

    <!-- ============================================== -->
    <!-- 6. FOOTER ESTRUCTURADO Y JERÁRQUICO (SENA ERP) -->
    <!-- ============================================== -->
    <footer id="contacto" class="bg-[#00131E] text-white pt-16 pb-8 px-4 sm:px-6 lg:px-8 border-t-4 border-[#39A900]">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                
                <!-- Columna 1: SENA / CEFA -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-md flex items-center justify-center border-2 border-[#62E31D]/80 bg-white shrink-0 p-1">
                            <img src="{{ route('egresados.assets.image', 'sena-empresa-logo.png') }}" alt="Logo SENA Empresa" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h4 class="font-poppins font-black text-base text-white leading-tight">SENA Empresa</h4>
                            <span class="text-xs text-[#62E31D] font-bold font-poppins">CEFA La Angostura</span>
                        </div>
                    </div>
                    <p class="font-sans text-xs sm:text-sm text-gray-300 leading-relaxed font-medium">
                        Centro de Formación Agroindustrial La Angostura. Regional Huila, Campoalegre.
                    </p>
                    <p class="font-cursive text-2xl text-[#62E31D] font-bold">
                        ¡Contigo Siempre!
                    </p>
                </div>

                <!-- Columna 2: Plataforma SIGE -->
                <div>
                    <h4 class="font-poppins text-xs uppercase tracking-widest text-[#62E31D] font-black mb-4">Plataforma SIGE</h4>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-gray-300 font-sans font-medium">
                        <li><a href="#servicios" onclick="irASlideSige(0)" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Noticias</a></li>
                        <li><a href="#servicios" onclick="irASlideSige(2)" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Encuestas</a></li>
                        <li><a href="#servicios" onclick="irASlideSige(1)" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Eventos</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Sede y Contacto -->
                <div>
                    <h4 class="font-poppins text-xs uppercase tracking-widest text-[#62E31D] font-black mb-4">Sede y Contacto</h4>
                    <ul class="space-y-3 text-xs sm:text-sm text-gray-300 font-sans font-medium">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-[#39A900] mt-0.5"></i>
                            <span>Kilómetro 38 Vía Neiva - Campoalegre (Huila)</span>
                        </li>
                        <li>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=angostura@sena.edu.co" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 hover:text-[#62E31D] transition-colors group" title="Redirigir a Gmail para redactar correo">
                                <i class="fa-solid fa-envelope text-[#39A900] group-hover:text-[#62E31D] transition-colors"></i>
                                <span class="group-hover:underline">angostura@sena.edu.co</span>
                            </a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i class="fa-solid fa-clock text-[#39A900]"></i>
                            <span>Lun - Vie: 7:30 AM - 4:30 PM</span>
                        </li>
                    </ul>
                </div>

                <!-- Columna 4: Comunidad y Redes -->
                <div>
                    <h4 class="font-poppins text-xs uppercase tracking-widest text-[#62E31D] font-black mb-4">Comunidad</h4>
                    <p class="font-sans text-xs text-gray-300 mb-4 font-medium">Síguenos en nuestros canales oficiales para estar al día con las novedades:</p>
                    <div class="flex items-center space-x-3">
                        <a href="https://www.facebook.com/share/1A6p2yyUDc/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-[#1877F2] text-white flex items-center justify-center text-base transition-all duration-200 hover:scale-110 shadow-sm" title="Síguenos en Facebook Oficial">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400 gap-4 font-sans font-medium text-center sm:text-left">
                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5">
                    <p>© {{ date('Y') }} <strong class="text-white font-poppins">SIGE — Sistema de Gestión de Egresados</strong> • SENA Empresa. Todos los derechos reservados.</p>
                    <a href="{{ route('egresados.autores') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#43be04] hover:to-[#39A900] text-white font-poppins font-bold text-xs shadow-md transition-all duration-200 hover:scale-105 border border-[#62E31D]/40 group" title="Ver equipo de autores y desarrolladores de SIGE">
                        <i class="fa-solid fa-users text-[#62E31D] group-hover:text-white transition"></i>
                        <span>Autores</span>
                        <i class="fa-solid fa-arrow-right text-[10px] opacity-80"></i>
                    </a>
                </div>
                <p class="text-[#62E31D] font-bold font-poppins shrink-0">Centro de Formación Agroindustrial "La Angostura"</p>
            </div>

        </div>
    </footer>


    <!-- ============================================== -->
        <!-- ============================================== -->
    <!-- MODAL DETALLE DE NOTICIA INSTITUCIONAL (SENA ERP) -->
    <!-- ============================================== -->
    <div id="modalVerNoticiaLanding" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/75 backdrop-blur-sm transition-opacity duration-300" onclick="if(event.target === this) cerrarModalNoticia()">
        <div class="relative bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-hidden shadow-2xl flex flex-col border border-gray-200">
            
            <!-- Header Modal con Gradiente SENA ERP -->
            <div class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] px-6 py-4 flex items-center justify-between border-b-2 border-[#39A900] text-white">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#39A900]/20 border border-[#62E31D]/40 flex items-center justify-center text-[#62E31D]">
                        <i class="fa-solid fa-newspaper text-base"></i>
                    </div>
                    <div>
                        <span id="modalNoticiaCategory" class="text-[11px] font-bold text-[#62E31D] uppercase tracking-wider font-mono">Actualidad</span>
                        <h4 class="font-poppins font-black text-base sm:text-lg text-white leading-tight">Comunicado Institucional SIGE</h4>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalNoticia()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-gray-300 hover:text-white flex items-center justify-center transition" title="Cerrar ventana">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Cuerpo Modal con Scroll -->
            <div class="p-6 overflow-y-auto flex-1 space-y-5">
                
                <!-- Imagen Destacada de la Noticia -->
                <div class="relative h-56 sm:h-64 rounded-2xl overflow-hidden bg-slate-900 border border-gray-100 shadow-md">
                    <img id="modalNoticiaImg" src="" alt="Imagen Noticia" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                        <span id="modalNoticiaDate" class="bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-full font-mono text-[11px] text-gray-200 border border-white/20"></span>
                        <span id="modalNoticiaTarget" class="bg-[#39A900] px-2.5 py-1 rounded-full font-bold text-[11px] text-white shadow-sm font-sans"></span>
                    </div>
                </div>

                <!-- Título -->
                <div>
                    <h3 id="modalNoticiaTitle" class="font-poppins font-black text-xl sm:text-2xl text-[#00131E] leading-snug"></h3>
                    <div class="flex items-center gap-2 mt-2 text-xs text-gray-500 font-sans">
                        <i class="fa-solid fa-user-pen text-[#39A900]"></i>
                        <span id="modalNoticiaAuthor" class="font-bold"></span>
                    </div>
                </div>

                <!-- Resumen Resaltado -->
                <div class="bg-[#EAF7EE]/70 border-l-4 border-[#39A900] p-4 rounded-r-2xl">
                    <p id="modalNoticiaSummary" class="text-xs sm:text-sm text-gray-800 font-medium italic leading-relaxed"></p>
                </div>

                <!-- Contenido Completo -->
                <div id="modalNoticiaContent" class="text-sm text-gray-700 leading-relaxed space-y-3 font-sans border-t border-gray-100 pt-4">
                </div>

            </div>

            <!-- Footer Modal -->
            <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-200 flex items-center justify-between">
                <span class="text-xs text-gray-500 font-medium">SIGE · CEFA La Angostura</span>
                <button type="button" onclick="cerrarModalNoticia()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-[#001A29] to-[#002336] hover:from-[#39A900] hover:to-[#2d8500] text-white text-xs font-bold transition shadow-sm font-poppins">
                    Cerrar Comunicado
                </button>
            </div>

        </div>
    </div>

    <!-- SCRIPT DEL CARRUSEL DE IMÁGENES "¿QUÉ ENCUENTRAS EN SIGE?" -->
    <!-- ============================================== -->
    <script id="sigeNoticiasPublicadasData" type="text/template" data-destacada-id="<?php echo $destacadaId; ?>">
<?php echo $noticiasJson; ?>
    </script>

    <script>
        let currentSigeSlide = 0;
        const totalSigeSlides = 5;
        let sigeCoverflowTimer = null;

        const sigeNoticiasScriptEl = document.getElementById('sigeNoticiasPublicadasData');
        const sigeNoticiasPublicadas = sigeNoticiasScriptEl ? JSON.parse(sigeNoticiasScriptEl.textContent || '[]') : [];
        const sigeNoticiaDestacadaId = sigeNoticiasScriptEl ? (sigeNoticiasScriptEl.getAttribute('data-destacada-id') || 'NOT-001') : 'NOT-001';

        function abrirModalNoticia(id) {
            let noticia = sigeNoticiasPublicadas.find(n => n.id === id);
            if (!noticia && sigeNoticiasPublicadas.length > 0) {
                noticia = sigeNoticiasPublicadas[0];
            }
            if (!noticia) return;

            document.getElementById('modalNoticiaImg').src = noticia.image || 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80';
            document.getElementById('modalNoticiaCategory').textContent = noticia.category || 'Actualidad';
            document.getElementById('modalNoticiaTitle').textContent = noticia.title || '';
            document.getElementById('modalNoticiaSummary').textContent = noticia.summary || '';
            document.getElementById('modalNoticiaAuthor').textContent = (noticia.author || 'CEFA La Angostura') + (noticia.author_role ? ' · ' + noticia.author_role : '');
            document.getElementById('modalNoticiaDate').textContent = noticia.date || '';
            document.getElementById('modalNoticiaTarget').textContent = noticia.target || 'Comunidad CEFA';
            
            const contentEl = document.getElementById('modalNoticiaContent');
            const paragraphs = (noticia.content || noticia.summary || '').split('\n').filter(p => p.trim().length > 0);
            contentEl.innerHTML = paragraphs.map(p => `<p class="mb-3 text-gray-700 leading-relaxed font-sans">${p}</p>`).join('');

            const modal = document.getElementById('modalVerNoticiaLanding');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
            document.body.style.overflow = 'hidden';
        }

        function cerrarModalNoticia() {
            const modal = document.getElementById('modalVerNoticiaLanding');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            document.body.style.overflow = '';
        }

        function renderCoverflowSige() {
            const isMobile = window.innerWidth < 640;
            const xOffset = isMobile ? 68 : 62;

            for (let i = 0; i < totalSigeSlides; i++) {
                const el = document.getElementById(`sigeSlide-${i}`);
                if (!el) continue;

                // Calcular posición relativa respecto al slide activo (-2, -1, 0, 1, 2)
                let diff = i - currentSigeSlide;
                if (diff > totalSigeSlides / 2) diff -= totalSigeSlides;
                if (diff < -totalSigeSlides / 2) diff += totalSigeSlides;

                if (diff === 0) {
                    // Centro / Activo
                    el.style.transform = 'translateX(0%) scale(1)';
                    el.style.zIndex = '20';
                    el.style.opacity = '1';
                    el.style.filter = 'none';
                    el.style.pointerEvents = 'auto';
                    el.className = el.className.replace(/border-[\w-]+/g, '') + ' border-2 border-[#39A900] ring-4 ring-[#39A900]/30 shadow-2xl';
                } else if (diff === -1) {
                    // Anterior / Izquierda
                    el.style.transform = `translateX(-${xOffset}%) scale(0.85)`;
                    el.style.zIndex = '10';
                    el.style.opacity = '0.55';
                    el.style.filter = 'brightness(0.75)';
                    el.style.pointerEvents = 'auto';
                    el.className = el.className.replace(/border-[\w-]+/g, '') + ' border border-white/20 shadow-xl';
                } else if (diff === 1) {
                    // Siguiente / Derecha
                    el.style.transform = `translateX(${xOffset}%) scale(0.85)`;
                    el.style.zIndex = '10';
                    el.style.opacity = '0.55';
                    el.style.filter = 'brightness(0.75)';
                    el.style.pointerEvents = 'auto';
                    el.className = el.className.replace(/border-[\w-]+/g, '') + ' border border-white/20 shadow-xl';
                } else {
                    // Fuera de vista
                    const sign = diff < 0 ? -1 : 1;
                    el.style.transform = `translateX(${sign * 110}%) scale(0.65)`;
                    el.style.zIndex = '0';
                    el.style.opacity = '0';
                    el.style.filter = 'brightness(0.5)';
                    el.style.pointerEvents = 'none';
                }
            }

            // Actualizar puntos
            const dots = document.querySelectorAll('.sige-dot');
            if (dots && dots.length) {
                dots.forEach((dot, idx) => {
                    if (idx === currentSigeSlide) {
                        dot.className = 'sige-dot w-8 h-2.5 rounded-full bg-[#62E31D] transition-all shadow-sm';
                    } else {
                        dot.className = 'sige-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all';
                    }
                });
            }
        }

        function slideSigeNext() {
            currentSigeSlide = (currentSigeSlide + 1) % totalSigeSlides;
            renderCoverflowSige();
        }

        function slideSigePrev() {
            currentSigeSlide = (currentSigeSlide - 1 + totalSigeSlides) % totalSigeSlides;
            renderCoverflowSige();
        }

        function irASlideSige(idx) {
            currentSigeSlide = idx;
            renderCoverflowSige();
            reiniciarTimerCoverflowSige();
        }

        function clickSlideSige(idx) {
            if (idx !== currentSigeSlide) {
                irASlideSige(idx);
            } else if (idx === 0) {
                abrirModalNoticia(sigeNoticiaDestacadaId);
            }
        }

        function iniciarTimerCoverflowSige() {
            if (!sigeCoverflowTimer) {
                sigeCoverflowTimer = setInterval(slideSigeNext, 5000);
            }
        }

        function pausarCoverflowSige() {
            if (sigeCoverflowTimer) {
                clearInterval(sigeCoverflowTimer);
                sigeCoverflowTimer = null;
            }
        }

        function reanudarCoverflowSige() {
            iniciarTimerCoverflowSige();
        }

        function reiniciarTimerCoverflowSige() {
            pausarCoverflowSige();
            reanudarCoverflowSige();
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderCoverflowSige();
            iniciarTimerCoverflowSige();
            window.addEventListener('resize', renderCoverflowSige);

            // Animación progresiva al hacer scroll hacia "¿Quiénes somos?"
            const revealBlocks = document.querySelectorAll('[data-sige-reveal]');
            if (revealBlocks.length) {
                if ('IntersectionObserver' in window) {
                    const revealObserver = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                                observer.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.14, rootMargin: '0px 0px -40px 0px' });

                    revealBlocks.forEach(el => revealObserver.observe(el));
                } else {
                    revealBlocks.forEach(el => el.classList.add('is-visible'));
                }
            }
        });
    </script>

</body>
</html>
