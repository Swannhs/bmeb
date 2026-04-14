<?php

namespace App\Libraries;

use RuntimeException;

class RemotePortalFetcher
{
    private const BASE_URL = 'https://bmeb.gov.bd';

    /**
     * @param array<string, mixed> $query
     * @return array{status:int, contentType:string, body:string}
     */
    public function fetch(string $path, array $query = []): array
    {
        $url = rtrim(self::BASE_URL, '/') . '/' . ltrim($path, '/');

        if ($query !== []) {
            $url .= '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        }

        $context = stream_context_create([
            'http' => [
                'method'        => 'GET',
                'ignore_errors' => true,
                'header'        => implode("\r\n", [
                    'Accept: */*',
                    'User-Agent: Mozilla/5.0 (compatible; CodeIgniter Clone/1.0)',
                ]),
                'timeout'       => 20,
            ],
        ]);

        $body = @file_get_contents($url, false, $context);
        $headers = $http_response_header ?? [];

        if ($body === false) {
            throw new RuntimeException('Unable to fetch remote portal resource: ' . $url);
        }

        return [
            'status'      => $this->extractStatusCode($headers),
            'contentType' => $this->extractContentType($headers),
            'body'        => $body,
        ];
    }

    /**
     * @param list<string> $headers
     */
    private function extractStatusCode(array $headers): int
    {
        $statusLine = $headers[0] ?? '';

        if (preg_match('/\s(\d{3})\s/', $statusLine, $matches) === 1) {
            return (int) $matches[1];
        }

        return 200;
    }

    /**
     * @param list<string> $headers
     */
    private function extractContentType(array $headers): string
    {
        foreach ($headers as $header) {
            if (stripos($header, 'Content-Type:') === 0) {
                return trim(substr($header, strlen('Content-Type:')));
            }
        }

        return 'text/html; charset=UTF-8';
    }
}
