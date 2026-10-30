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

        /* Smooth scroll */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-[#F4F7F6] font-sans antialiased text-[#00131E] flex flex-col min-h-screen selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. NAVBAR SUPERIOR INSTITUCIONAL (SENA ERP) -->
    <!-- ============================================== -->
    @php
        $panelUrl = route('egresados.dashboard');
        if (Auth::check()) {
            $user = Auth::user();
            $roleSlugs = $user->roles ? $user->roles->pluck('slug')->toArray() : [];
            if ($user->nickname === 'admin' || in_array('egresados.instructor', $roleSlugs) || in_array('sigac.instructor', $roleSlugs) || $user->email === 'instructor.egresados@sena.edu.co' || $user->nickname === 'instructor_egresados') {
                $panelUrl = route('egresados.dashboard_instructor');
            } elseif (in_array('egresados.egresado', $roleSlugs) || in_array('senaempresa.apprentice', $roleSlugs) || in_array('sigac.apprentice', $roleSlugs) || $user->email === 'egresado.sige@sena.edu.co' || $user->nickname === 'egresado_sige') {
                $panelUrl = route('egresados.dashboard_egresado');
            } else {
                $panelUrl = route('egresados.dashboard');
            }
        }
    @endphp
    <header class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#00131E] text-white shadow-xl sticky top-0 z-50 border-b-[3px] border-[#39A900] backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex justify-between items-center gap-4">
            
            <!-- Brand Logo & Name -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-3 text-white no-underline group font-poppins">
                <div class="w-11 h-11 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition border-2 border-white/80 flex items-center justify-center bg-[#39A900] shrink-0">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover rounded-full">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black tracking-wider leading-none text-white font-poppins">SIGE</span>
                        <span class="bg-[#39A900] text-white text-[10px] font-black px-2 py-0.5 rounded-full uppercase tracking-wider font-poppins">CEFA</span>
                    </div>
                    <p class="text-[11px] text-[#62E31D] font-bold font-sans">Sistema de Gestión de Egresados</p>
                </div>
            </a>

            <!-- Nav Links -->
            <nav class="hidden lg:flex items-center space-x-1 text-xs sm:text-[13px] font-bold font-poppins">
                <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-1.5 bg-[#002336] text-[#62E31D] px-4 py-2 rounded-full border border-[#62E31D]/30 shadow-inner">
                    <i class="fa-solid fa-house text-xs"></i>
                    <span>Inicio</span>
                </a>
                <a href="#servicios" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-regular fa-newspaper text-xs"></i>
                    <span>Noticias de SIGE</span>
                </a>
                <a href="#servicios" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-regular fa-calendar-days text-xs"></i>
                    <span>Eventos</span>
                </a>
                <a href="{{ route('egresados.index') }}" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-solid fa-clipboard-list text-xs"></i>
                    <span>Encuestas</span>
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
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white border border-red-400/30 px-3.5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition flex items-center space-x-1.5" title="Cerrar sesión">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                            <span class="hidden sm:inline">Salir</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login', ['redirect' => route('egresados.welcome')]) }}" class="bg-[#002336] hover:bg-[#00324D] border border-white/20 hover:border-[#62E31D] text-white px-4 sm:px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition flex items-center space-x-2">
                        <i class="fa-regular fa-user text-xs"></i>
                        <span>Iniciar sesión</span>
                    </a>
                    <a href="{{ route('egresados.registro') }}" class="bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226700] text-white px-4 sm:px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold shadow-md shadow-[#39A900]/30 hover:shadow-lg transition flex items-center space-x-2">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Registrarse</span>
                    </a>
                @endauth
            </div>

        </div>
    </header>

            <!-- ============================================== -->
    <!-- 2. HERO PRINCIPAL DE ALTO IMPACTO (SENA ERP) -->
    <!-- ============================================== -->
    <section class="relative bg-gradient-to-b from-[#EAF7EE]/50 via-[#F4F7F6] to-[#ffffff] py-16 lg:py-24 px-4 sm:px-6 lg:px-8 overflow-hidden border-b border-gray-200/70">
        
        <!-- Subtle background curves con colores del ERP -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#39A900]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-24 w-[500px] h-[500px] bg-[#62E31D]/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center relative z-10">
            
            <!-- Columna Izquierda: Texto Principal & Acciones -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <div class="inline-flex items-center space-x-2 bg-white text-[#00131E] text-xs sm:text-sm font-bold px-4 py-1.5 rounded-full shadow-sm border border-[#39A900]/30 font-poppins">
                    <span class="text-base">👋</span>
                    <span>Comunidad de Egresados CEFA</span>
                </div>

                <h1 class="font-poppins text-4xl sm:text-5xl lg:text-[54px] font-black text-[#00131E] leading-[1.12] tracking-tight">
                    De la formación a la <span class="text-[#39A900] underline decoration-[#62E31D] decoration-[5px] underline-offset-8">cosecha</span> profesional.
                </h1>

                <p class="font-sans text-slate-600 text-base sm:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0 font-medium">
                    Conecta con las noticias de la comunidad, eventos de actualización y los egresados del <strong class="text-[#00131E] font-bold">Centro de Formación Agroindustrial La Angostura</strong>. Tu camino formativo sigue dando frutos.
                </p>

                <!-- Botones CTA con Mayor Presencia -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-3 font-poppins">
                    @auth
                        <a href="{{ $panelUrl }}" class="bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226700] text-white px-8 py-3.5 rounded-full text-base font-bold shadow-lg shadow-[#39A900]/30 hover:shadow-xl hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                            <i class="fa-solid fa-gauge-high text-sm"></i>
                            <span>Ir a mi Panel ({{ Auth::user()->primary_role }})</span>
                        </a>
                    @else
                        <a href="{{ route('login', ['redirect' => route('egresados.welcome')]) }}" class="bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226700] text-white px-8 py-3.5 rounded-full text-base font-bold shadow-lg shadow-[#39A900]/30 hover:shadow-xl hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                            <i class="fa-solid fa-arrow-right-to-bracket text-sm"></i>
                            <span>Iniciar sesión</span>
                        </a>
                    @endauth
                    <a href="{{ route('egresados.registro') }}" class="bg-white hover:bg-[#EAF7EE] text-[#00131E] hover:text-[#39A900] border-2 border-[#001A29] hover:border-[#39A900] px-7 py-3.5 rounded-full text-base font-bold shadow-sm hover:shadow-md hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                        <i class="fa-solid fa-user-plus text-sm text-[#39A900]"></i>
                        <span>Registrarme como egresado</span>
                    </a>
                </div>

                <!-- Badges de confianza -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs sm:text-sm text-[#00131E] font-bold border-t border-gray-200/60 max-w-lg mx-auto lg:mx-0 font-poppins">
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                        <span>Noticias & Logros</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                        <span>Fondo Emprender</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                        <span>Red de Contactos</span>
                    </div>
                </div>

            </div>

            <!-- Columna Derecha: Ilustración Principal Destacada y Flotante -->
            <div class="lg:col-span-6 flex justify-center items-center relative lg:pl-4">
                <div class="relative w-full max-w-[540px] sm:max-w-[620px] lg:max-w-[680px] flex items-center justify-center">
                    
                    <!-- Aura y Pulso de Fondo en Verde y Dorado Esmeralda -->
                    <div class="absolute w-[360px] h-[360px] sm:w-[480px] sm:h-[480px] rounded-full bg-gradient-to-tr from-[#39A900]/25 via-[#62E31D]/20 to-[#001A29]/20 blur-3xl animate-glow-pulse pointer-events-none"></div>

                    <!-- Badge Flotante 1: Comunidad Activa -->
                    <div class="absolute -top-4 -left-2 sm:top-2 sm:left-4 z-20 bg-white/95 backdrop-blur-md px-4 py-2.5 rounded-2xl shadow-lg border border-[#EAF7EE] flex items-center gap-2.5 animate-bounce font-poppins" style="animation-duration: 4s;">
                        <span class="w-8 h-8 rounded-full bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                        <div>
                            <div class="text-[11.5px] font-bold text-[#00131E] leading-tight">+1.240 Egresados</div>
                            <div class="text-[9.5px] text-[#166534] font-bold font-sans">Comunidad Activa</div>
                        </div>
                    </div>

                    <!-- Imagen Central Ilustrada con Gran Escala y Fondo Integrado -->
                    <img src="{{ route('egresados.assets.image', 'egresados-banner.png') }}" alt="Egresados CEFA ¡Contigo Siempre!" class="relative z-10 w-full h-auto object-contain drop-shadow-2xl animate-float-hero select-none pointer-events-none mix-blend-multiply scale-105 sm:scale-110">
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
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" alt="Noticias de SIGE" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-[#39A900] text-white text-[11px] font-black px-3 py-1 rounded-full uppercase tracking-wider font-poppins shadow-md">
                                <i class="fa-regular fa-newspaper mr-1"></i> Noticias de SIGE
                            </span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 text-left text-white">
                            <div class="text-xs text-[#62E31D] font-bold font-sans">Actualidad & Novedades</div>
                            <h3 class="font-poppins text-lg sm:text-xl md:text-2xl font-black leading-tight mt-1">Noticias y Logros de Egresados</h3>
                            <p class="font-sans text-xs sm:text-sm text-gray-200 mt-1.5 line-clamp-2 font-medium">Historias de éxito de nuestros graduados, convenios del CEFA e innovaciones productivas en el Huila.</p>
                            
                        </div>
                    </div>

                    <!-- SLIDE 1: EVENTOS Y TALLERES -->
                    <div id="sigeSlide-1" onclick="clickSlideSige(1)" class="sige-slide absolute w-[290px] sm:w-[420px] md:w-[480px] h-[360px] sm:h-[400px] md:h-[440px] rounded-3xl overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 ease-out cursor-pointer select-none">
                        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=800&q=80" alt="Eventos Institucionales" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00131E] via-[#00131E]/40 to-transparent"></div>
                        <div class="absolute top-4 left-4">
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
                        <div class="absolute top-4 left-4">
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
                        <div class="absolute top-4 left-4">
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
                        <div class="absolute top-4 left-4">
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
    <!-- 5. CTA DE REGISTRO LLAMATIVO Y GRANDE (SENA ERP) -->
    <!-- ============================================== -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <div class="relative rounded-3xl bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] p-8 sm:p-12 lg:p-16 shadow-xl overflow-hidden text-white border border-[#39A900]/40">
                
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-[#39A900]/25 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#62E31D]/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <div class="lg:col-span-8 space-y-4 text-center lg:text-left">
                        <span class="bg-white/15 text-[#62E31D] text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider inline-block font-poppins">
                            Comunidad Activa
                        </span>
                        <h2 class="font-poppins text-3xl sm:text-4xl lg:text-5xl font-black leading-tight text-white">
                            ¿Ya eres egresado del CEFA?
                        </h2>
                        <p class="font-sans text-green-100/90 text-base sm:text-lg max-w-2xl leading-relaxed font-medium">
                            Haz parte de nuestra comunidad oficial y mantente conectado con novedades institucionales, formación continua y alianzas estratégicas.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex justify-center lg:justify-end">
                        <a href="{{ route('egresados.registro') }}" class="font-poppins bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#62E31D] hover:to-[#39A900] hover:text-[#00131E] text-white px-8 py-4 rounded-full text-base font-extrabold shadow-lg shadow-[#39A900]/30 hover:shadow-2xl hover:scale-105 transition duration-300 flex items-center space-x-3 text-center">
                            <i class="fa-solid fa-user-plus text-lg"></i>
                            <span>Registrarme como egresado</span>
                        </a>
                    </div>

                </div>

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
                        <div class="w-11 h-11 rounded-full overflow-hidden shadow-sm flex items-center justify-center border-2 border-white/80 bg-[#39A900] shrink-0">
                            <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover rounded-full">
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
                        <li><a href="#servicios" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Noticias de SIGE</a></li>
                        <li><a href="#servicios" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Eventos y talleres</a></li>
                        <li><a href="{{ route('egresados.index') }}" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Encuestas y seguimiento</a></li>
                        <li><a href="{{ route('egresados.index') }}" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#39A900]"></i> Directorio de egresados</a></li>
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
                        <li class="flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-[#39A900]"></i>
                            <span>angostura@sena.edu.co</span>
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
                        <a href="https://facebook.com" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#39A900] text-white flex items-center justify-center text-sm transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://instagram.com" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#39A900] text-white flex items-center justify-center text-sm transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://youtube.com" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#39A900] text-white flex items-center justify-center text-sm transition"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400 gap-4 font-sans font-medium">
                <p>© {{ date('Y') }} <strong class="text-white font-poppins">SIGE — Sistema de Gestión de Egresados CEFA</strong> • SENA Empresa. Todos los derechos reservados.</p>
                <p class="text-[#62E31D] font-bold font-poppins">Centro de Formación Agroindustrial "La Angostura"</p>
            </div>

        </div>
    </footer>


    <!-- ============================================== -->
    <!-- SCRIPT DEL CARRUSEL DE IMÁGENES "¿QUÉ ENCUENTRAS EN SIGE?" -->
    <!-- ============================================== -->
    <script>
        let currentSigeSlide = 0;
        const totalSigeSlides = 5;
        let sigeCoverflowTimer = null;

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
        });
    </script>

</body>
</html>
