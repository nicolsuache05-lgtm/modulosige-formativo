<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Portal Egresado</title>
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      :root {
        --forest: #013819;
        --forest-deep: #012410;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --bg: #FCFCFA;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
      }
      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }
      body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--ink); min-height: 100vh; -webkit-font-smoothing: antialiased; }

      .app { display: grid; grid-template-columns: 250px 1fr; min-height: 100vh; }

      /* SIDEBAR */
      .sidebar {
        background: linear-gradient(180deg, var(--forest) 0%, var(--forest-deep) 100%);
        color: #fff; display: flex; flex-direction: column; padding: 22px 16px;
        position: sticky; top: 0; height: 100vh;
      }
      .brand { display: flex; align-items: center; gap: 12px; padding: 4px 8px 20px; border-bottom: 1px solid rgba(255,255,255,0.14); margin-bottom: 16px; text-decoration: none; color: #fff; cursor: pointer; }
      .brand-badge { width: 44px; height: 44px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
      .brand-badge img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
      .brand-name { font-weight: 700; font-size: 18px; }
      .brand-sub { font-size: 11px; color: rgba(255,255,255,0.7); margin-top: 2px; line-height: 1.2; }
      nav { margin-top: 20px; }
      nav a {
        display: flex; align-items: center; gap: 12px; padding: 12px 14px;
        border-radius: 10px; color: rgba(255,255,255,0.82); text-decoration: none;
        font-size: 14px; font-weight: 500; margin-bottom: 8px;
        transition: all 0.15s ease; cursor: pointer;
      }
      nav a i { width: 18px; font-size: 16px; text-align: center; flex-shrink: 0; }
      nav a:hover { background: rgba(255,255,255,0.09); color: #fff; }
      nav a.active { background: var(--green-dark); color: #fff; font-weight: 600; }
      .sidebar-foot { margin-top: auto; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.14); }
      .logout-btn { display: flex; align-items: center; gap: 10px; padding: 10px 14px; color: rgba(255,255,255,0.8); font-size: 13.5px; font-weight: 600; border-radius: 10px; background: transparent; border: none; width: 100%; text-align: left; transition: all 0.15s; text-decoration: none; cursor: pointer; }
      .logout-btn:hover { background: rgba(239,68,68,0.15); color: #fca5a5; }

      /* MAIN */
      .main { display: flex; flex-direction: column; min-width: 0; }
      .topbar { background: var(--card); display: flex; align-items: center; justify-content: space-between; padding: 12px 36px; border-bottom: 1px solid var(--line); position: sticky; top: 0; z-index: 100; }
      .hamburger { background: none; border: none; font-size: 20px; color: var(--ink); cursor: pointer; }
      .topbar-right { display: flex; align-items: center; gap: 18px; }
      .icon-btn { width: 36px; height: 36px; border-radius: 50%; background: transparent; display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative; color: var(--ink); border: none; }
      .icon-btn:hover { background: rgba(0,0,0,0.05); }
      .icon-btn .notif-badge { position: absolute; top: 2px; right: 4px; width: 16px; height: 16px; border-radius: 50%; background: #dc2626; color: white; font-size: 10px; font-weight: bold; display: flex; align-items: center; justify-content: center; }
      .user-profile { display: flex; align-items: center; gap: 10px; }
      .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--forest); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; }
      .user-info { display: flex; flex-direction: column; }
      .user-name { font-size: 14px; font-weight: 700; color: var(--ink); }
      .user-role { font-size: 11px; color: var(--ink-soft); }

      /* SECTIONS */
      .content { padding: 34px 40px 48px; flex: 1; }
      .section { display: none; }
      .section.active { display: block; }

      /* PAGE HEAD */
      .page-title { font-weight: 700; font-size: 24px; margin: 0 0 6px; color: var(--forest); }
      .page-desc { font-size: 13.5px; color: var(--ink-soft); margin: 0 0 24px; }

      /* STAT CARDS */
      .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
      .stat-card { background: var(--card); border-radius: 12px; padding: 24px; border: 1px solid var(--line); box-shadow: 0 2px 8px rgba(0,0,0,0.02); display: flex; flex-direction: column; transition: box-shadow 0.2s, border-color 0.2s; }
      .stat-card:hover { box-shadow: 0 8px 20px rgba(1,56,25,0.07); border-color: rgba(57,169,0,0.3); }
      .stat-content { display: flex; gap: 20px; align-items: flex-start; }
      .stat-icon { width: 50px; height: 50px; border-radius: 50%; background: var(--forest); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
      .stat-title { font-size: 13.5px; color: var(--ink); font-weight: 600; margin-bottom: 4px; }
      .stat-value { font-size: 28px; font-weight: 700; color: var(--ink); line-height: 1; margin-bottom: 4px; }
      .stat-subtitle { font-size: 12.5px; color: var(--ink-soft); }
      .stat-footer { margin-top: 16px; }
      .stat-link { font-size: 12.5px; color: var(--forest); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; background: none; border: none; font-family: inherit; padding: 0; }
      .stat-link:hover { color: var(--green); }

      /* ---- ENCUESTAS SECTION ---- */
      .encuestas-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; margin-bottom: 26px; }

      .main-grid-enc { display: grid; grid-template-columns: 1fr 280px; gap: 24px; }

      .tabs-bar { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--line); padding-bottom: 10px; margin-bottom: 20px; }
      .tabs { display: flex; gap: 24px; }
      .tab { font-size: 14px; font-weight: 600; color: var(--ink-soft); text-decoration: none; position: relative; padding-bottom: 10px; cursor: pointer; border: none; background: none; font-family: inherit; }
      .tab.active { color: var(--forest); }
      .tab.active::after { content: ''; position: absolute; bottom: -11px; left: 0; width: 100%; height: 2px; background: var(--forest); }
      .filters-bar { display: flex; gap: 10px; }
      .search-box { position: relative; }
      .search-box input { border: 1px solid var(--line); border-radius: 8px; padding: 8px 12px 8px 32px; font-size: 13px; outline: none; width: 190px; font-family: inherit; }
      .search-box i { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--ink-soft); font-size: 13px; }
      .filter-select { border: 1px solid var(--line); border-radius: 8px; padding: 8px 12px; font-size: 13px; outline: none; background: #fff; color: var(--ink); font-family: inherit; }

      .survey-card { background: var(--card); border: 1px solid var(--line); border-radius: 12px; padding: 20px; margin-bottom: 14px; display: flex; gap: 16px; }
      .survey-icon { width: 48px; height: 48px; border-radius: 8px; background: var(--green-soft); color: var(--forest); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
      .survey-icon.purple { background: #F3E8FF; color: #7E22CE; }
      .survey-body { flex: 1; }
      .survey-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
      .survey-title-text { font-size: 14.5px; font-weight: 700; color: var(--ink); margin: 0 0 6px; }
      .survey-tag { display: inline-block; font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 6px; background: var(--green-soft); color: var(--forest); }
      .survey-tag.purple { background: #F3E8FF; color: #7E22CE; }
      .survey-meta { display: flex; gap: 16px; font-size: 12px; color: var(--ink-soft); margin: 8px 0; }
      .survey-meta i { margin-right: 4px; }
      .survey-desc { font-size: 13px; color: var(--ink-soft); line-height: 1.5; margin: 0 0 14px; }
      .survey-progress-bar { height: 6px; background: var(--line); border-radius: 4px; overflow: hidden; margin-bottom: 4px; }
      .survey-progress-fill { height: 100%; background: var(--forest); border-radius: 4px; }
      .survey-progress-text { font-size: 11px; color: var(--ink-soft); display: block; text-align: right; }
      .survey-actions { display: flex; flex-direction: column; align-items: flex-end; gap: 12px; }
      .btn-responder { background: var(--forest); color: #fff; border: none; border-radius: 6px; padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background 0.2s; font-family: inherit; }
      .btn-responder:hover { background: var(--green-dark); }
      .link-detalles { font-size: 12.5px; color: var(--forest); font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 4px; }

      /* Por qué panel */
      .info-card { background: var(--card); border: 1px solid var(--line); border-radius: 12px; padding: 22px; margin-bottom: 14px; }
      .info-title { font-size: 15px; font-weight: 700; color: var(--forest); margin: 0 0 16px; }
      .info-list { display: flex; flex-direction: column; gap: 14px; }
      .info-item { display: flex; gap: 12px; }
      .info-item-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--green-soft); color: var(--forest); display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0; }
      .info-item-text h4 { font-size: 13px; font-weight: 700; color: var(--ink); margin: 0 0 3px; }
      .info-item-text p { font-size: 12px; color: var(--ink-soft); margin: 0; line-height: 1.4; }
      .alert-box { background: #F0F9FF; border-radius: 8px; padding: 14px; display: flex; gap: 12px; }
      .alert-box i { color: #0284C7; font-size: 16px; margin-top: 2px; }
      .alert-box-text h4 { font-size: 13px; font-weight: 700; color: #0369A1; margin: 0 0 4px; }
      .alert-box-text p { font-size: 12px; color: #0C4A6E; margin: 0; line-height: 1.4; }

      /* ---- OPORTUNIDADES SECTION ---- */
      .main-grid-op { display: grid; grid-template-columns: 1fr 260px; gap: 24px; }
      .section-title { font-size: 18px; font-weight: 700; color: var(--ink); margin: 0 0 16px; }
      .search-bar { display: flex; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
      .search-bar .search-box input { width: 220px; }

      .job-card { background: var(--card); border: 1px solid var(--line); border-radius: 12px; padding: 20px; margin-bottom: 14px; display: flex; gap: 16px; transition: box-shadow 0.2s, border-color 0.2s; }
      .job-card:hover { box-shadow: 0 6px 20px rgba(1,56,25,0.07); border-color: rgba(57,169,0,0.3); }
      .job-logo { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; flex-shrink: 0; }
      .job-body { flex: 1; }
      .job-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px; }
      .job-title { font-size: 14.5px; font-weight: 700; color: var(--ink); margin: 0 0 3px; }
      .job-company { font-size: 13px; color: var(--ink-soft); }
      .badge-new { background: #D1FAE5; color: #065F46; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; }
      .job-meta { display: flex; flex-wrap: wrap; gap: 12px; font-size: 12px; color: var(--ink-soft); margin: 8px 0; }
      .job-meta span { display: flex; align-items: center; gap: 4px; }
      .job-desc { font-size: 12.5px; color: var(--ink-soft); line-height: 1.5; margin: 0; }
      .job-footer { display: flex; justify-content: flex-end; margin-top: 12px; gap: 8px; }
      .btn-ver { background: var(--forest); color: #fff; border: none; border-radius: 7px; padding: 8px 18px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.2s; }
      .btn-ver:hover { background: var(--green-dark); }
      .btn-guardar { width: 34px; height: 34px; border-radius: 7px; border: 1px solid var(--line); background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--ink-soft); transition: all 0.2s; }
      .btn-guardar:hover { border-color: var(--forest); color: var(--forest); }
      .ver-todas-link { display: inline-flex; align-items: center; gap: 6px; color: var(--forest); font-weight: 600; font-size: 13.5px; text-decoration: none; margin-top: 4px; cursor: pointer; border: none; background: none; font-family: inherit; }

      /* Filter panel */
      .filter-panel { background: var(--card); border: 1px solid var(--line); border-radius: 12px; padding: 22px; }
      .filter-panel-title { font-size: 15px; font-weight: 700; color: var(--ink); margin: 0 0 18px; }
      .filter-group { margin-bottom: 20px; }
      .filter-group-title { font-size: 13px; font-weight: 700; color: var(--ink); margin: 0 0 10px; }
      .filter-checkbox { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--ink); margin-bottom: 8px; cursor: pointer; }
      .filter-checkbox input { accent-color: var(--forest); width: 15px; height: 15px; }
      .filter-select-full { width: 100%; border: 1px solid var(--line); border-radius: 8px; padding: 9px 12px; font-size: 13px; outline: none; background: #fff; color: var(--ink); font-family: inherit; }
      .btn-apply { width: 100%; background: var(--forest); color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 13.5px; font-weight: 700; cursor: pointer; font-family: inherit; margin-bottom: 10px; transition: background 0.2s; }
      .btn-apply:hover { background: var(--green-dark); }
      .btn-clear { width: 100%; background: transparent; color: var(--ink-soft); border: none; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; text-decoration: underline; }

      /* MODAL */
      .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.3s ease; }
      .modal-overlay.active { opacity: 1; visibility: visible; }
      .modal-content { background: #fff; width: 100%; max-width: 500px; border-radius: 12px; padding: 30px; position: relative; transform: translateY(-20px); transition: all 0.3s ease; max-height: 90vh; overflow-y: auto; }
      .modal-overlay.active .modal-content { transform: translateY(0); }
      .modal-close { position: absolute; top: 18px; right: 18px; background: transparent; border: none; font-size: 20px; color: var(--ink-soft); cursor: pointer; }
      .modal-header { display: flex; align-items: center; gap: 10px; color: var(--forest); font-size: 17px; font-weight: 700; margin-bottom: 18px; }
      .survey-info-box { background: var(--green-soft); border: 1px solid #c8e6c9; border-radius: 8px; padding: 16px; margin-bottom: 14px; }
      .survey-info-title { color: var(--forest); font-weight: 700; font-size: 15px; margin: 0 0 6px; }
      .survey-info-desc { color: var(--ink); font-size: 13px; margin: 0; line-height: 1.4; }
      .required-text { color: #dc2626; font-size: 12px; font-weight: 600; margin-bottom: 18px; }
      .survey-question { border-bottom: 1px solid var(--line); padding-bottom: 18px; margin-bottom: 18px; }
      .survey-question:last-of-type { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }
      .question-title { font-weight: 700; font-size: 14px; color: var(--ink); margin: 0 0 10px; }
      .question-title span { color: #dc2626; }
      .radio-option { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-size: 13.5px; color: var(--ink); cursor: pointer; }
      .radio-option input[type="radio"] { accent-color: var(--forest); width: 16px; height: 16px; }
      .specify-input { margin-top: 8px; width: 100%; max-width: 300px; border: 1px solid var(--line); border-radius: 6px; padding: 8px 12px; font-size: 13px; outline: none; margin-left: 24px; font-family: inherit; }

      /* NOTIFICACIONES */
      .notification-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:22px; }
      .notification-stat { background:var(--card); border:1px solid var(--line); border-radius:8px; padding:15px 16px; display:flex; align-items:flex-start; gap:12px; }
      .notification-stat-icon { width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; flex-shrink:0; }
      .notification-stat-icon.green { background:#176b3a; } .notification-stat-icon.blue { background:#17639a; } .notification-stat-icon.orange { background:#f59e0b; } .notification-stat-icon.purple { background:#7c3aed; }
      .notification-stat-label { font-size:10px; color:var(--ink-soft); margin-bottom:4px; }
      .notification-stat-value { font-size:20px; line-height:1; font-weight:800; color:var(--ink); }
      .notification-stat-copy { font-size:10px; color:var(--ink-soft); margin-top:4px; }
      .notification-stat-link { display:inline-block; color:var(--forest); font-size:10px; font-weight:700; margin-top:7px; text-decoration:none; }
      .notifications-layout { display:grid; grid-template-columns:minmax(0,1fr) 280px; gap:22px; }
      .notifications-panel, .notification-side-panel { background:var(--card); border:1px solid var(--line); border-radius:8px; }
      .notification-toolbar { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:14px 16px; border-bottom:1px solid var(--line); }
      .notification-tabs { display:flex; gap:18px; }
      .notification-tab { border:0; background:none; padding:0 0 8px; color:var(--ink-soft); font:600 11px inherit; cursor:pointer; position:relative; }
      .notification-tab.active { color:var(--forest); } .notification-tab.active::after { content:''; position:absolute; bottom:-15px; left:0; right:0; height:2px; background:var(--forest); }
      .notification-filters { display:flex; gap:7px; align-items:center; }
      .notification-search, .notification-select { border:1px solid var(--line); border-radius:5px; background:#fff; color:var(--ink-soft); font:400 10px inherit; padding:7px 9px; }
      .notification-search { width:145px; } .notification-select { width:120px; }
      .notification-filter-button { border:1px solid var(--line); border-radius:5px; background:#fff; color:var(--ink); font:600 10px inherit; padding:7px 9px; cursor:pointer; }
      .notification-list { padding:0 16px; }
      .notification-item { display:flex; align-items:center; gap:12px; min-height:69px; border-bottom:1px solid var(--line); }
      .notification-item:last-child { border-bottom:0; }
      .notification-item-icon { width:28px; height:28px; border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:12px; }
      .notification-item-icon.green { color:#16803c; background:#e9f7ed; } .notification-item-icon.blue { color:#17639a; background:#e8f2fb; } .notification-item-icon.orange { color:#d97706; background:#fff3d8; } .notification-item-icon.purple { color:#7c3aed; background:#f0e9ff; }
      .notification-item-body { flex:1; min-width:0; }
      .notification-item-title { color:var(--ink); font-size:11px; font-weight:700; margin:0 0 3px; }
      .notification-item-text { color:var(--ink-soft); font-size:10px; margin:0 0 3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
      .notification-item-date { color:var(--ink-soft); font-size:9px; }
      .notification-item-status { background:#e9f7ed; border-radius:8px; color:#16803c; font-size:9px; padding:3px 7px; white-space:nowrap; }
      .notification-item-status.read { background:#edf1f4; color:var(--ink-soft); }
      .notification-item-star, .notification-item-more { background:none; border:0; color:#a2aea6; cursor:pointer; padding:3px; }
      .notification-item-star.important { color:#f59e0b; }
      .notifications-footer { display:flex; justify-content:space-between; align-items:center; padding:10px 16px; color:var(--ink-soft); font-size:9px; border-top:1px solid var(--line); }
      .notification-pagination { display:flex; gap:4px; } .notification-page { width:22px; height:22px; border:1px solid var(--line); border-radius:4px; background:#fff; color:var(--ink-soft); font-size:10px; cursor:pointer; } .notification-page.active { background:var(--forest); border-color:var(--forest); color:#fff; }
      .notification-side-panel { padding:16px; margin-bottom:14px; }
      .notification-side-title { color:var(--ink); font-size:12px; font-weight:800; margin:0 0 12px; }
      .notification-side-copy { color:var(--ink-soft); font-size:10px; line-height:1.45; margin:0 0 12px; }
      .notification-preference { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:8px 0; border-top:1px solid var(--line); color:var(--ink-soft); font-size:10px; }
      .notification-preference input { accent-color:var(--forest); } .notification-settings { width:100%; border:1px solid #b8d7c0; border-radius:5px; background:#fff; color:var(--forest); font:700 10px inherit; padding:8px; cursor:pointer; }
      .notification-info { display:flex; gap:9px; margin-bottom:12px; } .notification-info:last-child { margin-bottom:0; } .notification-info i { color:var(--forest); width:14px; padding-top:2px; } .notification-info strong { display:block; color:var(--ink); font-size:10px; margin-bottom:2px; } .notification-info span { display:block; color:var(--ink-soft); font-size:9px; line-height:1.35; }

      @media (max-width: 1100px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid, .encuestas-stats { grid-template-columns: 1fr 1fr; }
        .main-grid-enc, .main-grid-op { grid-template-columns: 1fr; }
        .notification-stats { grid-template-columns:1fr 1fr; }
        .notifications-layout { grid-template-columns:1fr; }
      }
      @media (max-width: 700px) {
        .notification-toolbar { align-items:flex-start; flex-direction:column; }
        .notification-filters { width:100%; flex-wrap:wrap; }
        .notification-search { flex:1; }
      }
    </style>
</head>
<body>
<div class="app">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="brand" onclick="showSection('inicio')">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="SENA">
      </div>
      <div>
        <div class="brand-name">SIGE</div>
        <div class="brand-sub">Sistema de Gestión<br>de Egresados</div>
      </div>
    </div>

    <nav>
      <a id="nav-inicio" class="active" onclick="showSection('inicio')">
        <i class="fa-solid fa-house"></i><span>Inicio</span>
      </a>
      <a id="nav-encuestas" onclick="showSection('encuestas')">
        <i class="fa-solid fa-clipboard-list"></i><span>Encuestas</span>
      </a>
      <a id="nav-oportunidades" onclick="showSection('oportunidades')">
        <i class="fa-solid fa-briefcase"></i><span>Oportunidades Laborales</span>
      </a>
      <a id="nav-noticias" onclick="showSection('noticias')">
        <i class="fa-regular fa-calendar-days"></i><span>Noticias y Eventos</span>
      </a>
      <a id="nav-notificaciones" onclick="showSection('notificaciones')">
        <i class="fa-regular fa-bell"></i><span>Notificaciones</span>
      </a>
    </nav>

    <div class="sidebar-foot">
      @auth
        <form action="{{ route('egresados.logout') }}" method="POST">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar sesión</span>
          </button>
        </form>
      @else
        <a href="{{ route('egresados.login') }}" class="logout-btn">
          <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Iniciar Sesión</span>
        </a>
      @endauth
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
      <button class="hamburger"><i class="fa-solid fa-bars"></i></button>
      <div class="topbar-right">
        <button class="icon-btn">
          <i class="fa-regular fa-bell"></i>
          <span class="notif-badge">3</span>
        </button>
        <div class="user-profile">
          <div class="user-avatar">
            @auth{{ Auth::user()->initials }}@else EG @endauth
          </div>
          <div class="user-info">
            <div class="user-name">
              @auth{{ Auth::user()->full_name }}@else Egresado(a) CEFA @endauth
              <i class="fa-solid fa-chevron-down" style="font-size:10px; color:#6B7A70; margin-left:4px;"></i>
            </div>
            <div class="user-role">@auth{{ Auth::user()->primary_role }}@else Egresada @endauth</div>
          </div>
        </div>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

      <!-- ============ SECCIÓN: INICIO ============ -->
      <div id="section-inicio" class="section active">
        <h1 class="page-title">
          ¡Bienvenido(a), @auth{{ Auth::user()->full_name }}!@else Egresado(a)! @endauth
        </h1>
        <p class="page-desc">Desde aquí puedes consultar tus encuestas, oportunidades laborales y mantener actualizada tu información.</p>

        <div class="stats-grid">
          <!-- Encuestas -->
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-regular fa-clipboard"></i></div>
              <div>
                <div class="stat-title">Encuestas Pendientes</div>
                <div class="stat-value">2</div>
                <div class="stat-subtitle">Encuestas por responder</div>
              </div>
            </div>
            <div class="stat-footer">
              <button class="stat-link" onclick="showSection('encuestas')">
                <span>Ver encuestas</span><i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
              </button>
            </div>
          </div>

          <!-- Oportunidades -->
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-solid fa-briefcase"></i></div>
              <div>
                <div class="stat-title">Oportunidades Laborales</div>
                <div class="stat-value">8</div>
                <div class="stat-subtitle">Ofertas disponibles</div>
              </div>
            </div>
            <div class="stat-footer">
              <button class="stat-link" onclick="showSection('oportunidades')">
                <span>Ver oportunidades</span><i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
              </button>
            </div>
          </div>

          <!-- Notificaciones -->
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-regular fa-bell"></i></div>
              <div>
                <div class="stat-title">Notificaciones</div>
                <div class="stat-value">3</div>
                <div class="stat-subtitle">Mensajes sin leer</div>
              </div>
            </div>
            <div class="stat-footer">
              <button class="stat-link" onclick="showSection('notificaciones')">
                <span>Ver notificaciones</span><i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- ============ SECCIÓN: ENCUESTAS ============ -->
      <div id="section-encuestas" class="section">
        <h1 class="page-title">Encuestas</h1>
        <p class="page-desc">Participa en las encuestas disponibles y ayúdanos a mejorar nuestra gestión y servicios.</p>

        <div class="encuestas-stats">
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-regular fa-clipboard"></i></div>
              <div>
                <div class="stat-title">Encuestas Pendientes</div>
                <div class="stat-value">2</div>
                <div class="stat-subtitle">Encuestas por responder</div>
              </div>
            </div>
            <div class="stat-footer"><span class="stat-link">Ver encuestas pendientes <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-regular fa-circle-check"></i></div>
              <div>
                <div class="stat-title">Encuestas Respondidas</div>
                <div class="stat-value">5</div>
                <div class="stat-subtitle">Encuestas completadas</div>
              </div>
            </div>
            <div class="stat-footer"><span class="stat-link">Ver respondidas <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-solid fa-chart-pie"></i></div>
              <div>
                <div class="stat-title">Participación</div>
                <div class="stat-value">85%</div>
                <div class="stat-subtitle">Nivel de participación</div>
              </div>
            </div>
            <div class="stat-footer"><span class="stat-link">Ver historial <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
        </div>

        <div class="main-grid-enc">
          <div>
            <div class="tabs-bar">
              <div class="tabs">
                <button class="tab active">Pendientes (2)</button>
                <button class="tab">Respondidas (5)</button>
                <button class="tab">Todas (7)</button>
              </div>
              <div class="filters-bar">
                <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" placeholder="Buscar encuesta..."></div>
                <select class="filter-select"><option>Todas las categorías</option></select>
              </div>
            </div>

            <!-- Encuesta 1 -->
            <div class="survey-card">
              <div class="survey-icon"><i class="fa-regular fa-clipboard"></i></div>
              <div class="survey-body">
                <div class="survey-header">
                  <div>
                    <h3 class="survey-title-text">Satisfacción con los servicios institucionales 2024</h3>
                    <span class="survey-tag">Institucional</span>
                  </div>
                  <div class="survey-actions">
                    <button class="btn-responder" onclick="openSurveyModal()">Responder encuesta</button>
                    <a href="#" class="link-detalles">Ver detalles <i class="fa-solid fa-arrow-right"></i></a>
                  </div>
                </div>
                <div class="survey-meta">
                  <span><i class="fa-regular fa-calendar"></i> Fecha límite: 31 de mayo, 2024</span>
                  <span><i class="fa-regular fa-clock"></i> Tiempo estimado: 10 min</span>
                </div>
                <p class="survey-desc">Ayúdanos a conocer tu nivel de satisfacción con los servicios que ofrece nuestra institución.</p>
                <div class="survey-progress-bar"><div class="survey-progress-fill" style="width:0%"></div></div>
                <span class="survey-progress-text">0% completado</span>
              </div>
            </div>

            <!-- Encuesta 2 -->
            <div class="survey-card">
              <div class="survey-icon purple"><i class="fa-solid fa-briefcase"></i></div>
              <div class="survey-body">
                <div class="survey-header">
                  <div>
                    <h3 class="survey-title-text">Seguimiento laboral a egresados 2024</h3>
                    <span class="survey-tag purple">Laboral</span>
                  </div>
                  <div class="survey-actions">
                    <button class="btn-responder" onclick="openSurveyModal()">Responder encuesta</button>
                    <a href="#" class="link-detalles">Ver detalles <i class="fa-solid fa-arrow-right"></i></a>
                  </div>
                </div>
                <div class="survey-meta">
                  <span><i class="fa-regular fa-calendar"></i> Fecha límite: 15 de junio, 2024</span>
                  <span><i class="fa-regular fa-clock"></i> Tiempo estimado: 15 min</span>
                </div>
                <p class="survey-desc">Información importante para conocer tu situación laboral actual y mejorar nuestras oportunidades.</p>
                <div class="survey-progress-bar"><div class="survey-progress-fill" style="width:0%"></div></div>
                <span class="survey-progress-text">0% completado</span>
              </div>
            </div>
          </div>

          <!-- Panel derecho -->
          <div>
            <div class="info-card">
              <h3 class="info-title">¿Por qué participar?</h3>
              <div class="info-list">
                <div class="info-item">
                  <div class="info-item-icon"><i class="fa-solid fa-users"></i></div>
                  <div class="info-item-text"><h4>Tu opinión nos ayuda a mejorar</h4><p>Con tus respuestas podemos ofrecer mejores servicios y oportunidades.</p></div>
                </div>
                <div class="info-item">
                  <div class="info-item-icon"><i class="fa-solid fa-chart-column"></i></div>
                  <div class="info-item-text"><h4>Impacta en decisiones importantes</h4><p>Tus respuestas contribuyen a la toma de decisiones institucionales.</p></div>
                </div>
                <div class="info-item">
                  <div class="info-item-icon"><i class="fa-solid fa-shield-halved"></i></div>
                  <div class="info-item-text"><h4>Información confidencial</h4><p>Tus respuestas son anónimas y serán tratadas con total confidencialidad.</p></div>
                </div>
              </div>
            </div>
            <div class="alert-box">
              <i class="fa-solid fa-circle-info"></i>
              <div class="alert-box-text">
                <h4>Información importante</h4>
                <p>Las encuestas tienen fechas límite establecidas. Asegúrate de completarlas antes de que expiren.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ============ SECCIÓN: OPORTUNIDADES ============ -->
      <div id="section-oportunidades" class="section">
        <h1 class="page-title">Oportunidades Laborales</h1>
        <p class="page-desc">Encuentra ofertas de empleo, prácticas y oportunidades laborales disponibles para egresados.</p>

        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-content"><div class="stat-icon"><i class="fa-solid fa-briefcase"></i></div><div><div class="stat-title">Ofertas Disponibles</div><div class="stat-value">8</div><div class="stat-subtitle">Ofertas activas</div></div></div>
            <div class="stat-footer"><span class="stat-link">Ver todas las ofertas <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
          <div class="stat-card">
            <div class="stat-content"><div class="stat-icon"><i class="fa-regular fa-bookmark"></i></div><div><div class="stat-title">Guardadas</div><div class="stat-value">3</div><div class="stat-subtitle">Ofertas guardadas</div></div></div>
            <div class="stat-footer"><span class="stat-link">Ver guardadas <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
          <div class="stat-card">
            <div class="stat-content"><div class="stat-icon"><i class="fa-solid fa-paper-plane"></i></div><div><div class="stat-title">Postulaciones</div><div class="stat-value">2</div><div class="stat-subtitle">Postulaciones enviadas</div></div></div>
            <div class="stat-footer"><span class="stat-link">Ver mis postulaciones <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
        </div>

        <div class="main-grid-op">
          <div>
            <h2 class="section-title">Ofertas Laborales</h2>
            <div class="search-bar">
              <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" placeholder="Buscar por cargo, empresa o palabra clave..."></div>
              <select class="filter-select"><option>📍 Todas las ubicaciones</option><option>Bogotá, D.C.</option><option>Cali, Valle del Cauca</option></select>
              <select class="filter-select"><option>🏷 Todas las categorías</option><option>Tecnología</option><option>Marketing Digital</option></select>
            </div>

            <div class="job-card">
              <div class="job-logo" style="background:#E0F0FF;color:#1D4ED8;">TS</div>
              <div class="job-body">
                <div class="job-header"><div><p class="job-title">Análisis de Sistemas</p><p class="job-company">TrabSistema S.A.S.</p></div><span class="badge-new">Nuevo</span></div>
                <div class="job-meta"><span><i class="fa-solid fa-location-dot"></i> Bogotá, D.C.</span><span><i class="fa-regular fa-clock"></i> Tiempo completo</span><span><i class="fa-regular fa-calendar"></i> Publicado hace 1 día</span></div>
                <p class="job-desc">Buscamos profesionales o técnicos en sistemas para análisis, diseño y desarrollo de soluciones.</p>
                <div class="job-footer"><button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button><button class="btn-ver">Ver oferta</button></div>
              </div>
            </div>
            <div class="job-card">
              <div class="job-logo" style="background:#F0FFF4;color:#166534;font-weight:800;">IN</div>
              <div class="job-body">
                <div class="job-header"><div><p class="job-title">Desarrollador Full Stack</p><p class="job-company">InnovaB</p></div><span class="badge-new">Nuevo</span></div>
                <div class="job-meta"><span><i class="fa-solid fa-location-dot"></i> Medellín</span><span><i class="fa-regular fa-clock"></i> Tiempo completo</span><span><i class="fa-regular fa-calendar"></i> Publicado hace 3 días</span></div>
                <p class="job-desc">Únete a nuestro equipo de desarrollo dinámico para construir soluciones innovadoras.</p>
                <div class="job-footer"><button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button><button class="btn-ver">Ver oferta</button></div>
              </div>
            </div>
            <div class="job-card">
              <div class="job-logo" style="background:#F5F3FF;color:#7C3AED;">GA</div>
              <div class="job-body">
                <div class="job-header"><div><p class="job-title">Analista de Talento Humano</p><p class="job-company">Grupo Andino</p></div><div></div></div>
                <div class="job-meta"><span><i class="fa-solid fa-location-dot"></i> Cali, Valle del Cauca</span><span><i class="fa-regular fa-clock"></i> Tiempo completo</span><span><i class="fa-regular fa-calendar"></i> Publicado hace 5 días</span></div>
                <p class="job-desc">Apoyar procesos de selección, capacitación y desarrollo del talento humano.</p>
                <div class="job-footer"><button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button><button class="btn-ver">Ver oferta</button></div>
              </div>
            </div>
            <div class="job-card">
              <div class="job-logo" style="background:#FFF7ED;color:#C2410C;">CN</div>
              <div class="job-body">
                <div class="job-header"><div><p class="job-title">Practicante de Marketing Digital</p><p class="job-company">Conector</p></div><div></div></div>
                <div class="job-meta"><span><i class="fa-solid fa-location-dot"></i> Bogotá, D.C.</span><span><i class="fa-regular fa-clock"></i> Práctica</span><span><i class="fa-regular fa-calendar"></i> Publicado hace 1 semana</span></div>
                <p class="job-desc">Apoyo en gestión de redes sociales, campañas y análisis de métricas.</p>
                <div class="job-footer"><button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button><button class="btn-ver">Ver oferta</button></div>
              </div>
            </div>
            <div class="job-card">
              <div class="job-logo" style="background:#FFF0F0;color:#B91C1C;font-size:11px;">SAF</div>
              <div class="job-body">
                <div class="job-header"><div><p class="job-title">Profesional en Ingeniería Biomédica</p><p class="job-company">SaluFacil IPS</p></div><div></div></div>
                <div class="job-meta"><span><i class="fa-solid fa-location-dot"></i> Neiva, Huila</span><span><i class="fa-regular fa-clock"></i> Tiempo completo</span><span><i class="fa-regular fa-calendar"></i> Publicado hace 1 semana</span></div>
                <p class="job-desc">Profesional en ingeniería biomédica para gestión y mantenimiento de equipos.</p>
                <div class="job-footer"><button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button><button class="btn-ver">Ver oferta</button></div>
              </div>
            </div>
            <button class="ver-todas-link">Ver todas las ofertas <i class="fa-solid fa-arrow-right" style="font-size:11px;"></i></button>
          </div>

          <div>
            <div class="filter-panel">
              <h3 class="filter-panel-title">Filtros</h3>
              <div class="filter-group">
                <h4 class="filter-group-title">Tipo de oferta</h4>
                <label class="filter-checkbox"><input type="checkbox" checked> Todos</label>
                <label class="filter-checkbox"><input type="checkbox"> Tiempo completo</label>
                <label class="filter-checkbox"><input type="checkbox"> Medio tiempo</label>
                <label class="filter-checkbox"><input type="checkbox"> Práctica</label>
                <label class="filter-checkbox"><input type="checkbox"> Freelance</label>
              </div>
              <div class="filter-group">
                <h4 class="filter-group-title">Ubicación</h4>
                <select class="filter-select-full"><option>Todas las ubicaciones</option><option>Bogotá, D.C.</option><option>Cali, Valle del Cauca</option></select>
              </div>
              <div class="filter-group">
                <h4 class="filter-group-title">Categoría</h4>
                <select class="filter-select-full"><option>Todas las categorías</option><option>Tecnología</option><option>Marketing Digital</option></select>
              </div>
              <div class="filter-group">
                <h4 class="filter-group-title">Fecha de publicación</h4>
                <select class="filter-select-full"><option>Cualquier momento</option><option>Hoy</option><option>Esta semana</option></select>
              </div>
              <button class="btn-apply">Aplicar filtros</button>
              <button class="btn-clear">Limpiar filtros</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ============ SECCIÓN: NOTICIAS ============ -->
      <div id="section-noticias" class="section">
        <h1 class="page-title">Noticias y Eventos</h1>
        <p class="page-desc">Entérate de los eventos, actividades y noticias más recientes para egresados.</p>

        <!-- Stats cards -->
        <div class="stats-grid" style="margin-bottom:26px;">
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-regular fa-calendar-days"></i></div>
              <div><div class="stat-title">Eventos Activos</div><div class="stat-value">5</div><div class="stat-subtitle">Eventos disponibles</div></div>
            </div>
            <div class="stat-footer"><span class="stat-link">Ver eventos <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon"><i class="fa-solid fa-user-check"></i></div>
              <div><div class="stat-title">Eventos Inscritos</div><div class="stat-value">2</div><div class="stat-subtitle">Ya inscritos</div></div>
            </div>
            <div class="stat-footer"><span class="stat-link">Ver mis eventos <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-icon" style="background:#D97706;"><i class="fa-regular fa-newspaper"></i></div>
              <div><div class="stat-title">Noticias Recientes</div><div class="stat-value">3</div><div class="stat-subtitle">Nuevas publicaciones</div></div>
            </div>
            <div class="stat-footer"><span class="stat-link">Ver noticias <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></span></div>
          </div>
        </div>

        <!-- Main grid -->
        <div style="display:grid; grid-template-columns:1fr 280px; gap:24px;">

          <!-- LEFT: eventos -->
          <div>
            <!-- Tabs + search -->
            <div class="tabs-bar">
              <div class="tabs">
                <button class="tab active">Próximos Eventos</button>
                <button class="tab">Mis Eventos</button>
              </div>
              <div class="filters-bar" style="gap:8px;">
                <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" placeholder="Buscar evento..."></div>
                <div class="filter-select" style="display:flex;align-items:center;gap:6px;"><i class="fa-regular fa-calendar" style="color:var(--ink-soft);"></i> Todas las fechas</div>
                <select class="filter-select"><option>Todas las categorías</option><option>Académico</option><option>Laboral</option><option>Social</option><option>Red de Egresados</option></select>
              </div>
            </div>

            <!-- Evento 1 -->
            <div style="background:var(--card);border:1px solid var(--line);border-radius:12px;padding:18px;margin-bottom:12px;display:flex;gap:16px;transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 6px 20px rgba(1,56,25,0.07)'" onmouseout="this.style.boxShadow=''">
              <div style="width:90px;height:70px;border-radius:8px;background:linear-gradient(135deg,#1e3a5f,#2563EB);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:28px;"><i class="fa-solid fa-users"></i></div>
              <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                  <div>
                    <span style="background:#EEF2FF;color:#4338CA;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;margin-bottom:6px;display:inline-block;">Académico</span>
                    <h3 style="font-size:14.5px;font-weight:700;color:var(--ink);margin:0 0 6px;">Taller: Habilidades Blandas para el Éxito Profesional</h3>
                    <div style="font-size:12px;color:var(--ink-soft);display:flex;flex-wrap:wrap;gap:12px;">
                      <span><i class="fa-regular fa-calendar"></i> 10 de junio, 2024 &nbsp;|&nbsp; 9:00 a.m. – 12:00 p.m.</span>
                      <span><i class="fa-solid fa-location-dot"></i> Virtual</span>
                      <span style="font-size:11px;color:var(--ink-soft);">Facilitador: Andrés Palacios</span>
                    </div>
                    <p style="font-size:12.5px;color:var(--ink-soft);margin:8px 0 0;line-height:1.4;">Desarrolla habilidades clave como comunicación, liderazgo y trabajo en equipo.</p>
                  </div>
                  <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;margin-left:12px;">
                    <span style="background:#D1FAE5;color:#065F46;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;">Disponible</span>
                    <button style="background:transparent;border:none;color:var(--forest);font-weight:600;font-size:13px;cursor:pointer;">Ver más</button>
                    <button class="btn-responder" style="padding:7px 14px;font-size:12.5px;" onclick="openInscripcionModal()">Inscribirse</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Evento 2 -->
            <div style="background:var(--card);border:1px solid var(--line);border-radius:12px;padding:18px;margin-bottom:12px;display:flex;gap:16px;" onmouseover="this.style.boxShadow='0 6px 20px rgba(1,56,25,0.07)'" onmouseout="this.style.boxShadow=''">
              <div style="width:90px;height:70px;border-radius:8px;background:linear-gradient(135deg,#065F46,#059669);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:28px;"><i class="fa-solid fa-briefcase"></i></div>
              <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                  <div>
                    <span style="background:#DCFCE7;color:#15803D;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;margin-bottom:6px;display:inline-block;">Laboral</span>
                    <h3 style="font-size:14.5px;font-weight:700;color:var(--ink);margin:0 0 6px;">Feria Laboral 2024</h3>
                    <div style="font-size:12px;color:var(--ink-soft);display:flex;flex-wrap:wrap;gap:12px;">
                      <span><i class="fa-regular fa-calendar"></i> 20 de junio, 2024 &nbsp;|&nbsp; 7:00 a.m. – 5:00 p.m.</span>
                      <span><i class="fa-solid fa-location-dot"></i> Virtual</span>
                    </div>
                    <p style="font-size:12.5px;color:var(--ink-soft);margin:8px 0 0;line-height:1.4;">Conecta con empresas y encuentra tu próxima oportunidad laboral.</p>
                  </div>
                  <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;margin-left:12px;">
                    <span style="background:#D1FAE5;color:#065F46;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;">Disponible</span>
                    <button style="background:transparent;border:none;color:var(--forest);font-weight:600;font-size:13px;cursor:pointer;">Ver más</button>
                    <button class="btn-responder" style="padding:7px 14px;font-size:12.5px;" onclick="openInscripcionModal()">Inscribirse</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Evento 3 -->
            <div style="background:var(--card);border:1px solid var(--line);border-radius:12px;padding:18px;margin-bottom:12px;display:flex;gap:16px;" onmouseover="this.style.boxShadow='0 6px 20px rgba(1,56,25,0.07)'" onmouseout="this.style.boxShadow=''">
              <div style="width:90px;height:70px;border-radius:8px;background:linear-gradient(135deg,#7C3AED,#A855F7);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:28px;"><i class="fa-solid fa-lightbulb"></i></div>
              <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                  <div>
                    <span style="background:#F3E8FF;color:#7E22CE;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;margin-bottom:6px;display:inline-block;">Social</span>
                    <h3 style="font-size:14.5px;font-weight:700;color:var(--ink);margin:0 0 6px;">Conversatorio: Innovación y Tecnología</h3>
                    <div style="font-size:12px;color:var(--ink-soft);display:flex;flex-wrap:wrap;gap:12px;">
                      <span><i class="fa-regular fa-calendar"></i> 28 de junio, 2024 &nbsp;|&nbsp; 6:00 – 8:00 p.m.</span>
                      <span><i class="fa-solid fa-location-dot"></i> Auditorio Principal</span>
                    </div>
                    <p style="font-size:12.5px;color:var(--ink-soft);margin:8px 0 0;line-height:1.4;">Diálogo con expertos en innovación digital para egresados.</p>
                  </div>
                  <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;margin-left:12px;">
                    <span style="background:#FEF3C7;color:#92400E;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;">Cupo limitado</span>
                    <button style="background:transparent;border:none;color:var(--forest);font-weight:600;font-size:13px;cursor:pointer;">Ver más</button>
                    <button class="btn-responder" style="padding:7px 14px;font-size:12.5px;" onclick="openInscripcionModal()">Inscribirse</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Evento 4 -->
            <div style="background:var(--card);border:1px solid var(--line);border-radius:12px;padding:18px;margin-bottom:12px;display:flex;gap:16px;" onmouseover="this.style.boxShadow='0 6px 20px rgba(1,56,25,0.07)'" onmouseout="this.style.boxShadow=''">
              <div style="width:90px;height:70px;border-radius:8px;background:linear-gradient(135deg,#0369A1,#0EA5E9);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:28px;"><i class="fa-solid fa-network-wired"></i></div>
              <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                  <div>
                    <span style="background:#E0F2FE;color:#0369A1;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;margin-bottom:6px;display:inline-block;">Red de Egresados</span>
                    <h3 style="font-size:14.5px;font-weight:700;color:var(--ink);margin:0 0 6px;">Networking Egresados 2024</h3>
                    <div style="font-size:12px;color:var(--ink-soft);display:flex;flex-wrap:wrap;gap:12px;">
                      <span><i class="fa-regular fa-calendar"></i> 5 de julio, 2024 &nbsp;|&nbsp; 4:00 p.m.</span>
                      <span><i class="fa-solid fa-location-dot"></i> Sala de Conferencias</span>
                    </div>
                    <p style="font-size:12.5px;color:var(--ink-soft);margin:8px 0 0;line-height:1.4;">Espacio para compartir experiencias y generar conexiones profesionales.</p>
                  </div>
                  <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;margin-left:12px;">
                    <span style="background:#D1FAE5;color:#065F46;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;">Disponible</span>
                    <button style="background:transparent;border:none;color:var(--forest);font-weight:600;font-size:13px;cursor:pointer;">Ver más</button>
                    <button class="btn-responder" style="padding:7px 14px;font-size:12.5px;" onclick="openInscripcionModal()">Inscribirse</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Evento 5 -->
            <div style="background:var(--card);border:1px solid var(--line);border-radius:12px;padding:18px;margin-bottom:16px;display:flex;gap:16px;" onmouseover="this.style.boxShadow='0 6px 20px rgba(1,56,25,0.07)'" onmouseout="this.style.boxShadow=''">
              <div style="width:90px;height:70px;border-radius:8px;background:linear-gradient(135deg,#1e3a5f,#1D4ED8);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:28px;"><i class="fa-solid fa-rocket"></i></div>
              <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                  <div>
                    <span style="background:#EEF2FF;color:#4338CA;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;margin-bottom:6px;display:inline-block;">Académico</span>
                    <h3 style="font-size:14.5px;font-weight:700;color:var(--ink);margin:0 0 6px;">Seminario: Emprendimiento y Negocios</h3>
                    <div style="font-size:12px;color:var(--ink-soft);display:flex;flex-wrap:wrap;gap:12px;">
                      <span><i class="fa-regular fa-calendar"></i> 15 de julio, 2024 &nbsp;|&nbsp; 9:00 a.m. &nbsp;|&nbsp; Virtual</span>
                    </div>
                    <p style="font-size:12.5px;color:var(--ink-soft);margin:8px 0 0;line-height:1.4;">Aprende sobre modelos de negocio y tendencias del mercado.</p>
                  </div>
                  <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;margin-left:12px;">
                    <span style="background:#D1FAE5;color:#065F46;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;">Disponible</span>
                    <button style="background:transparent;border:none;color:var(--forest);font-weight:600;font-size:13px;cursor:pointer;">Ver más</button>
                    <button class="btn-responder" style="padding:7px 14px;font-size:12.5px;" onclick="openInscripcionModal()">Inscribirse</button>
                  </div>
                </div>
              </div>
            </div>

            <button class="ver-todas-link">Ver todos los eventos <i class="fa-solid fa-arrow-right" style="font-size:11px;"></i></button>
          </div>

          <!-- RIGHT: Noticias recientes -->
          <div>
            <div class="filter-panel">
              <h3 class="filter-panel-title">Noticias Recientes</h3>
              
              <!-- Noticia 1 -->
              <div style="border-bottom:1px solid var(--line);padding-bottom:14px;margin-bottom:14px;">
                <div style="width:100%;height:90px;border-radius:8px;background:linear-gradient(135deg,#0369A1,#7C3AED);margin-bottom:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:32px;"><i class="fa-solid fa-gift"></i></div>
                <h4 style="font-size:13.5px;font-weight:700;color:var(--ink);margin:0 0 5px;">Nueva plataforma de beneficios</h4>
                <div style="font-size:11.5px;color:var(--ink-soft);margin-bottom:6px;"><i class="fa-regular fa-calendar" style="margin-right:4px;"></i>5 de mayo, 2024</div>
                <p style="font-size:12px;color:var(--ink-soft);margin:0 0 8px;line-height:1.4;">Conoce los nuevos beneficios exclusivos para egresados registrados.</p>
                <a href="#" style="font-size:12px;color:var(--forest);font-weight:700;text-decoration:none;">Leer más →</a>
              </div>

              <!-- Noticia 2 -->
              <div style="border-bottom:1px solid var(--line);padding-bottom:14px;margin-bottom:14px;">
                <div style="width:100%;height:90px;border-radius:8px;background:linear-gradient(135deg,#065F46,#39A900);margin-bottom:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:32px;"><i class="fa-solid fa-graduation-cap"></i></div>
                <h4 style="font-size:13.5px;font-weight:700;color:var(--ink);margin:0 0 5px;">Historias de éxito: Egresados destacados</h4>
                <div style="font-size:11.5px;color:var(--ink-soft);margin-bottom:6px;"><i class="fa-regular fa-calendar" style="margin-right:4px;"></i>30 de mayo, 2024</div>
                <p style="font-size:12px;color:var(--ink-soft);margin:0 0 8px;line-height:1.4;">Conoce las trayectorias exitosas de nuestros egresados más sobresalientes.</p>
                <a href="#" style="font-size:12px;color:var(--forest);font-weight:700;text-decoration:none;">Leer más →</a>
              </div>

              <!-- Noticia 3 -->
              <div>
                <div style="width:100%;height:90px;border-radius:8px;background:linear-gradient(135deg,#92400E,#D97706);margin-bottom:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:32px;"><i class="fa-solid fa-book-open"></i></div>
                <h4 style="font-size:13.5px;font-weight:700;color:var(--ink);margin:0 0 5px;">Cursos gratuitos para egresados</h4>
                <div style="font-size:11.5px;color:var(--ink-soft);margin-bottom:6px;"><i class="fa-regular fa-calendar" style="margin-right:4px;"></i>2 de junio, 2024</div>
                <p style="font-size:12px;color:var(--ink-soft);margin:0 0 8px;line-height:1.4;">Accede a cursos certificados de forma gratuita para seguir creciendo.</p>
                <a href="#" style="font-size:12px;color:var(--forest);font-weight:700;text-decoration:none;">Leer más →</a>
              </div>

              <button class="btn-apply" style="margin-top:16px;">Ver todas las noticias</button>
            </div>
          </div>

        </div>

        <!-- Footer notif bar -->
        <div style="margin-top:20px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:8px;padding:12px 18px;display:flex;align-items:center;gap:12px;font-size:13px;color:#166534;">
          <i class="fa-solid fa-circle-check" style="color:#16A34A;"></i>
          <span>Recibirás notificaciones sobre nuevos eventos de tu interés.</span>
          <a href="#" style="margin-left:auto;color:#15803D;font-weight:700;text-decoration:none;">Gestionar preferencias</a>
        </div>
      </div>

      <!-- ============ SECCIÓN: NOTIFICACIONES ============ -->
      <div id="section-notificaciones" class="section">
        <h1 class="page-title">Notificaciones</h1>
        <p class="page-desc">Aquí puedes ver tus notificaciones y mantenerte al día con la información importante.</p>
        <div class="notification-stats">
          <div class="notification-stat"><div class="notification-stat-icon green"><i class="fa-regular fa-bell"></i></div><div><div class="notification-stat-label">No leídas</div><div class="notification-stat-value">3</div><div class="notification-stat-copy">Tienes notificaciones sin leer</div><a class="notification-stat-link" href="#" onclick="return false;">Ver todas <i class="fa-solid fa-arrow-right"></i></a></div></div>
          <div class="notification-stat"><div class="notification-stat-icon blue"><i class="fa-regular fa-envelope"></i></div><div><div class="notification-stat-label">Leídas</div><div class="notification-stat-value">12</div><div class="notification-stat-copy">Notificaciones leídas</div><a class="notification-stat-link" href="#" onclick="return false;">Ver todas <i class="fa-solid fa-arrow-right"></i></a></div></div>
          <div class="notification-stat"><div class="notification-stat-icon orange"><i class="fa-solid fa-paper-plane"></i></div><div><div class="notification-stat-label">Importantes</div><div class="notification-stat-value">2</div><div class="notification-stat-copy">Marcadas como importantes</div><a class="notification-stat-link" href="#" onclick="return false;">Ver importantes <i class="fa-solid fa-arrow-right"></i></a></div></div>
          <div class="notification-stat"><div class="notification-stat-icon purple"><i class="fa-solid fa-trash-can"></i></div><div><div class="notification-stat-label">Eliminadas</div><div class="notification-stat-value">0</div><div class="notification-stat-copy">Notificaciones eliminadas</div><a class="notification-stat-link" href="#" onclick="return false;">Ver eliminadas <i class="fa-solid fa-arrow-right"></i></a></div></div>
        </div>
        <div class="notifications-layout">
          <div class="notifications-panel">
            <div class="notification-toolbar">
              <div class="notification-tabs"><button class="notification-tab active">Todas</button><button class="notification-tab">No leídas</button><button class="notification-tab">Leídas</button><button class="notification-tab">Importantes</button></div>
              <div class="notification-filters"><input class="notification-search" type="search" placeholder="Buscar notificación..."><select class="notification-select"><option>Todas las categorías</option><option>Eventos</option><option>Encuestas</option><option>Oportunidades</option></select><button class="notification-filter-button"><i class="fa-solid fa-filter"></i> Filtros</button></div>
            </div>
            <div class="notification-list">
              <article class="notification-item"><div class="notification-item-icon green"><i class="fa-regular fa-calendar"></i></div><div class="notification-item-body"><h3 class="notification-item-title">Nuevo evento disponible</h3><p class="notification-item-text">Se ha publicado un nuevo evento: Taller de Habilidades Blandas para el Éxito Profesional.</p><span class="notification-item-date"><i class="fa-regular fa-clock"></i> 14 de mayo, 2024 · 10:30 a.m.</span></div><span class="notification-item-status">No leída</span><button class="notification-item-star" title="Marcar como importante"><i class="fa-regular fa-star"></i></button><button class="notification-item-more" title="Más opciones"><i class="fa-solid fa-chevron-right"></i></button></article>
              <article class="notification-item"><div class="notification-item-icon blue"><i class="fa-solid fa-briefcase"></i></div><div class="notification-item-body"><h3 class="notification-item-title">Nueva oferta laboral para ti</h3><p class="notification-item-text">ConectaTech SAS ha publicado una nueva oferta: Desarrollador Full Stack.</p><span class="notification-item-date"><i class="fa-regular fa-clock"></i> 14 de mayo, 2024 · 9:30 a.m.</span></div><span class="notification-item-status">No leída</span><button class="notification-item-star" title="Marcar como importante"><i class="fa-regular fa-star"></i></button><button class="notification-item-more" title="Más opciones"><i class="fa-solid fa-chevron-right"></i></button></article>
              <article class="notification-item"><div class="notification-item-icon orange"><i class="fa-regular fa-clipboard"></i></div><div class="notification-item-body"><h3 class="notification-item-title">Encuesta disponible</h3><p class="notification-item-text">Tienes una nueva encuesta disponible: Satisfacción con los servicios institucionales 2024.</p><span class="notification-item-date"><i class="fa-regular fa-clock"></i> 14 de mayo, 2024 · 9:00 a.m.</span></div><span class="notification-item-status">No leída</span><button class="notification-item-star" title="Marcar como importante"><i class="fa-regular fa-star"></i></button><button class="notification-item-more" title="Más opciones"><i class="fa-solid fa-chevron-right"></i></button></article>
              <article class="notification-item"><div class="notification-item-icon purple"><i class="fa-solid fa-bullhorn"></i></div><div class="notification-item-body"><h3 class="notification-item-title">Recordatorio de evento</h3><p class="notification-item-text">Te recordamos que el evento Networking Egresados 2024 es mañana.</p><span class="notification-item-date"><i class="fa-regular fa-clock"></i> 13 de mayo, 2024 · 6:00 p.m.</span></div><span class="notification-item-status read">Leída</span><button class="notification-item-star important" title="Importante"><i class="fa-solid fa-star"></i></button><button class="notification-item-more" title="Más opciones"><i class="fa-solid fa-chevron-right"></i></button></article>
              <article class="notification-item"><div class="notification-item-icon green"><i class="fa-regular fa-envelope"></i></div><div class="notification-item-body"><h3 class="notification-item-title">Nuevo mensaje</h3><p class="notification-item-text">Ya está disponible el boletín mensual de mayo con noticias y oportunidades para egresados.</p><span class="notification-item-date"><i class="fa-regular fa-clock"></i> 12 de mayo, 2024 · 7:20 a.m.</span></div><span class="notification-item-status read">Leída</span><button class="notification-item-star" title="Marcar como importante"><i class="fa-regular fa-star"></i></button><button class="notification-item-more" title="Más opciones"><i class="fa-solid fa-chevron-right"></i></button></article>
            </div>
            <div class="notifications-footer"><span>Mostrando 1 a 5 de 15 notificaciones</span><div class="notification-pagination"><button class="notification-page active">1</button><button class="notification-page">2</button><button class="notification-page">3</button><button class="notification-page"><i class="fa-solid fa-chevron-right"></i></button></div></div>
          </div>
          <aside>
            <div class="notification-side-panel"><h2 class="notification-side-title">Preferencias de notificaciones</h2><p class="notification-side-copy">Elige cómo y cuándo deseas recibir notificaciones.</p><label class="notification-preference"><span><i class="fa-regular fa-envelope"></i> Correo electrónico</span><input type="checkbox" checked></label><label class="notification-preference"><span><i class="fa-solid fa-mobile-screen"></i> Notificaciones en el portal</span><input type="checkbox" checked></label><button class="notification-settings"><i class="fa-solid fa-gear"></i> Gestionar preferencias</button></div>
            <div class="notification-side-panel"><h2 class="notification-side-title">Información</h2><div class="notification-info"><i class="fa-solid fa-bolt"></i><div><strong>Notificaciones en tiempo real</strong><span>Recibe alertas importantes sobre eventos, ofertas laborales y encuestas.</span></div></div><div class="notification-info"><i class="fa-solid fa-sliders"></i><div><strong>Personaliza tus preferencias</strong><span>Configura cómo deseas recibir las notificaciones según tus necesidades.</span></div></div><div class="notification-info"><i class="fa-regular fa-bell"></i><div><strong>No te pierdas nada</strong><span>Activa las notificaciones para estar siempre informado sobre oportunidades y eventos importantes.</span></div></div></div>
          </aside>
        </div>
      </div>

    </div><!-- end .content -->
  </div><!-- end .main -->
</div><!-- end .app -->

<!-- MODAL ENCUESTA -->
<div class="modal-overlay" id="surveyModal">
  <div class="modal-content">
    <button class="modal-close" onclick="closeSurveyModal()"><i class="fa-solid fa-xmark"></i></button>
    <div class="modal-header"><i class="fa-regular fa-eye"></i> Vista previa de la encuesta</div>
    <div class="survey-info-box">
      <h3 class="survey-info-title">Encuesta Insercion Laboral</h3>
      <p class="survey-info-desc">Encuesta para conocer la situación laboral y experiencias de los egresados del programa ADSO.</p>
    </div>
    <div class="required-text">* Campos obligatorios</div>
    <form onsubmit="event.preventDefault(); closeSurveyModal();">
      <div class="survey-question">
        <h4 class="question-title">1. ¿Qué tan satisfecho está con su formación académica? <span>*</span></h4>
        <label class="radio-option"><input type="radio" name="q1" required> Excelente</label>
        <label class="radio-option"><input type="radio" name="q1"> Buena</label>
        <label class="radio-option"><input type="radio" name="q1"> Regular</label>
        <label class="radio-option"><input type="radio" name="q1"> Mala</label>
      </div>
      <div class="survey-question">
        <h4 class="question-title">2. ¿Actualmente se encuentra trabajando? <span>*</span></h4>
        <label class="radio-option"><input type="radio" name="q2" required> Si</label>
        <label class="radio-option"><input type="radio" name="q2"> No</label>
      </div>
      <div class="survey-question">
        <h4 class="question-title">3. ¿En qué área se desempeña actualmente? <span>*</span></h4>
        <label class="radio-option"><input type="radio" name="q3" required> Administrativa</label>
        <label class="radio-option"><input type="radio" name="q3"> Financiera</label>
        <label class="radio-option"><input type="radio" name="q3"> Comercial</label>
        <label class="radio-option"><input type="radio" name="q3"> Otra</label>
        <input type="text" class="specify-input" placeholder="Especifique">
      </div>
      <div style="margin-top:24px; text-align:right;">
        <button type="submit" class="btn-responder">Enviar Respuestas</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL INSCRIPCIÓN AL EVENTO -->
<div class="modal-overlay" id="inscripcionModal" onclick="if(event.target===this)closeInscripcionModal()">
  <div class="modal-content" style="max-width:440px;">
    <button class="modal-close" onclick="closeInscripcionModal()"><i class="fa-solid fa-xmark"></i></button>

    <div class="modal-header" style="margin-bottom:20px;">
      Inscribirse al evento
    </div>

    <form onsubmit="event.preventDefault(); confirmInscripcion();">
      <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:var(--ink);margin-bottom:6px;">Nombre completo</label>
        <input type="text" value="@auth{{ Auth::user()->first_name ?? Auth::user()->name ?? 'Ana María López' }}@else Ana María López @endauth"
          style="width:100%;border:1px solid var(--line);border-radius:8px;padding:10px 14px;font-size:13.5px;outline:none;font-family:inherit;color:var(--ink);"
          required>
      </div>

      <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:var(--ink);margin-bottom:6px;">Correo electrónico</label>
        <input type="email" value="@auth{{ Auth::user()->email ?? 'ana.lopez@unidep.edu.co' }}@else ana.lopez@unidep.edu.co @endauth"
          style="width:100%;border:1px solid var(--line);border-radius:8px;padding:10px 14px;font-size:13.5px;outline:none;font-family:inherit;color:var(--ink);"
          required>
      </div>

      <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:var(--ink);margin-bottom:6px;">Teléfono</label>
        <input type="tel" placeholder="300 123 4567"
          style="width:100%;border:1px solid var(--line);border-radius:8px;padding:10px 14px;font-size:13.5px;outline:none;font-family:inherit;color:var(--ink);">
      </div>

      <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:var(--ink);margin-bottom:6px;">Programa / Carrera</label>
        <input type="text" placeholder="Ingeniería de Sistemas"
          style="width:100%;border:1px solid var(--line);border-radius:8px;padding:10px 14px;font-size:13.5px;outline:none;font-family:inherit;color:var(--ink);">
      </div>

      <div style="margin-bottom:24px;">
        <label style="display:block;font-size:13px;font-weight:600;color:var(--ink);margin-bottom:6px;">Observaciones (opcional)</label>
        <textarea placeholder="Ej. Requerimientos especiales, comentarios, etc."
          rows="3"
          style="width:100%;border:1px solid var(--line);border-radius:8px;padding:10px 14px;font-size:13px;outline:none;font-family:inherit;color:var(--ink);resize:vertical;"></textarea>
      </div>

      <div style="display:flex;gap:12px;justify-content:flex-end;">
        <button type="button" onclick="closeInscripcionModal()"
          style="padding:10px 22px;border:1px solid var(--line);border-radius:8px;background:#fff;color:var(--ink);font-size:13.5px;font-weight:600;cursor:pointer;font-family:inherit;">
          Cancelar
        </button>
        <button type="submit"
          style="padding:10px 22px;border:none;border-radius:8px;background:var(--forest);color:#fff;font-size:13.5px;font-weight:600;cursor:pointer;font-family:inherit;transition:background 0.2s;"
          onmouseover="this.style.background='var(--green-dark)'" onmouseout="this.style.background='var(--forest)'">
          Confirmar inscripción
        </button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL CONFIRMACIÓN EXITOSA -->
<div class="modal-overlay" id="confirmadoModal" onclick="if(event.target===this)closeConfirmadoModal()">
  <div class="modal-content" style="max-width:380px;text-align:center;">
    <div style="width:64px;height:64px;border-radius:50%;background:var(--green-soft);color:var(--forest);font-size:28px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;">
      <i class="fa-solid fa-circle-check"></i>
    </div>
    <h3 style="font-size:18px;font-weight:700;color:var(--forest);margin:0 0 10px;">¡Inscripción confirmada!</h3>
    <p style="font-size:13.5px;color:var(--ink-soft);margin:0 0 24px;line-height:1.5;">Te has inscrito exitosamente al evento. Recibirás un correo con los detalles.</p>
    <button onclick="closeConfirmadoModal()"
      style="padding:10px 28px;border:none;border-radius:8px;background:var(--forest);color:#fff;font-size:13.5px;font-weight:600;cursor:pointer;font-family:inherit;">
      Aceptar
    </button>
  </div>
</div>

<script>
  const sections = ['inicio','encuestas','oportunidades','noticias','notificaciones'];

  function showSection(name) {
    sections.forEach(s => {
      document.getElementById('section-' + s).classList.remove('active');
      document.getElementById('nav-' + s).classList.remove('active');
    });
    document.getElementById('section-' + name).classList.add('active');
    document.getElementById('nav-' + name).classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function openSurveyModal() {
    document.getElementById('surveyModal').classList.add('active');
  }
  function closeSurveyModal() {
    document.getElementById('surveyModal').classList.remove('active');
  }

  function openInscripcionModal() {
    document.getElementById('inscripcionModal').classList.add('active');
  }
  function closeInscripcionModal() {
    document.getElementById('inscripcionModal').classList.remove('active');
  }

  function confirmInscripcion() {
    closeInscripcionModal();
    setTimeout(() => {
      document.getElementById('confirmadoModal').classList.add('active');
    }, 200);
  }

  function closeConfirmadoModal() {
    document.getElementById('confirmadoModal').classList.remove('active');
  }

  document.getElementById('surveyModal').addEventListener('click', function(e) {
    if (e.target === this) closeSurveyModal();
  });
</script>
</body>
</html>
