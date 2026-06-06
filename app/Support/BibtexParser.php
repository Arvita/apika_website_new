<?php

namespace App\Support;

class BibtexParser
{
    public function parse(string $bibtex): array
    {
        $bibtex = trim($bibtex);

        if ($bibtex === '') {
            return [];
        }

        $entries = $this->splitEntries($bibtex);

        return array_values(array_filter(array_map(function (string $entry) {
            return $this->parseEntry($entry);
        }, $entries)));
    }

    private function splitEntries(string $bibtex): array
    {
        $entries = [];
        $length = strlen($bibtex);
        $start = null;
        $depth = 0;
        $inQuote = false;

        for ($i = 0; $i < $length; $i++) {
            $char = $bibtex[$i];

            if ($char === '"' && ($i === 0 || $bibtex[$i - 1] !== '\\')) {
                $inQuote = ! $inQuote;
            }

            if (! $inQuote && $char === '@') {
                if ($start === null) {
                    $start = $i;
                    $depth = 0;
                }
            }

            if ($start !== null && ! $inQuote) {
                if ($char === '{') {
                    $depth++;
                }

                if ($char === '}') {
                    $depth--;

                    if ($depth === 0) {
                        $entries[] = substr($bibtex, $start, $i - $start + 1);
                        $start = null;
                    }
                }
            }
        }

        return $entries;
    }

    private function parseEntry(string $entry): ?array
    {
        if (! preg_match('/@(\w+)\s*\{\s*([^,]+)\s*,/i', $entry, $matches)) {
            return null;
        }

        $type = strtolower($matches[1]);
        $key = trim($matches[2]);

        $bodyStart = strpos($entry, ',');
        $body = substr($entry, $bodyStart + 1, -1);

        $fields = $this->parseFields($body);

        return [
            'bibtex_key' => $key,
            'bibtex_type' => $type,
            'fields' => $fields,
        ];
    }

    private function parseFields(string $body): array
    {
        $fields = [];
        $length = strlen($body);
        $i = 0;

        while ($i < $length) {
            while ($i < $length && (ctype_space($body[$i]) || $body[$i] === ',')) {
                $i++;
            }

            $nameStart = $i;

            while ($i < $length && preg_match('/[A-Za-z0-9_\-]/', $body[$i])) {
                $i++;
            }

            $name = strtolower(trim(substr($body, $nameStart, $i - $nameStart)));

            if ($name === '') {
                break;
            }

            while ($i < $length && (ctype_space($body[$i]) || $body[$i] === '=')) {
                $i++;
            }

            if ($i >= $length) {
                break;
            }

            $value = '';

            if ($body[$i] === '{') {
                [$value, $i] = $this->readBracedValue($body, $i);
            } elseif ($body[$i] === '"') {
                [$value, $i] = $this->readQuotedValue($body, $i);
            } else {
                $valueStart = $i;

                while ($i < $length && $body[$i] !== ',') {
                    $i++;
                }

                $value = substr($body, $valueStart, $i - $valueStart);
            }

            $fields[$name] = $this->cleanValue($value);
        }

        return $fields;
    }

    private function readBracedValue(string $body, int $i): array
    {
        $length = strlen($body);
        $depth = 0;
        $start = $i + 1;

        for (; $i < $length; $i++) {
            if ($body[$i] === '{') {
                $depth++;
            }

            if ($body[$i] === '}') {
                $depth--;

                if ($depth === 0) {
                    return [substr($body, $start, $i - $start), $i + 1];
                }
            }
        }

        return [substr($body, $start), $length];
    }

    private function readQuotedValue(string $body, int $i): array
    {
        $length = strlen($body);
        $start = $i + 1;
        $i++;

        for (; $i < $length; $i++) {
            if ($body[$i] === '"' && $body[$i - 1] !== '\\') {
                return [substr($body, $start, $i - $start), $i + 1];
            }
        }

        return [substr($body, $start), $length];
    }

    private function cleanValue(string $value): string
    {
        $value = trim($value);

        $replacements = [
            '\&' => '&',
            '\%' => '%',
            '\_' => '_',
            '\#' => '#',
            '\{' => '{',
            '\}' => '}',
            '---' => '—',
            '--' => '–',
        ];

        $value = str_replace(array_keys($replacements), array_values($replacements), $value);

        $value = preg_replace('/\s+/', ' ', $value);

        return trim($value);
    }
}