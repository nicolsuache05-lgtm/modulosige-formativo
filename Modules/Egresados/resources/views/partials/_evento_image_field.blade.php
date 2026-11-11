@php
    $prefix = $idPrefix ?? 'evento_img';
    $initialUrl = trim((string)($initialUrl ?? ''));
    $label = $fieldLabel ?? 'Foto / Portada del Evento';
@endphp

<div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900] space-y-3" data-evento-img-widget="{{ $prefix }}">
    <div class="flex flex-wrap items-center justify-between gap-2 pb-2 border-b border-gray-100">
        <label class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
            <i class="fa-solid fa-image text-[#39A900]"></i>
            <span>{{ $label }}</span>
        </label>
        <div class="inline-flex rounded-lg bg-gray-100 p-0.5 border border-gray-200">
            <button type="button"
                    id="{{ $prefix }}_tab_file"
                    onclick="sigeEventoImgMode('{{ $prefix }}', 'file')"
                    class="px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer bg-white text-gray-900 shadow-xs font-bold">
                <i class="fa-solid fa-cloud-arrow-up text-[10px] text-[#39A900]"></i>
                <span>Subir Foto</span>
            </button>
            <button type="button"
                    id="{{ $prefix }}_tab_url"
                    onclick="sigeEventoImgMode('{{ $prefix }}', 'url')"
                    class="px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer text-gray-500 hover:text-gray-700 font-medium">
                <i class="fa-solid fa-link text-[10px] text-blue-600"></i>
                <span>Pegar URL</span>
            </button>
        </div>
    </div>

    <input type="hidden" name="remove_image" id="{{ $prefix }}_remove" value="0">

    <!-- Subir archivo -->
    <div id="{{ $prefix }}_pane_file">
        <div onclick="document.getElementById('{{ $prefix }}_file').click()"
             class="border-2 border-dashed border-gray-200 hover:border-[#39A900] rounded-2xl p-4 transition bg-gray-50/50 hover:bg-emerald-50/20 text-center cursor-pointer">
            <input type="file"
                   name="image"
                   id="{{ $prefix }}_file"
                   accept="image/png, image/jpeg, image/jpg, image/webp, image/gif"
                   class="hidden"
                   onchange="sigeEventoImgFromFile('{{ $prefix }}', this)">
            <div class="py-2 flex flex-col items-center justify-center">
                <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-[#39A900] flex items-center justify-center text-lg mb-2 shadow-xs">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div class="text-xs font-bold text-gray-700">Haz clic aquí para subir la foto del evento</div>
                <p class="text-[11px] text-gray-400 mt-0.5">JPG, PNG, WebP o GIF (máx. 5 MB) · Se verá en el inicio de SIGE</p>
            </div>
        </div>
    </div>

    <!-- Pegar URL -->
    <div id="{{ $prefix }}_pane_url" class="hidden space-y-1.5">
        <div class="relative">
            <i class="fa-solid fa-link absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
            <input type="text"
                   name="image_url"
                   id="{{ $prefix }}_url"
                   value="{{ $initialUrl }}"
                   oninput="sigeEventoImgFromUrl('{{ $prefix }}', this.value)"
                   placeholder="https://... (enlace directo de la foto del evento)"
                   class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
        </div>
        <p class="text-[11px] text-gray-400">Opcional: pega el enlace directo de una imagen web para mostrarla en el inicio.</p>
    </div>

    <!-- Vista previa -->
    <div id="{{ $prefix }}_preview_wrap" class="{{ $initialUrl !== '' ? '' : 'hidden' }} relative">
        <img id="{{ $prefix }}_preview_img"
             src="{{ $initialUrl }}"
             alt="Vista previa foto del evento"
             class="w-full h-40 object-cover rounded-xl shadow-sm border border-gray-200 bg-gray-100">
        <button type="button"
                onclick="sigeEventoImgClear('{{ $prefix }}')"
                class="absolute top-2 right-2 px-3 py-1 bg-red-600/90 hover:bg-red-700 text-white rounded-lg text-xs font-bold shadow-md transition flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-trash-can text-[11px]"></i>
            <span>Quitar foto</span>
        </button>
    </div>
</div>

@once
<script>
    window.sigeEventoImgMode = function(prefix, mode) {
        const paneFile = document.getElementById(prefix + '_pane_file');
        const paneUrl = document.getElementById(prefix + '_pane_url');
        const tabFile = document.getElementById(prefix + '_tab_file');
        const tabUrl = document.getElementById(prefix + '_tab_url');
        if (!paneFile || !paneUrl || !tabFile || !tabUrl) return;

        const activeCls = 'px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer bg-white text-gray-900 shadow-xs font-bold';
        const idleCls = 'px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer text-gray-500 hover:text-gray-700 font-medium';

        if (mode === 'url') {
            paneFile.classList.add('hidden');
            paneUrl.classList.remove('hidden');
            tabUrl.className = activeCls;
            tabFile.className = idleCls;
        } else {
            paneUrl.classList.add('hidden');
            paneFile.classList.remove('hidden');
            tabFile.className = activeCls;
            tabUrl.className = idleCls;
        }
    };

    window.sigeEventoImgSet = function(prefix, src) {
        const wrap = document.getElementById(prefix + '_preview_wrap');
        const img = document.getElementById(prefix + '_preview_img');
        const urlInput = document.getElementById(prefix + '_url');
        const fileInput = document.getElementById(prefix + '_file');
        const removeInput = document.getElementById(prefix + '_remove');
        if (fileInput) fileInput.value = '';
        if (removeInput) removeInput.value = '0';

        const cleanSrc = (src || '').trim();
        if (urlInput) {
            urlInput.value = cleanSrc.startsWith('data:') ? '' : cleanSrc;
        }
        if (wrap && img) {
            if (cleanSrc) {
                img.src = cleanSrc;
                wrap.classList.remove('hidden');
            } else {
                img.src = '';
                wrap.classList.add('hidden');
            }
        }
        window.sigeEventoImgMode(prefix, 'file');
    };

    window.sigeEventoImgFromFile = function(prefix, input) {
        const file = input && input.files ? input.files[0] : null;
        if (!file) return;
        const removeInput = document.getElementById(prefix + '_remove');
        const urlInput = document.getElementById(prefix + '_url');
        if (removeInput) removeInput.value = '0';
        if (urlInput) urlInput.value = '';

        const reader = new FileReader();
        reader.onload = function(e) {
            const wrap = document.getElementById(prefix + '_preview_wrap');
            const img = document.getElementById(prefix + '_preview_img');
            if (wrap && img && e.target && e.target.result) {
                img.src = e.target.result;
                wrap.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    };

    window.sigeEventoImgFromUrl = function(prefix, val) {
        const clean = (val || '').trim();
        const wrap = document.getElementById(prefix + '_preview_wrap');
        const img = document.getElementById(prefix + '_preview_img');
        const removeInput = document.getElementById(prefix + '_remove');
        if (removeInput) removeInput.value = '0';
        if (wrap && img) {
            if (clean.length > 5) {
                img.src = clean;
                wrap.classList.remove('hidden');
            } else {
                img.src = '';
                wrap.classList.add('hidden');
            }
        }
    };

    window.sigeEventoImgClear = function(prefix) {
        const wrap = document.getElementById(prefix + '_preview_wrap');
        const img = document.getElementById(prefix + '_preview_img');
        const urlInput = document.getElementById(prefix + '_url');
        const fileInput = document.getElementById(prefix + '_file');
        const removeInput = document.getElementById(prefix + '_remove');
        if (fileInput) fileInput.value = '';
        if (urlInput) urlInput.value = '';
        if (removeInput) removeInput.value = '1';
        if (img) img.src = '';
        if (wrap) wrap.classList.add('hidden');
    };
</script>
@endonce
