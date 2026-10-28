{{-- Modules/Egresados/resources/views/partials/pagination.blade.php --}}
{{-- COMPONENTE DE PAGINACIÓN INSTITUCIONAL PREMIUM - SENA SIGE --}}

<style>
    .sena-pagination-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        flex-wrap: wrap;
        gap: 12px;
        padding: 4px 2px;
        box-sizing: border-box;
    }

    .sena-pagination-info {
        font-size: 13px;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        font-family: inherit;
    }

    .sena-pagination-info .sena-count-highlight {
        color: #0F172A;
        font-weight: 700;
        background: #F1F5F9;
        padding: 2px 7px;
        border-radius: 6px;
        border: 1px solid #E2E8F0;
        font-size: 12.5px;
    }

    .sena-pagination-nav {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sena-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        color: #334155 !important;
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        text-decoration: none !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        user-select: none;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    }

    .sena-page-btn:hover:not(.sena-page-disabled):not(.sena-page-active) {
        background: #F8FAFC !important;
        color: #39A900 !important;
        border-color: #39A900 !important;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(57, 169, 0, 0.16);
    }

    .sena-page-active {
        background: linear-gradient(135deg, #001A29 0%, #39A900 100%) !important;
        color: #FFFFFF !important;
        border-color: transparent !important;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(57, 169, 0, 0.32);
        cursor: default;
    }

    .sena-page-disabled {
        color: #CBD5E1 !important;
        background: #F8FAFC !important;
        border-color: #E2E8F0 !important;
        cursor: not-allowed;
        opacity: 0.6;
        box-shadow: none;
    }

    .sena-page-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 36px;
        color: #94A3B8;
        font-weight: 700;
        font-size: 14px;
        user-select: none;
    }

    @media (max-width: 640px) {
        .sena-pagination-container {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .sena-pagination-info {
            font-size: 12px;
        }
        .sena-page-btn {
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            font-size: 12px;
        }
    }
</style>

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navegación de páginas" class="sena-pagination-container">
        
        {{-- 1. INFORMACIÓN EN ESPAÑOL Y RESUMEN NUMÉRICO --}}
        <div class="sena-pagination-info">
            <span>Mostrando del</span>
            <span class="sena-count-highlight">{{ number_format($paginator->firstItem(), 0, ',', '.') }}</span>
            <span>al</span>
            <span class="sena-count-highlight">{{ number_format(min($paginator->lastItem(), $paginator->total()), 0, ',', '.') }}</span>
            <span>de</span>
            <span class="sena-count-highlight">{{ number_format($paginator->total(), 0, ',', '.') }}</span>
            <span>registros</span>
        </div>

        {{-- 2. BOTONES NUMÉRICOS COMPACTOS Y ELEVADOS --}}
        <div class="sena-pagination-nav">
            
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="sena-page-btn sena-page-disabled" aria-disabled="true" title="Página anterior">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="sena-page-btn" rel="prev" title="Página anterior">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Cálculo Inteligente de Páginas (Máximo 6 botones + puntos) --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                if ($last <= 7) {
                    $pages = range(1, $last);
                } else {
                    $start = max(2, $current - 1);
                    $end = min($last - 1, $current + 1);

                    if ($current <= 3) {
                        $start = 2;
                        $end = 4;
                    } elseif ($current >= $last - 2) {
                        $start = $last - 3;
                        $end = $last - 1;
                    }

                    $pages = [1];
                    if ($start > 2) {
                        $pages[] = '...';
                    }
                    for ($i = $start; $i <= $end; $i++) {
                        $pages[] = $i;
                    }
                    if ($end < $last - 1) {
                        $pages[] = '...';
                    }
                    $pages[] = $last;
                }
            @endphp

            @foreach ($pages as $page)
                @if ($page === '...')
                    <span class="sena-page-dots">…</span>
                @elseif ($page == $current)
                    <span class="sena-page-btn sena-page-active" aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="sena-page-btn">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="sena-page-btn" rel="next" title="Página siguiente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="sena-page-btn sena-page-disabled" aria-disabled="true" title="Página siguiente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif

        </div>

    </nav>
@endif
