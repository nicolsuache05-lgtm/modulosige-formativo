@php
    $senaLogoPath = base_path('Modules/Egresados/resources/assets/images/sena-logo.png');
    $senaLogoBase64 = file_exists($senaLogoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($senaLogoPath)) : '';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $reportTitle }} · SIGE CEFA</title>
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #1e293b; margin: 0; padding: 20px; background: #f8fafc; }
        .no-print { max-width: 800px; margin: 0 auto 15px auto; display: flex; justify-content: space-between; align-items: center; background: white; padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .btn-download { padding: 9px 18px; background: #39A900; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; }
        .btn-download:hover { background: #2d8500; }
        .btn-print { padding: 9px 18px; background: #001A29; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 12px; margin-left: 8px; }
        .btn-print:hover { background: #002336; }
        #reporteContainer { max-width: 800px; margin: 0 auto; background: #ffffff; padding: 16px 20px; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .header-sena { background: #001A29; border-bottom: 4px solid #39A900; border-radius: 8px 8px 0 0; padding: 14px 18px; color: #ffffff; }
        .header-table { width: 100%; border-collapse: collapse; }
        .header-logo { width: 42px; vertical-align: middle; }
        .header-logo img { width: 38px; height: 38px; object-fit: contain; background: white; border-radius: 8px; padding: 2px; }
        .strip-id { background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; padding: 9px 16px; margin-bottom: 12px; border-radius: 0 0 8px 8px; }
        .summary-box { border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; margin-bottom: 12px; background: #ffffff; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10.5px; }
        .table-data th { background: #001A29; color: #ffffff; padding: 7px 8px; text-align: left; font-weight: bold; border: 1px solid #001A29; }
        .table-data td { border: 1px solid #e2e8f0; padding: 6px 8px; }
        .footer { margin-top: 25px; border-top: 1px solid #cbd5e1; padding-top: 8px; font-size: 9px; color: #64748b; text-align: center; }
        @media print { .no-print { display: none !important; } body { padding: 0; background: white; } #reporteContainer { border: none; box-shadow: none; padding: 0; } }
    </style>
</head>
<body>

    <div class="no-print">
        <div style="font-size: 12px; font-weight: bold; color: #001A29;">
            Descarga Oficial de Reporte Institucional (PDF)
        </div>
        <div>
            <button class="btn-download" onclick="descargarPDF()">
                Descargar Archivo PDF
            </button>
            <button class="btn-print" onclick="window.print()">
                Imprimir
            </button>
        </div>
    </div>

    <div id="reporteContainer">
        <!-- Encabezado Institucional SENA ERP -->
        <div class="header-sena">
            <table class="header-table">
                <tr>
                    <td class="header-logo">
                        <img src="{{ $senaLogoBase64 ?: route('egresados.assets.image', 'sena-logo.png') }}">
                    </td>
                    <td style="vertical-align: middle; padding-left: 10px;">
                        <div style="font-size: 8.5px; font-weight: bold; color: #62E31D; text-transform: uppercase; letter-spacing: 1px;">SERVICIO NACIONAL DE APRENDIZAJE · SENA EMPRESA</div>
                        <div style="font-size: 14.5px; font-weight: bold; color: #ffffff; margin-top: 2px;">Centro de Formación Agroindustrial La Angostura — CEFA</div>
                        <div style="font-size: 10px; color: #cbd5e1; margin-top: 1px;">Sistema Institucional de Gestión y Seguimiento a Egresados (SIGE)</div>
                    </td>
                    <td style="text-align: right; vertical-align: middle;">
                        <span style="background: #39A900; color: #ffffff; padding: 4px 10px; font-size: 9.5px; font-weight: bold; border-radius: 4px; text-transform: uppercase;">INFORME OFICIAL</span>
                        <div style="font-size: 9.5px; color: #94a3b8; margin-top: 3px;">Emisión: {{ date('d/m/Y') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Franja de Identificación -->
        <div class="strip-id">
            <table style="width: 100%; border-collapse: collapse; font-size: 11px;">
                <tr>
                    <td style="color: #001A29; font-weight: bold;">
                        <span style="color: #39A900; margin-right: 4px;">●</span> Reporte: <span style="color: #0f172a;">{{ $reportTitle }}</span>
                    </td>
                    <td style="text-align: right; color: #64748b;">
                        Código: <strong style="color: #001A29;">{{ $id }}</strong> &nbsp;|&nbsp; 
                        Estado: <strong style="color: #166534;">GENERADO</strong>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Ficha Técnica -->
        <div class="summary-box">
            <div style="font-size: 10.5px; font-weight: bold; color: #001A29; text-transform: uppercase; border-bottom: 1px solid #edf2f7; padding-bottom: 4px; margin-bottom: 7px;">
                Ficha Técnica y Datos de Emisión
            </div>
            <table style="width: 100%; border-collapse: collapse; font-size: 10.5px; background: #f8fafc; border-radius: 6px;">
                <tr>
                    <td style="padding: 6px 10px; border: 1px solid #e2e8f0; width: 33%;"><strong>Código de Control:</strong> {{ $id }}</td>
                    <td style="padding: 6px 10px; border: 1px solid #e2e8f0; width: 33%;"><strong>Fecha:</strong> {{ date('d/m/Y') }}</td>
                    <td style="padding: 6px 10px; border: 1px solid #e2e8f0; width: 34%;"><strong>Ámbito:</strong> Regional Huila — CEFA</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px 10px; border: 1px solid #e2e8f0;"><strong>Responsable:</strong> Coordinación Académica y Seguimiento a Egresados</td>
                    <td style="padding: 6px 10px; border: 1px solid #e2e8f0;"><strong>Población:</strong> Egresados Certificados</td>
                </tr>
            </table>
        </div>

        <!-- Consolidado de Indicadores -->
        <div style="font-size: 11px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 6px;">
            Consolidado Numérico y Desempeño Ocupacional
        </div>
        <table class="table-data" style="margin-top: 0; margin-bottom: 12px;">
            <thead>
                <tr>
                    <th>Indicador de Empleabilidad</th>
                    <th style="text-align: center; width: 90px;">Muestra</th>
                    <th>Detalle Operativo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Total Egresados Evaluados</td>
                    <td style="text-align: center; font-weight: bold; font-size: 13px;">{{ $total }}</td>
                    <td style="color: #64748b; font-size: 10px;">Aprendices con estado CERTIFICADO en base de datos</td>
                </tr>
                <tr style="background: #f8fafc;">
                    <td style="font-weight: bold;">Vinculados Laboralmente</td>
                    <td style="text-align: center; font-weight: bold; font-size: 13px; color: #39A900;">{{ $empleados }}</td>
                    <td style="color: #64748b; font-size: 10px;">En contrato formal, independientes o emprendimiento</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">En Búsqueda Activa</td>
                    <td style="text-align: center; font-weight: bold; font-size: 13px; color: #d97706;">{{ $desempleados }}</td>
                    <td style="color: #64748b; font-size: 10px;">En proceso de intermediación laboral a través de APE SENA</td>
                </tr>
                <tr style="background: #f0fdf4;">
                    <td style="font-weight: bold; color: #166534;">Tasa de Empleabilidad Efectiva</td>
                    <td style="text-align: center; font-weight: 900; font-size: 15px; color: #15803d;">{{ $rate }}</td>
                    <td style="color: #166534; font-size: 10px; font-weight: 600;">Porcentaje de absorción productiva en el sector</td>
                </tr>
            </tbody>
        </table>

        <!-- Dictamen y Conclusiones -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 9px 12px; margin-bottom: 10px; font-size: 10px; line-height: 1.45;">
            <strong style="color: #001A29; text-transform: uppercase;">Conclusión Institucional:</strong> La información consolidada refleja un índice positivo de inserción laboral que cumple los estándares de pertinencia del SENA para la región Huila.
        </div>

        <!-- Habeas Data -->
        <div style="background: #f0faf3; border: 1px solid #bbf7d0; border-radius: 6px; padding: 7px 10px; font-size: 9.5px; color: #166534; margin-bottom: 18px; line-height: 1.35;">
            <strong>Tratamiento de Información (Ley 1581 de 2012):</strong> Los datos del presente reporte gozan de reserva estadística y tienen carácter exclusivamente académico y de mejoramiento continuo.
        </div>

        <!-- Firmas -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 10px;">
            <tr>
                <td style="width: 46%; text-align: center; vertical-align: top;">
                    <div style="border-top: 1px solid #94a3b8; width: 85%; margin: 0 auto; padding-top: 5px;">
                        <div style="font-size: 10px; font-weight: bold; color: #001A29;">Coordinación Académica</div>
                        <div style="font-size: 9px; color: #64748b;">CEFA La Angostura — SENA</div>
                    </div>
                </td>
                <td style="width: 8%;"></td>
                <td style="width: 46%; text-align: center; vertical-align: top;">
                    <div style="border-top: 1px solid #94a3b8; width: 85%; margin: 0 auto; padding-top: 5px;">
                        <div style="font-size: 10px; font-weight: bold; color: #001A29;">Líder de Seguimiento a Egresados</div>
                        <div style="font-size: 9px; color: #64748b;">Sistema Institucional SIGE</div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            SISTEMA DE GESTIÓN DE EGRESADOS (SIGE) • SENA EMPRESA ERP • CEFA LA ANGOSTURA — {{ date('Y') }}
        </div>
    </div>

    <script>
        function descargarPDF() {
            const element = document.getElementById('reporteContainer');
            const opt = {
                margin:       [4, 6, 6, 6],
                filename:     '{{ preg_replace('/[^A-Za-z0-9_\-]/', '_', $reportTitle) }}_{{ $id }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }

        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(descargarPDF, 500);
        });
    </script>
</body>
</html>