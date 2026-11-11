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
        body { font-family: 'Segoe UI', Arial, Helvetica, sans-serif; font-size: 10px; color: #1e293b; margin: 0; padding: 15px; background: #f8fafc; }
        .no-print { max-width: 750px; margin: 0 auto 12px auto; display: flex; justify-content: space-between; align-items: center; background: white; padding: 10px 16px; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .btn-download { padding: 8px 16px; background: #39A900; color: white; border: none; border-radius: 7px; font-weight: bold; cursor: pointer; font-size: 11.5px; display: inline-flex; align-items: center; gap: 6px; }
        .btn-download:hover { background: #2d8500; }
        .btn-print { padding: 8px 16px; background: #001A29; color: white; border: none; border-radius: 7px; font-weight: bold; cursor: pointer; font-size: 11.5px; margin-left: 8px; }
        .btn-print:hover { background: #002336; }
        #reporteContainer { max-width: 750px; margin: 0 auto; background: #ffffff; padding: 4px 10px; border-radius: 8px; border: 1px solid #e2e8f0; box-sizing: border-box; }
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
        <!-- 1. Encabezado Institucional SENA CEFA -->
        <div style="background: linear-gradient(135deg, #00131E 0%, #001A29 60%, #002336 100%); border-bottom: 3.5px solid #39A900; border-radius: 8px 8px 0 0; padding: 10px 14px; color: #ffffff;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 42px; vertical-align: middle;">
                        <img src="{{ $senaLogoBase64 ?: route('egresados.assets.image', 'sena-logo.png') }}" style="width: 36px; height: 36px; object-fit: contain; background: white; border-radius: 6px; padding: 2px;">
                    </td>
                    <td style="vertical-align: middle; padding-left: 10px;">
                        <div style="font-size: 7.5px; font-weight: 800; color: #62E31D; text-transform: uppercase; letter-spacing: 0.8px;">SERVICIO NACIONAL DE APRENDIZAJE · SENA EMPRESA</div>
                        <div style="font-size: 13px; font-weight: 800; color: #ffffff; letter-spacing: -0.2px;">Centro de Formación Agroindustrial La Angostura — CEFA</div>
                        <div style="font-size: 9px; color: #94a3b8;">Sistema Institucional de Gestión y Seguimiento a Egresados (SIGE ERP)</div>
                    </td>
                    <td style="text-align: right; vertical-align: middle;">
                        <div style="display: inline-block; background: #39A900; color: #ffffff; padding: 3px 8px; font-size: 8.5px; font-weight: 800; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px;">INFORME OFICIAL</div>
                        <div style="font-size: 8.5px; color: #cbd5e1; margin-top: 2px;">Emisión: {{ date('d/m/Y') }}</div>
                        <div style="font-size: 8.5px; color: #62E31D; font-weight: bold;">Cód: {{ $id }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- 2. Franja de Identificación del Reporte -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; padding: 6px 12px; margin-bottom: 7px; border-radius: 0 0 6px 6px;">
            <table style="width: 100%; border-collapse: collapse; font-size: 9.5px;">
                <tr>
                    <td style="color: #001A29; font-weight: bold;">
                        <span style="color: #39A900; margin-right: 3px;">●</span> REPORTE: <span style="color: #0f172a; text-transform: uppercase;">{{ $reportTitle }}</span>
                    </td>
                    <td style="text-align: right; color: #475569;">
                        Código: <strong style="color: #001A29;">{{ $id }}</strong> &nbsp;|&nbsp; 
                        Estado: <span style="background: #dcfce7; color: #166534; font-weight: 800; padding: 1px 6px; border-radius: 3px; font-size: 8.5px;">GENERADO</span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- 3. Ficha Técnica y Objetivo (Lado a lado en 2 columnas) -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 7px;">
            <tr>
                <td style="width: 54%; vertical-align: top; padding-right: 4px;">
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-left: 3.5px solid #39A900; border-radius: 5px; padding: 6px 9px; height: 60px; box-sizing: border-box;">
                        <div style="font-size: 8.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">
                            <span style="color: #39A900;">■</span> Objetivo y Alcance Institucional
                        </div>
                        <p style="font-size: 8px; color: #334155; margin: 0; line-height: 1.35; text-align: justify;">
                            Consolida la trazabilidad de inserción laboral y desempeño de egresados certificados en el CEFA, suministrando evidencia cuantitativa para acreditar pertinencia ante el sector productivo regional.
                        </p>
                    </div>
                </td>
                <td style="width: 46%; vertical-align: top; padding-left: 4px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px; padding: 5px 8px; height: 60px; box-sizing: border-box;">
                        <div style="font-size: 8.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">
                            Ficha Técnica de Emisión
                        </div>
                        <table style="width: 100%; border-collapse: collapse; font-size: 8px; color: #334155;">
                            <tr>
                                <td style="padding: 1px 0;"><strong>Código:</strong> {{ $id }}</td>
                                <td style="padding: 1px 0; text-align: right;"><strong>Fecha:</strong> {{ date('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 1px 0;" colspan="2"><strong>Responsable:</strong> Coordinación Académica y Egresados</td>
                            </tr>
                            <tr>
                                <td style="padding: 1px 0;" colspan="2"><strong>Sede:</strong> CEFA La Angostura · Campoalegre (Huila)</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <!-- 4. Cuatro Tarjetas KPI Ejecutivas en Dashboard -->
        <div style="margin-bottom: 7px;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 5px 0;">
                <tr>
                    <td style="width: 25%; background: #ffffff; border: 1px solid #cbd5e1; border-top: 3px solid #001A29; border-radius: 5px; padding: 6px 8px; text-align: center;">
                        <div style="font-size: 7.5px; font-weight: 800; color: #64748b; text-transform: uppercase;">TOTAL EVALUADOS</div>
                        <div style="font-size: 16px; font-weight: 900; color: #001A29; line-height: 1.1; margin-top: 1px;">{{ $total }}</div>
                        <div style="font-size: 7.5px; color: #94a3b8; margin-top: 1px;">Egresados certificados</div>
                    </td>
                    <td style="width: 25%; background: #f0fdf4; border: 1px solid #bbf7d0; border-top: 3px solid #39A900; border-radius: 5px; padding: 6px 8px; text-align: center;">
                        <div style="font-size: 7.5px; font-weight: 800; color: #166534; text-transform: uppercase;">VINCULADOS LABORAL</div>
                        <div style="font-size: 16px; font-weight: 900; color: #166534; line-height: 1.1; margin-top: 1px;">{{ $empleados }}</div>
                        <div style="font-size: 7.5px; color: #15803d; margin-top: 1px;">Contrato / Empresa</div>
                    </td>
                    <td style="width: 25%; background: #fffbeb; border: 1px solid #fde68a; border-top: 3px solid #f59e0b; border-radius: 5px; padding: 6px 8px; text-align: center;">
                        <div style="font-size: 7.5px; font-weight: 800; color: #92400e; text-transform: uppercase;">EN BÚSQUEDA ACTIVA</div>
                        <div style="font-size: 16px; font-weight: 900; color: #b45309; line-height: 1.1; margin-top: 1px;">{{ $desempleados }}</div>
                        <div style="font-size: 7.5px; color: #92400e; margin-top: 1px;">Intermediación APE</div>
                    </td>
                    <td style="width: 25%; background: #f0fdf4; border: 1px solid #86efac; border-top: 3px solid #16a34a; border-radius: 5px; padding: 6px 8px; text-align: center;">
                        <div style="font-size: 7.5px; font-weight: 800; color: #15803d; text-transform: uppercase;">TASA EMPLEABILIDAD</div>
                        <div style="font-size: 16px; font-weight: 900; color: #15803d; line-height: 1.1; margin-top: 1px;">{{ $rate }}</div>
                        <div style="font-size: 7.5px; color: #166534; font-weight: bold; margin-top: 1px;">Meta CEFA: 85% ✓</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- 5. Filtros Aplicados y Conclusión en 2 Columnas -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 7px;">
            <tr>
                <td style="width: 49%; vertical-align: top; padding-right: 4px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px; padding: 5px 8px; height: 56px; box-sizing: border-box;">
                        <div style="font-size: 8px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">
                            Criterios y Filtros Aplicados
                        </div>
                        <table style="width: 100%; border-collapse: collapse; font-size: 7.5px; color: #334155;">
                            <tr>
                                <td style="padding: 1px 0;"><strong style="color: #39A900;">•</strong> Cobertura: Regional Huila — CEFA</td>
                                <td style="padding: 1px 0;"><strong style="color: #39A900;">•</strong> Población: Egresados Certificados</td>
                            </tr>
                            <tr>
                                <td style="padding: 1px 0;" colspan="2"><strong style="color: #39A900;">•</strong> Período Cronológico: Año Fiscal {{ date('Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="width: 51%; vertical-align: top; padding-left: 4px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px; padding: 5px 8px; height: 56px; box-sizing: border-box;">
                        <div style="font-size: 8px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">
                            Conclusión y Recomendación Institucional
                        </div>
                        <p style="font-size: 7.5px; color: #334155; margin: 0; line-height: 1.35; text-align: justify;">
                            El índice de vinculación ratifica la pertinencia formativa del CEFA. Se recomienda afianzar articulación con la APE y convocatorias de capital semilla del Fondo Emprender.
                        </p>
                    </div>
                </td>
            </tr>
        </table>

        <!-- 6. Marco Legal Habeas Data Compacto -->
        <div style="background: #f0faf3; border: 1px solid #bbf7d0; border-radius: 4px; padding: 4px 8px; font-size: 7.5px; color: #166534; margin-bottom: 10px; line-height: 1.3;">
            <strong>Tratamiento de Información (Ley 1581 de 2012):</strong> Datos con reserva estadística y carácter confidencial para fines de aseguramiento de la calidad académica del SENA.
        </div>

        <!-- 7. Firmas Institucionales de Responsabilidad -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 6px; margin-bottom: 6px;">
            <tr>
                <td style="width: 45%; text-align: center; vertical-align: top;">
                    <div style="border-top: 1px solid #64748b; width: 80%; margin: 0 auto; padding-top: 3px;">
                        <div style="font-size: 9px; font-weight: bold; color: #001A29;">Coordinación Académica</div>
                        <div style="font-size: 7.5px; color: #64748b;">CEFA La Angostura — SENA</div>
                    </div>
                </td>
                <td style="width: 10%;"></td>
                <td style="width: 45%; text-align: center; vertical-align: top;">
                    <div style="border-top: 1px solid #64748b; width: 80%; margin: 0 auto; padding-top: 3px;">
                        <div style="font-size: 9px; font-weight: bold; color: #001A29;">Líder de Seguimiento a Egresados</div>
                        <div style="font-size: 7.5px; color: #64748b;">Sistema Institucional SIGE ERP</div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- 8. Pie de Página Institucional -->
        <div style="border-top: 1px solid #e2e8f0; padding-top: 3px; text-align: center; font-size: 7.5px; color: #94a3b8; margin-top: 4px;">
            SISTEMA DE GESTIÓN Y SEGUIMIENTO A EGRESADOS (SIGE) • SENA EMPRESA CEFA • LA ANGOSTURA — {{ date('Y') }}
        </div>
    </div>

    <script>
        function descargarPDF() {
            const element = document.getElementById('reporteContainer');
            const opt = {
                margin:       [5, 7, 5, 7],
                filename:     '{{ preg_replace('/[^A-Za-z0-9_\-]/', '_', $reportTitle) }}_{{ $id }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, logging: false },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
            };
            html2pdf().set(opt).from(element).save();
        }

        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(descargarPDF, 500);
        });
    </script>
</body>
</html>