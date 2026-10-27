<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $reportTitle }} · SIGE CEFA</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 12px; color: #222; margin: 30px; }
        .header { border-bottom: 3px solid #39A900; padding-bottom: 12px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo-title h1 { margin: 0; font-size: 18px; color: #001A29; }
        .logo-title h2 { margin: 4px 0 0; font-size: 14px; color: #39A900; }
        .meta { font-size: 10px; color: #666; text-align: right; }
        .summary-box { background: #f8faf9; border: 1px solid #e2ece5; border-radius: 8px; padding: 15px; margin-bottom: 25px; }
        .summary-grid { display: table; width: 100%; }
        .summary-col { display: table-cell; width: 25%; text-align: center; }
        .summary-num { font-size: 20px; font-weight: bold; color: #001A29; }
        .summary-label { font-size: 10px; color: #666; text-transform: uppercase; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 11px; }
        th { background: #001A29; color: #ffffff; padding: 8px 6px; text-align: left; font-weight: 600; }
        td { border-bottom: 1px solid #e5e7eb; padding: 7px 6px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .badge { padding: 2px 6px; border-radius: 4px; font-size: 9px; font-weight: bold; }
        .badge-emp { background: #dcfce7; color: #166534; }
        .footer { margin-top: 40px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 9px; color: #777; text-align: center; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #39A900; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
            🖨️ Imprimir / Guardar como PDF
        </button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #eee; border: 1px solid #ccc; border-radius: 6px; margin-left: 8px; cursor: pointer;">
            Cerrar
        </button>
    </div>

    <div class="header">
        <div class="logo-title">
            <h1>SENA EMPRESA — Centro Agroindustrial La Angostura</h1>
            <h2>{{ $reportTitle }}</h2>
        </div>
        <div class="meta">
            <div>ID Reporte: <strong>{{ $id }}</strong></div>
            <div>Fecha: {{ date('d/m/Y H:i') }}</div>
            <div>Emisor: Coordinación Académica SIGE</div>
        </div>
    </div>

    <div class="summary-box">
        <div class="summary-grid">
            <div class="summary-col">
                <div class="summary-num">{{ $total }}</div>
                <div class="summary-label">Total Egresados</div>
            </div>
            <div class="summary-col">
                <div class="summary-num" style="color: #2e7d32;">{{ $empleados }}</div>
                <div class="summary-label">Vinculados Laboralmente</div>
            </div>
            <div class="summary-col">
                <div class="summary-num" style="color: #d97706;">{{ $desempleados }}</div>
                <div class="summary-label">Buscando Oportunidad</div>
            </div>
            <div class="summary-col">
                <div class="summary-num" style="color: #166534;">{{ $rate }}</div>
                <div class="summary-label">Tasa Empleabilidad</div>
            </div>
        </div>
    </div>

    <h3>Detalle de Aprendices Egresados Muestreados</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Egresado(a)</th>
                <th>Documento</th>
                <th>Programa</th>
                <th>Ficha</th>
                <th>Contacto</th>
                <th>Estado Laboral</th>
            </tr>
        </thead>
        <tbody>
            @foreach($egresados as $egresado)
                <tr>
                    <td>{{ $egresado->id }}</td>
                    <td><strong>{{ $egresado->person ? ($egresado->person->first_name . ' ' . $egresado->person->first_last_name) : 'Aprendiz ' . $egresado->id }}</strong></td>
                    <td>{{ $egresado->person->document_number ?? 'N/A' }}</td>
                    <td>{{ $egresado->course && $egresado->course->program ? $egresado->course->program->name : 'ADSO' }}</td>
                    <td>{{ $egresado->course->code ?? '2694551' }}</td>
                    <td>{{ $egresado->person->telephone1 ?? '3100000000' }}</td>
                    <td><span class="badge badge-emp">{{ $egresado->apprentice_status ?? 'CERTIFICADO' }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Documento Oficial expedido por el Sistema Integrado de Gestión de Egresados (SIGE) • SENA Empresa • Todos los derechos reservados &copy; {{ date('Y') }}
    </div>

</body>
</html>
