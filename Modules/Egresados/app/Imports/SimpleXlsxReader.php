<?php

namespace Modules\Egresados\app\Imports;

class SimpleXlsxReader
{
    /**
     * Lee un archivo XLSX o CSV y retorna un array de filas (cada fila es un array de columnas).
     *
     * @param string $filePath
     * @return array<int, array<int, string>>
     */
    public static function read(string $filePath): array
    {
        $content = file_get_contents($filePath);
        if ($content === false || strlen($content) === 0) {
            return [];
        }

        // Si empieza con la firma ZIP (PK\x03\x04), es un archivo XLSX binario
        if (substr($content, 0, 4) === "PK\x03\x04") {
            return self::parseXlsx($content);
        }

        // De lo contrario, es un archivo CSV o de texto plano
        return self::parseCsv($filePath);
    }

    /**
     * Parsea un archivo XLSX extrayendo las cadenas compartidas y la primera hoja.
     */
    private static function parseXlsx(string $zipContent): array
    {
        $files = self::unzip($zipContent);

        // 1. Cargar Shared Strings (cadenas de texto compartidas de Excel)
        $sharedStrings = [];
        $sharedXmlContent = $files['xl/sharedstrings.xml'] ?? $files['xl/sharedStrings.xml'] ?? null;
        if ($sharedXmlContent) {
            $xml = @simplexml_load_string($sharedXmlContent);
            if ($xml) {
                foreach ($xml->si as $si) {
                    if (isset($si->t)) {
                        $sharedStrings[] = (string) $si->t;
                    } elseif (isset($si->r)) {
                        $text = '';
                        foreach ($si->r as $r) {
                            $text .= (string) $r->t;
                        }
                        $sharedStrings[] = $text;
                    } else {
                        $sharedStrings[] = '';
                    }
                }
            }
        }

        // 2. Cargar Sheet 1 (primera hoja de cálculo)
        $sheetXmlContent = $files['xl/worksheets/sheet1.xml'] ?? null;
        if (!$sheetXmlContent) {
            foreach ($files as $k => $v) {
                if (str_starts_with($k, 'xl/worksheets/')) {
                    $sheetXmlContent = $v;
                    break;
                }
            }
        }

        if (!$sheetXmlContent) {
            return [];
        }

        $sheetXml = @simplexml_load_string($sheetXmlContent);
        if (!$sheetXml || !isset($sheetXml->sheetData->row)) {
            return [];
        }

        $rows = [];
        foreach ($sheetXml->sheetData->row as $row) {
            $rowData = [];
            $colIndex = 0;

            foreach ($row->c as $c) {
                $ref = (string) $c['r'];
                $colLetters = preg_replace('/[0-9]/', '', $ref);
                $targetCol = self::colLetterToIndex($colLetters);

                while ($colIndex < $targetCol) {
                    $rowData[] = '';
                    $colIndex++;
                }

                $type = (string) $c['t'];
                $val = isset($c->v) ? (string) $c->v : '';

                if ($type === 's' && is_numeric($val) && isset($sharedStrings[(int) $val])) {
                    $val = $sharedStrings[(int) $val];
                } elseif ($type === 'inlineStr' && isset($c->is->t)) {
                    $val = (string) $c->is->t;
                }

                $rowData[] = trim((string)$val);
                $colIndex++;
            }

            if (!empty(array_filter($rowData, fn($v) => $v !== ''))) {
                $rows[] = $rowData;
            }
        }

        return $rows;
    }

    /**
     * Convierte letras de columna de Excel (A, B, C, ..., AA) a índice base 0.
     */
    private static function colLetterToIndex(string $col): int
    {
        $col = strtoupper($col);
        $index = 0;
        $len = strlen($col);
        for ($i = 0; $i < $len; $i++) {
            $index = $index * 26 + (ord($col[$i]) - 64);
        }
        return max(0, $index - 1);
    }

    /**
     * Descomprime un archivo ZIP en memoria usando gzinflate puro.
     */
    private static function unzip(string $content): array
    {
        $files = [];
        $offset = 0;
        $len = strlen($content);

        while ($offset + 30 <= $len) {
            $sig = substr($content, $offset, 4);
            if ($sig !== "PK\x03\x04") {
                break;
            }

            $compMethod = unpack('v', substr($content, $offset + 8, 2))[1];
            $compSize   = unpack('V', substr($content, $offset + 18, 4))[1];
            $fnLen      = unpack('v', substr($content, $offset + 26, 2))[1];
            $extraLen   = unpack('v', substr($content, $offset + 28, 2))[1];

            $fileName = substr($content, $offset + 30, $fnLen);
            $dataOffset = $offset + 30 + $fnLen + $extraLen;

            if ($dataOffset + $compSize > $len) {
                break;
            }

            $compressedData = substr($content, $dataOffset, $compSize);
            $decompressed = '';

            if ($compMethod === 0) {
                $decompressed = $compressedData;
            } elseif ($compMethod === 8) {
                $decompressed = @gzinflate($compressedData);
            }

            if ($decompressed !== false) {
                $files[strtolower($fileName)] = $decompressed;
                $files[$fileName] = $decompressed;
            }

            $offset = $dataOffset + $compSize;
        }

        return $files;
    }

    /**
     * Parsea un archivo CSV detectando automáticamente el delimitador.
     */
    private static function parseCsv(string $filePath): array
    {
        $handle = fopen($filePath, 'r');
        if (!$handle) return [];

        $firstLine = fgets($handle);
        rewind($handle);
        $delimiter = (substr_count((string)$firstLine, ';') > substr_count((string)$firstLine, ',')) ? ';' : ',';

        $rows = [];
        while (($row = fgetcsv($handle, 4000, $delimiter)) !== false) {
            if (!empty(array_filter($row, fn($v) => trim((string)$v) !== ''))) {
                $rows[] = array_map(fn($v) => trim((string)$v), $row);
            }
        }
        fclose($handle);
        return $rows;
    }
}
