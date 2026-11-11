@once
<style>
  .sige-brand-logo-wrap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 62px;
    height: 55px;
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
    overflow: visible;
  }

  .sige-brand-logo-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    background: transparent !important;
    animation: sigeBrandLogoFloat 3.8s ease-in-out infinite;
    transform-origin: center center;
    transition: transform 0.25s ease, filter 0.25s ease;
    will-change: transform, filter;
  }

  .brand:hover .sige-brand-logo-img,
  a.group:hover .sige-brand-logo-img {
    transform: translateY(-2px) scale(1.1);
    filter: drop-shadow(0 8px 18px rgba(98, 227, 29, 0.68)) drop-shadow(0 3px 6px rgba(0, 0, 0, 0.55));
  }

  @keyframes sigeBrandLogoFloat {
    0%, 100% {
      transform: translateY(0px) rotate(0deg) scale(1);
      filter: drop-shadow(0 3px 8px rgba(98, 227, 29, 0.32)) drop-shadow(0 2px 4px rgba(0, 0, 0, 0.45));
    }
    25% {
      transform: translateY(-3px) rotate(-1.8deg) scale(1.03);
      filter: drop-shadow(0 5px 11px rgba(98, 227, 29, 0.42)) drop-shadow(0 3px 5px rgba(0, 0, 0, 0.48));
    }
    50% {
      transform: translateY(-4px) rotate(0deg) scale(1.055);
      filter: drop-shadow(0 6px 15px rgba(98, 227, 29, 0.56)) drop-shadow(0 4px 6px rgba(0, 0, 0, 0.5));
    }
    75% {
      transform: translateY(-2px) rotate(1.8deg) scale(1.03);
      filter: drop-shadow(0 5px 11px rgba(98, 227, 29, 0.42)) drop-shadow(0 3px 5px rgba(0, 0, 0, 0.48));
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .sige-brand-logo-img {
      animation: none;
    }
  }
</style>
@endonce
<span class="sige-brand-logo-wrap">
  <img src="{{ route('egresados.assets.image', 'sige-egresado-logo-transparent.png') }}"
       alt="Logo SIGE Egresado CEFA"
       class="sige-brand-logo-img">
</span>
