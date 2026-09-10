<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión · SIGE — Sistema de Gestión de Egresados</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans -->
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
                        senaForest: '#013819',
                        senaForestDeep: '#012410',
                        senaNeon: '#62E31D',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        editorial: ['Fraunces', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F8FCF9] font-sans antialiased text-[#1A2E22] min-h-screen flex flex-col justify-between selection:bg-senaGreen selection:text-white">

    <!-- Header / Brand Minimal -->
    <header class="w-full bg-[#013819] text-white py-3.5 px-6 shadow-md border-b border-[#39A900]/30">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('egresados.welcome') }}" class="flex items-center space-x-3 text-white no-underline group">
                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/80 flex items-center justify-center bg-[#39A900] shadow-sm">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-editorial text-xl font-bold tracking-wider leading-none">SIGE</span>
                        <span class="bg-[#39A900] text-white text-[9px] font-extrabold px-1.5 py-0.5 rounded-full uppercase">CEFA</span>
                    </div>
                    <p class="text-[10px] text-green-200/90 font-medium">Sistema de Gestión de Egresados</p>
                </div>
            </a>

            <a href="{{ route('egresados.welcome') }}" class="text-xs sm:text-sm font-semibold text-green-200 hover:text-white flex items-center gap-1.5 transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Volver al portal</span>
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            
            <!-- Left Column: Branding, Illustration & Role Guides -->
            <div class="lg:col-span-5 bg-gradient-to-br from-[#012410] via-[#013819] to-[#0d5927] text-white p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden">
                <!-- Background ambient glows -->
                <div class="absolute -top-16 -left-16 w-56 h-56 bg-[#39A900]/25 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -right-16 w-56 h-56 bg-[#62E31D]/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 bg-white/10 text-[#62E31D] text-xs font-bold px-3 py-1 rounded-full mb-6 border border-white/10">
                        <i class="fa-solid fa-shield-halved text-xs"></i>
                        <span>Acceso Seguro ERP</span>
                    </div>

                    <h2 class="font-editorial text-2xl sm:text-3xl font-bold leading-tight mb-3">
                        Bienvenido a <span class="text-[#62E31D]">SIGE</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-green-100/80 leading-relaxed mb-6">
                        Ingresa con tus credenciales asignadas para acceder a tu módulo correspondiente de egresados.
                    </p>

                    <!-- Roles Info list -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-start gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-[#39A900]/40 text-[#62E31D] flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fa-solid fa-crown"></i>
                            </span>
                            <div>
                                <div class="text-xs font-bold text-white">Superadmin</div>
                                <div class="text-[11px] text-green-200/70">Panel global de coordinación y estadísticas.</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-blue-500/30 text-blue-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </span>
                            <div>
                                <div class="text-xs font-bold text-white">Instructor</div>
                                <div class="text-[11px] text-green-200/70">Seguimiento de egresados por ficha y encuestas.</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-amber-500/30 text-amber-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fa-solid fa-user-graduate"></i>
                            </span>
                            <div>
                                <div class="text-xs font-bold text-white">Egresado</div>
                                <div class="text-[11px] text-green-200/70">Portal personal, vacantes y actualización de datos.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 pt-8 mt-6 border-t border-white/10 text-[11px] text-green-200/60">
                    SENA Centro de Formación Agroindustrial "La Angostura" • Huila
                </div>
            </div>

            <!-- Right Column: Login Form & Quick Selectors -->
            <div class="lg:col-span-7 p-8 sm:p-10 flex flex-col justify-between">
                <div>
                    
                    <div class="mb-6">
                        <h3 class="font-editorial text-2xl font-bold text-[#012410]">Iniciar Sesión</h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">Ingresa tu correo institucional o usuario y contraseña.</p>
                    </div>

                    <!-- Alerts / Error messages -->
                    @if(session('info'))
                        <div class="bg-blue-50 text-blue-800 text-xs font-semibold p-3.5 rounded-xl border border-blue-200 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle text-blue-600"></i>
                            <span>{{ session('info') }}</span>
                        </div>
                    @endif

                    @if(isset($errors) && $errors->any())
                        <div class="bg-red-50 text-red-800 text-xs font-semibold p-3.5 rounded-xl border border-red-200 mb-4">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fa-solid fa-circle-exclamation text-red-600"></i>
                                <span class="font-bold">Error de autenticación:</span>
                            </div>
                            <ul class="list-disc list-inside ps-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('egresados.login.post') }}" method="POST" class="space-y-4" id="loginForm">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ $redirect ?? '' }}">

                        <!-- Input Email / Nickname -->
                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                Correo o Usuario
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                                    <i class="fa-regular fa-user text-sm"></i>
                                </span>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="ej: superadmin.egresados@sena.edu.co"
                                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 font-medium focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition">
                            </div>
                        </div>

                        <!-- Input Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                Contraseña
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </span>
                                <input type="password" id="password" name="password" required
                                    placeholder="••••••••"
                                    class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 font-medium focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition">
                                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition">
                                    <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember & Submit -->
                        <div class="flex items-center justify-between pt-1">
                            <label class="inline-flex items-center text-xs text-gray-600 font-medium cursor-pointer">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-[#39A900] border-gray-300 rounded focus:ring-[#39A900]">
                                <span class="ml-2">Recordarme</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-[#39A900] hover:bg-[#2a7c00] text-white py-3 px-4 rounded-xl text-sm font-bold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition flex items-center justify-center space-x-2">
                            <span>Ingresar al Módulo</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </form>

                    <!-- Quick Credentials Auto-Fill Card -->
                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                <i class="fa-solid fa-bolt text-amber-500 me-1"></i> Relleno Rápido de Prueba:
                            </span>
                            <span class="text-[10px] text-gray-400 font-semibold">1-Clic</span>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                            <!-- Button Superadmin -->
                            <button type="button" onclick="fillCredentials('superadmin.egresados@sena.edu.co', '12345678', 'Superadmin (/egresados/dashboard)')" 
                                class="text-start p-2.5 rounded-xl border border-gray-200 hover:border-[#39A900] hover:bg-green-50/50 transition group">
                                <div class="text-[11px] font-bold text-gray-800 flex items-center gap-1 group-hover:text-[#39A900]">
                                    <i class="fa-solid fa-crown text-amber-500 text-[10px]"></i> Superadmin
                                </div>
                                <div class="text-[10px] text-gray-500 truncate">superadmin.egresados...</div>
                            </button>

                            <!-- Button Instructor -->
                            <button type="button" onclick="fillCredentials('instructor.egresados@sena.edu.co', '12345678', 'Instructor (/egresados/dashboard-instructor)')" 
                                class="text-start p-2.5 rounded-xl border border-gray-200 hover:border-blue-500 hover:bg-blue-50/50 transition group">
                                <div class="text-[11px] font-bold text-gray-800 flex items-center gap-1 group-hover:text-blue-600">
                                    <i class="fa-solid fa-chalkboard-user text-blue-500 text-[10px]"></i> Instructor
                                </div>
                                <div class="text-[10px] text-gray-500 truncate">instructor.egresados...</div>
                            </button>

                            <!-- Button Egresado -->
                            <button type="button" onclick="fillCredentials('egresado.sige@sena.edu.co', '12345678', 'Egresado (/egresados/dashboard-egresado)')" 
                                class="text-start p-2.5 rounded-xl border border-gray-200 hover:border-emerald-500 hover:bg-emerald-50/50 transition group">
                                <div class="text-[11px] font-bold text-gray-800 flex items-center gap-1 group-hover:text-emerald-600">
                                    <i class="fa-solid fa-user-graduate text-emerald-600 text-[10px]"></i> Egresado
                                </div>
                                <div class="text-[10px] text-gray-500 truncate">egresado.sige...</div>
                            </button>
                        </div>
                        
                        <div id="credentialsNotice" class="text-[11px] text-gray-500 mt-2 font-medium hidden">
                            <i class="fa-solid fa-info-circle text-[#39A900] me-1"></i> <span id="credentialsTarget"></span>
                        </div>
                    </div>

                </div>

                <div class="mt-6 text-center text-xs text-gray-400">
                    ERP SENA Empresa • SIGE &copy; {{ date('Y') }}
                </div>
            </div>

        </div>
    </main>

    <!-- Footer Simple -->
    <footer class="text-center py-3 text-[11px] text-gray-400 bg-white border-t border-gray-100">
        Centro de Formación Agroindustrial "La Angostura" • Regional Huila
    </footer>

    <script>
        function togglePasswordVisibility() {
            const passInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function fillCredentials(email, password, roleName) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            const notice = document.getElementById('credentialsNotice');
            const target = document.getElementById('credentialsTarget');
            notice.classList.remove('hidden');
            target.innerHTML = `Credenciales cargadas para <strong>${roleName}</strong>. Contraseña: <code>${password}</code>. Haz clic en <strong>"Ingresar al Módulo"</strong>.`;
        }
    </script>
</body>
</html>
