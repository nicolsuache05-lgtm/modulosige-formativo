@php
    $fotoFieldId = $fieldId ?? 'pwd_foto_perfil';
    $fotoPreviewId = $previewId ?? 'pwd_foto_preview';
    $fotoNameId = $fotoFieldId . '_filename';
    $fotoPerson = $person ?? (Auth::check() ? Auth::user()->person : null);
    $fotoCurrentUrl = \Modules\Egresados\Http\Controllers\EgresadosController::getAvatarUrl($fotoPerson);
    $fotoRoleLabel = $roleLabel ?? 'Perfil Institucional';
    $fotoInitials = $initials ?? (Auth::check() ? (Auth::user()->initials ?: 'SG') : 'SG');
@endphp

<div style="margin-bottom:14px; background:linear-gradient(135deg, #F8FAFC 0%, #F0FDF4 100%); border:1.5px dashed #86EFAC; border-radius:12px; padding:12px 14px;">
  <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
    <div id="{{ $fotoPreviewId }}"
         style="width:66px; height:66px; border-radius:16px; background:linear-gradient(135deg, #001A29 0%, #39A900 100%); color:#FFFFFF; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:20px; overflow:hidden; flex-shrink:0; border:2px solid #FFFFFF; box-shadow:0 6px 16px rgba(0, 19, 30, 0.16);">
      @if($fotoCurrentUrl)
        <img src="{{ $fotoCurrentUrl }}" alt="Foto de perfil" style="width:100%; height:100%; object-fit:cover; display:block;">
      @else
        <span>{{ $fotoInitials }}</span>
      @endif
    </div>

    <div style="flex:1; min-width:190px;">
      <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; margin-bottom:3px; flex-wrap:wrap;">
        <span style="font-size:12px; font-weight:800; color:#00131E;">
          <i class="fa-solid fa-camera" style="color:#39A900; margin-right:4px;"></i>
          Foto de Perfil ({{ $fotoRoleLabel }})
        </span>
        <span style="font-size:10px; font-weight:700; color:#166534; background:#DCFCE7; border:1px solid #BBF7D0; padding:2px 8px; border-radius:999px;">
          Visible en tu Perfil y SIGE
        </span>
      </div>
      <p style="font-size:11px; color:#475569; margin:0 0 8px 0; line-height:1.35;">
        Adjunta tu fotografía institucional (JPG, PNG o WEBP, máx. 5 MB). Se mostrará en tu panel y en los módulos del sistema.
      </p>

      <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <label for="{{ $fotoFieldId }}"
               style="display:inline-flex; align-items:center; gap:6px; padding:7px 13px; border-radius:9px; background:linear-gradient(135deg, #001A29 0%, #002D44 100%); color:#FFFFFF; font-size:11.5px; font-weight:700; cursor:pointer; border:1px solid #39A900; box-shadow:0 3px 10px rgba(0, 26, 41, 0.18); transition:all 0.2s;">
          <i class="fa-solid fa-upload" style="color:#62E31D;"></i>
          <span>{{ $fotoCurrentUrl ? 'Cambiar Foto' : 'Subir Foto' }}</span>
        </label>
        <input type="file"
               id="{{ $fotoFieldId }}"
               name="foto"
               accept="image/jpeg,image/png,image/jpg,image/webp,image/gif"
               style="display:none;">
        <span id="{{ $fotoNameId }}" style="font-size:11px; color:#64748B; font-weight:600; max-width:190px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
          {{ $fotoCurrentUrl ? 'Foto cargada actualmente' : 'Sin archivo seleccionado' }}
        </span>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    const input = document.getElementById('{{ $fotoFieldId }}');
    const preview = document.getElementById('{{ $fotoPreviewId }}');
    const nameLabel = document.getElementById('{{ $fotoNameId }}');
    if (!input || !preview) return;

    input.addEventListener('change', function() {
      const file = this.files && this.files[0];
      if (!file) return;
      if (nameLabel) nameLabel.textContent = file.name;
      const reader = new FileReader();
      reader.onload = function(ev) {
        preview.innerHTML = '<img src="' + ev.target.result + '" alt="Vista previa" style="width:100%; height:100%; object-fit:cover; display:block;">';
      };
      reader.readAsDataURL(file);
    });
  })();
</script>
