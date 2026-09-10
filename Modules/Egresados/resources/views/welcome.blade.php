<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Sistema de Gestión de Egresados — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces (Editorial) + Plus Jakarta Sans / Inter + Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                        senaForest: '#013819',
                        senaForestDeep: '#012410',
                        senaNeon: '#62E31D',
                        senaLight: '#F3FAF4',
                        senaLightWarm: '#F9F7F1',
                        senaWarm: '#F5EFEB',
                        senaGold: '#B9812E',
                        senaGoldLight: '#E8CA93',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        editorial: ['Fraunces', 'serif'],
                        cursive: ['Caveat', 'cursive'],
                    }
                }
            }
        }
    </script>

    <style>
        .font-editorial { font-family: 'Fraunces', serif; }
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
            box-shadow: 0 20px 35px -8px rgba(1, 56, 25, 0.12);
        }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-[#FCFCFA] font-sans antialiased text-[#1A2E22] flex flex-col min-h-screen selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. NAVBAR SUPERIOR INSTITUCIONAL -->
    <!-- ============================================== -->
    <header class="bg-[#013819] text-white shadow-lg sticky top-0 z-50 border-b border-[#39A900]/30 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex justify-between items-center gap-4">
            
            <!-- Brand Logo & Name -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-3 text-white no-underline group">
                <div class="w-11 h-11 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition border-2 border-white/80 flex items-center justify-center bg-[#39A900] shrink-0">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover rounded-full">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-editorial text-2xl font-bold tracking-wider leading-none">SIGE</span>
                        <span class="bg-[#39A900] text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">CEFA</span>
                    </div>
                    <p class="text-[11px] text-green-200/90 font-medium">Sistema de Gestión de Egresados</p>
                </div>
            </a>

            <!-- Nav Links -->
            <nav class="hidden lg:flex items-center space-x-1 text-sm font-semibold">
                <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-1.5 bg-[#0a5225] text-[#62E31D] px-4 py-2 rounded-full shadow-inner">
                    <i class="fa-solid fa-house text-xs"></i>
                    <span>Inicio</span>
                </a>
                <a href="#servicios" class="flex items-center space-x-1.5 text-gray-200 hover:text-[#62E31D] hover:bg-white/5 px-4 py-2 rounded-full transition">
                    <i class="fa-solid fa-briefcase text-xs"></i>
                    <span>Ofertas laborales</span>
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
            <div class="flex items-center space-x-2.5">
                @auth
                    <a href="{{ route('login') }}" class="bg-[#39A900] hover:bg-[#2a7c00] text-white px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold shadow-md transition flex items-center space-x-2">
                        <i class="fa-solid fa-gauge-high text-xs"></i>
                        <span>Ir a mi Panel</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white border border-red-400/30 px-3.5 py-2 rounded-full text-xs sm:text-sm font-bold transition flex items-center space-x-1.5" title="Cerrar sesión">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                            <span class="hidden sm:inline">Salir</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-black/25 hover:bg-black/40 border border-white/25 hover:border-[#62E31D] text-white px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold transition flex items-center space-x-2">
                        <i class="fa-regular fa-user text-xs"></i>
                        <span>Iniciar sesión</span>
                    </a>
                    <a href="{{ route('egresados.create') }}" class="bg-[#39A900] hover:bg-[#2e8700] text-white px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold shadow-md hover:shadow-lg transition flex items-center space-x-2">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Registrarse</span>
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <!-- ============================================== -->
    <!-- 2. HERO PRINCIPAL DE ALTO IMPACTO -->
    <!-- ============================================== -->
    <section class="relative bg-gradient-to-b from-[#F2FAF4] via-[#F8FCF9] to-[#FCFCFA] py-16 lg:py-24 px-4 sm:px-6 lg:px-8 overflow-hidden border-b border-gray-200/70">
        
        <!-- Subtle background curves -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-green-200/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-24 w-[500px] h-[500px] bg-emerald-100/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center relative z-10">
            
            <!-- Columna Izquierda: Texto Principal & Acciones -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <div class="inline-flex items-center space-x-2 bg-white text-[#013819] text-xs sm:text-sm font-bold px-4 py-1.5 rounded-full shadow-sm border border-green-200/60">
                    <span class="text-base">👋</span>
                    <span>Comunidad de Egresados CEFA</span>
                </div>

                <h1 class="font-editorial text-4xl sm:text-5xl lg:text-[54px] font-bold text-[#012410] leading-[1.12] tracking-tight">
                    De la formación a la <em class="italic text-[#0d6928] not-italic underline decoration-[#62E31D] decoration-4 underline-offset-8">cosecha</em> profesional.
                </h1>

                <p class="text-gray-600 text-base sm:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Conecta con oportunidades laborales, eventos de actualización y la comunidad de egresados del <strong>Centro de Formación Agroindustrial La Angostura</strong>. Tu camino formativo sigue dando frutos.
                </p>

                <!-- Botones CTA con Mayor Presencia -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-3">
                    @auth
                        <a href="{{ route('login') }}" class="bg-[#39A900] hover:bg-[#2a7c00] text-white px-8 py-3.5 rounded-full text-base font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                            <i class="fa-solid fa-gauge-high text-sm"></i>
                            <span>Ir a mi Panel ({{ Auth::user()->primary_role }})</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-[#39A900] hover:bg-[#2a7c00] text-white px-8 py-3.5 rounded-full text-base font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                            <i class="fa-solid fa-arrow-right-to-bracket text-sm"></i>
                            <span>Iniciar sesión</span>
                        </a>
                    @endauth
                    <a href="{{ route('egresados.create') }}" class="bg-white hover:bg-gray-50 text-[#013819] border-2 border-[#013819] hover:border-[#39A900] px-7 py-3.5 rounded-full text-base font-bold shadow-sm hover:shadow-md hover:-translate-y-0.5 transition flex items-center space-x-2.5">
                        <i class="fa-solid fa-user-plus text-sm text-[#39A900]"></i>
                        <span>Registrarme como egresado</span>
                    </a>
                </div>

                <!-- Badges de confianza -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs sm:text-sm text-gray-500 font-semibold border-t border-gray-200/60 max-w-lg mx-auto lg:mx-0">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-[#39A900]"></i>
                        <span>Bolsa de Empleo APE</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-[#39A900]"></i>
                        <span>Fondo Emprender</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-[#39A900]"></i>
                        <span>Red de Contactos</span>
                    </div>
                </div>

            </div>

            <!-- Columna Derecha: Ilustración Principal Destacada y Flotante (Grande y Enriquecida) -->
            <div class="lg:col-span-6 flex justify-center items-center relative lg:pl-4">
                <div class="relative w-full max-w-[540px] sm:max-w-[620px] lg:max-w-[680px] flex items-center justify-center">
                    
                    <!-- Aura y Pulso de Fondo en Verde y Dorado Esmeralda -->
                    <div class="absolute w-[360px] h-[360px] sm:w-[480px] sm:h-[480px] rounded-full bg-gradient-to-tr from-[#39A900]/30 via-[#62E31D]/25 to-[#E4C382]/30 blur-3xl animate-glow-pulse pointer-events-none"></div>

                    <!-- Badge Flotante 1: Comunidad Activa -->
                    <div class="absolute -top-4 -left-2 sm:top-2 sm:left-4 z-20 bg-white/95 backdrop-blur-md px-4 py-2 rounded-2xl shadow-lg border border-green-100 flex items-center gap-2.5 animate-bounce" style="animation-duration: 4s;">
                        <span class="w-8 h-8 rounded-full bg-[#EAF7EE] text-[#0d6928] flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                        <div>
                            <div class="text-[11px] font-bold text-gray-800 leading-tight">+1.240 Egresados</div>
                            <div class="text-[9px] text-green-700 font-semibold">Comunidad Activa</div>
                        </div>
                    </div>

                    <!-- Badge Flotante 2: Vinculación Laboral -->
                    <div class="absolute -bottom-2 -right-2 sm:bottom-4 sm:right-4 z-20 bg-white/95 backdrop-blur-md px-4 py-2 rounded-2xl shadow-lg border border-green-100 flex items-center gap-2.5 animate-bounce" style="animation-duration: 5s;">
                        <span class="w-8 h-8 rounded-full bg-[#FFF4E8] text-[#e65100] flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <div>
                            <div class="text-[11px] font-bold text-gray-800 leading-tight">Bolsa de Empleo</div>
                            <div class="text-[9px] text-amber-700 font-semibold">Vacantes del Huila</div>
                        </div>
                    </div>

                    <!-- Imagen Central Ilustrada con Gran Escala y Fondo Integrado -->
                    <img src="{{ route('egresados.assets.image', 'egresados-banner.png') }}" alt="Egresados CEFA ¡Contigo Siempre!" class="relative z-10 w-full h-auto object-contain drop-shadow-2xl animate-float-hero select-none pointer-events-none mix-blend-multiply scale-105 sm:scale-110">
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================== -->
    <!-- 3. ESTADÍSTICAS MODERNAS EN TARJETAS -->
    <!-- ============================================== -->
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
                
                <!-- Stat 1: Egresados Registrados -->
                <div class="bg-[#F8FCF9] border border-green-100 rounded-2xl p-6 flex flex-col justify-between hover:border-senaGreen/40 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-green-100 text-[#0d6928] flex items-center justify-center text-lg">
                            <i class="fa-solid fa-user-graduate"></i>
                        </span>
                        <span class="text-xs font-bold text-green-700 bg-green-100/70 px-2 py-0.5 rounded-full">CEFA</span>
                    </div>
                    <div>
                        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#012410] tracking-tight">
                            {{ $totalEgresados > 0 ? number_format($totalEgresados) : '1.240+' }}
                        </div>
                        <div class="text-xs sm:text-sm font-semibold text-gray-600 mt-1">Egresados registrados</div>
                    </div>
                </div>

                <!-- Stat 2: Vinculación Laboral -->
                <div class="bg-[#F8FCF9] border border-green-100 rounded-2xl p-6 flex flex-col justify-between hover:border-senaGreen/40 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-100/70 px-2 py-0.5 rounded-full">Laboral</span>
                    </div>
                    <div>
                        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#012410] tracking-tight">
                            {{ $totalEmpleados > 0 ? number_format($totalEmpleados) : '86%' }}
                        </div>
                        <div class="text-xs sm:text-sm font-semibold text-gray-600 mt-1">Vinculados laboralmente</div>
                    </div>
                </div>

                <!-- Stat 3: Emprendimientos -->
                <div class="bg-[#F8FCF9] border border-green-100 rounded-2xl p-6 flex flex-col justify-between hover:border-senaGreen/40 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-rocket"></i>
                        </span>
                        <span class="text-xs font-bold text-amber-700 bg-amber-100/70 px-2 py-0.5 rounded-full">Negocios</span>
                    </div>
                    <div>
                        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#012410] tracking-tight">
                            {{ $totalEmprendedores > 0 ? number_format($totalEmprendedores) : '32' }}
                        </div>
                        <div class="text-xs sm:text-sm font-semibold text-gray-600 mt-1">Emprendimientos activos</div>
                    </div>
                </div>

                <!-- Stat 4: Formación Continua -->
                <div class="bg-[#F8FCF9] border border-green-100 rounded-2xl p-6 flex flex-col justify-between hover:border-senaGreen/40 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                        <span class="text-xs font-bold text-blue-700 bg-blue-100/70 px-2 py-0.5 rounded-full">Programas</span>
                    </div>
                    <div>
                        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#012410] tracking-tight">
                            {{ $totalEstudiantes > 0 ? number_format($totalEstudiantes) : '14' }}
                        </div>
                        <div class="text-xs sm:text-sm font-semibold text-gray-600 mt-1">En formación continua</div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================== -->
    <!-- 4. QUÉ PUEDES HACER EN SIGE (4 TARJETAS MODERNAS) -->
    <!-- ============================================== -->
    <section id="servicios" class="py-20 px-4 sm:px-6 lg:px-8 bg-[#FAFDFB]">
        <div class="max-w-7xl mx-auto">
            
            <!-- Encabezado de Sección -->
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block text-[#39A900] text-xs font-extrabold tracking-widest uppercase mb-2">Servicios y Oportunidades</span>
                <h2 class="font-editorial text-3xl sm:text-4xl font-bold text-[#012410] tracking-tight">¿Qué encuentras en SIGE?</h2>
                <p class="text-gray-600 text-sm sm:text-base mt-3 leading-relaxed">
                    Cuatro espacios diseñados para acompañar tu crecimiento personal y profesional después de tu egreso del CEFA.
                </p>
            </div>

            <!-- Grilla de 4 Tarjetas Modernas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7">
                
                <!-- Tarjeta 1: Ofertas Laborales -->
                <div class="service-card-modern bg-white rounded-3xl p-7 border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#EAF7EE] text-[#0d6928] flex items-center justify-center text-2xl mb-6 shadow-sm">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <h3 class="font-editorial text-xl font-bold text-[#012410] mb-2.5">Ofertas laborales</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Accede a vacantes filtradas de empresas aliadas y de la Agencia Pública de Empleo (APE SENA) en el Huila.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <a href="javascript:void(0);" onclick="alert('Conexión con la Agencia Pública de Empleo (APE SENA) y vacantes activas.');" class="inline-flex items-center space-x-2 text-sm font-bold text-[#0d6928] hover:text-[#39A900] group transition">
                            <span>Ver ofertas</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1.5 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Tarjeta 2: Eventos -->
                <div class="service-card-modern bg-white rounded-3xl p-7 border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#FFF4E8] text-[#e65100] flex items-center justify-center text-2xl mb-6 shadow-sm">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <h3 class="font-editorial text-xl font-bold text-[#012410] mb-2.5">Eventos</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Participa en ferias laborales, talleres de empleabilidad, congresos técnicos y encuentros de egresados.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <a href="javascript:void(0);" onclick="alert('Próximos talleres y encuentros de egresados programados.');" class="inline-flex items-center space-x-2 text-sm font-bold text-[#e65100] hover:text-[#ff7043] group transition">
                            <span>Ver agenda</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1.5 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Tarjeta 3: Encuestas -->
                <div class="service-card-modern bg-white rounded-3xl p-7 border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#EEF4FF] text-[#0052cc] flex items-center justify-center text-2xl mb-6 shadow-sm">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <h3 class="font-editorial text-xl font-bold text-[#012410] mb-2.5">Encuestas</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Comparte tu experiencia y situación laboral actual para ayudarnos a fortalecer los programas formativos del CEFA.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <a href="{{ route('egresados.create') }}" class="inline-flex items-center space-x-2 text-sm font-bold text-[#0052cc] hover:text-[#3385ff] group transition">
                            <span>Actualizar datos</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1.5 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Tarjeta 4: Notificaciones -->
                <div class="service-card-modern bg-white rounded-3xl p-7 border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#F6EEFF] text-[#7928ca] flex items-center justify-center text-2xl mb-6 shadow-sm">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <h3 class="font-editorial text-xl font-bold text-[#012410] mb-2.5">Notificaciones</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Recibe avisos sobre nuevas convocatorias de Fondo Emprender, cursos complementarios y beneficios institucionales.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <a href="javascript:void(0);" onclick="alert('Convocatorias activas y notificaciones para egresados SENA.');" class="inline-flex items-center space-x-2 text-sm font-bold text-[#7928ca] hover:text-[#9d4edd] group transition">
                            <span>Conocer más</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1.5 transition-transform"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================== -->
    <!-- 5. CTA DE REGISTRO LLAMATIVO Y GRANDE -->
    <!-- ============================================== -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <div class="relative rounded-3xl bg-gradient-to-r from-[#012B12] via-[#013819] to-[#0A5423] p-8 sm:p-12 lg:p-16 shadow-xl overflow-hidden text-white border border-green-700/30">
                
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-[#39A900]/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#62E31D]/15 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <div class="lg:col-span-8 space-y-4 text-center lg:text-left">
                        <span class="bg-white/15 text-[#62E31D] text-xs font-bold px-3.5 py-1 rounded-full uppercase tracking-wider inline-block">
                            Comunidad Activa
                        </span>
                        <h2 class="font-editorial text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                            ¿Ya eres egresado del CEFA?
                        </h2>
                        <p class="text-green-100/85 text-base sm:text-lg max-w-2xl leading-relaxed">
                            Haz parte de nuestra comunidad oficial y mantente conectado con nuevas oportunidades laborales, formación continua y alianzas estratégicas.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex justify-center lg:justify-end">
                        <a href="{{ route('egresados.create') }}" class="bg-[#39A900] hover:bg-[#62E31D] hover:text-[#012B12] text-white px-8 py-4 rounded-full text-base font-extrabold shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300 flex items-center space-x-3 text-center">
                            <i class="fa-solid fa-user-plus text-lg"></i>
                            <span>Registrarme como egresado</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- ============================================== -->
    <!-- 6. FOOTER ESTRUCTURADO Y JERÁRQUICO -->
    <!-- ============================================== -->
    <footer id="contacto" class="bg-[#012410] text-white pt-16 pb-8 px-4 sm:px-6 lg:px-8 border-t-4 border-[#39A900]">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                
                <!-- Columna 1: SENA / CEFA -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-11 h-11 rounded-full overflow-hidden shadow-sm flex items-center justify-center border-2 border-white/80 bg-[#39A900] shrink-0">
                            <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div>
                            <h4 class="font-bold text-base text-white leading-tight">SENA Empresa</h4>
                            <span class="text-xs text-green-300">CEFA La Angostura</span>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                        Centro de Formación Agroindustrial La Angostura. Regional Huila, Campoalegre.
                    </p>
                    <p class="font-cursive text-2xl text-[#62E31D] font-bold">
                        ¡Contigo Siempre!
                    </p>
                </div>

                <!-- Columna 2: Plataforma SIGE -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest text-[#62E31D] font-extrabold mb-4">Plataforma SIGE</h4>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-gray-300">
                        <li><a href="#servicios" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Ofertas laborales</a></li>
                        <li><a href="#servicios" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Eventos y talleres</a></li>
                        <li><a href="{{ route('egresados.index') }}" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Encuestas y seguimiento</a></li>
                        <li><a href="{{ route('egresados.index') }}" class="hover:text-[#62E31D] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Directorio de egresados</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Sede y Contacto -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest text-[#62E31D] font-extrabold mb-4">Sede y Contacto</h4>
                    <ul class="space-y-3 text-xs sm:text-sm text-gray-300">
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
                    <h4 class="text-xs uppercase tracking-widest text-[#62E31D] font-extrabold mb-4">Comunidad</h4>
                    <p class="text-xs text-gray-300 mb-4">Síguenos en nuestros canales oficiales para estar al día con las novedades:</p>
                    <div class="flex items-center space-x-3">
                        <a href="https://facebook.com" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#39A900] text-white flex items-center justify-center text-sm transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://instagram.com" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#39A900] text-white flex items-center justify-center text-sm transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://youtube.com" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#39A900] text-white flex items-center justify-center text-sm transition"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400 gap-4">
                <p>© {{ date('Y') }} <strong>SIGE — Sistema de Gestión de Egresados CEFA</strong> • SENA Empresa. Todos los derechos reservados.</p>
                <p class="text-green-300/80 font-medium">Centro de Formación Agroindustrial "La Angostura"</p>
            </div>

        </div>
    </footer>

</body>
</html>
