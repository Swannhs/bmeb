<?php

namespace App\Libraries;

use CodeIgniter\Exceptions\PageNotFoundException;

class MirrorContentRepository
{
    /**
     * @return list<string>
     */
    public function pageSections(): array
    {
        $pagesPath = FCPATH . 'pages';

        if (! is_dir($pagesPath)) {
            return [];
        }

        $entries = array_filter(scandir($pagesPath) ?: [], static function (string $entry): bool {
            return $entry !== '.' && $entry !== '..' && is_dir(FCPATH . 'pages/' . $entry);
        });

        sort($entries);

        return array_values($entries);
    }

    public function home(): string
    {
        return $this->requireFile('index.html');
    }

    public function noticesList(): string
    {
        return $this->requireFile('pages/notices.html');
    }

    public function noticeDetail(string $slug): string
    {
        return $this->requireFile('pages/notices/' . rawurldecode($slug) . '.html');
    }

    public function officersList(): string
    {
        return $this->requireFile('pages/officers.html');
    }

    public function officerDetail(string $slug): string
    {
        return $this->requireFile('pages/officers/' . rawurldecode($slug) . '.html');
    }

    public function staticPage(string $id): string
    {
        return $this->requireFile('pages/static-pages/' . rawurldecode($id) . '.html');
    }

    public function filePage(string $id): string
    {
        return $this->requireFile('pages/files/' . rawurldecode($id) . '.html');
    }

    public function newsArchive(): string
    {
        return $this->requireFile('pages/news?archived=true.html');
    }

    public function newsDetail(string $slug): string
    {
        return $this->requireFile('pages/news/' . rawurldecode($slug) . '.html');
    }

    public function externalLinksList(): string
    {
        return $this->requireFile('pages/external-links.html');
    }

    public function externalLinkDetail(string $slug): string
    {
        return $this->requireFile('pages/external-links/' . rawurldecode($slug) . '.html');
    }

    public function commonDocumentsList(?string $filters): string
    {
        if ($filters === null || $filters === '') {
            throw PageNotFoundException::forPageNotFound('pages/common-documents');
        }

        $candidates = array_unique([
            'pages/common-documents?filters=' . $filters . '.html',
            'pages/common-documents?filters=' . rawurldecode($filters) . '.html',
        ]);

        foreach ($candidates as $candidate) {
            $fullPath = FCPATH . $candidate;

            if (is_file($fullPath)) {
                return $fullPath;
            }
        }

        throw PageNotFoundException::forPageNotFound('pages/common-documents?filters=' . $filters);
    }

    public function commonDocumentDetail(string $slug): string
    {
        return $this->requireFile('pages/common-documents/' . rawurldecode($slug) . '.html');
    }

    public function pageIndex(string $section, ?array $query = null): string
    {
        $section = rawurldecode(trim($section, '/'));
        $queryString = $this->normalizeQuery($query ?? []);

        $candidates = [
            'pages/' . $section . '.html',
        ];

        if ($queryString !== '') {
            $candidates[] = 'pages/' . $section . '?' . $queryString . '.html';
            $candidates[] = 'pages/' . $section . '?' . rawurldecode($queryString) . '.html';
        }

        return $this->requireFirstExisting($candidates, 'pages/' . $section);
    }

    public function pageDetail(string $section, string $slug): string
    {
        return $this->requireFile('pages/' . rawurldecode($section) . '/' . rawurldecode($slug) . '.html');
    }

    public function assetOrMirror(string $path, string $queryString = ''): string
    {
        $requestPath = trim($path, '/');
        $decodedPath = rawurldecode($requestPath);

        $candidates = array_filter(array_merge(
            $this->pathCandidates($requestPath),
            $requestPath === $decodedPath ? [] : $this->pathCandidates($decodedPath),
            [
                $this->buildQueryCandidate($requestPath, $queryString, false),
                $this->buildQueryCandidate($requestPath, $queryString, true),
                $this->buildQueryCandidate($decodedPath, $queryString, false),
                $this->buildQueryCandidate($decodedPath, $queryString, true),
            ],
        ));

        foreach (array_unique($candidates) as $candidate) {
            if ($candidate !== '' && is_file(FCPATH . $candidate)) {
                return FCPATH . $candidate;
            }
        }

        throw PageNotFoundException::forPageNotFound($path);
    }

    private function requireFile(string $relativePath): string
    {
        $fullPath = FCPATH . ltrim($relativePath, '/');

        if (! is_file($fullPath)) {
            throw PageNotFoundException::forPageNotFound($relativePath);
        }

        return $fullPath;
    }

    /**
     * @param list<string> $relativePaths
     */
    private function requireFirstExisting(array $relativePaths, string $notFoundPath): string
    {
        foreach ($relativePaths as $relativePath) {
            $fullPath = FCPATH . ltrim($relativePath, '/');

            if (is_file($fullPath)) {
                return $fullPath;
            }
        }

        throw PageNotFoundException::forPageNotFound($notFoundPath);
    }

    /**
     * @param array<string, mixed> $query
     */
    private function normalizeQuery(array $query): string
    {
        if ($query === []) {
            return '';
        }

        ksort($query);

        return http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }

    private function buildQueryCandidate(string $requestPath, string $queryString, bool $decode): ?string
    {
        if ($requestPath === '' || $queryString === '') {
            return null;
        }

        $query = $decode ? rawurldecode($queryString) : $queryString;

        return $requestPath . '?' . $query;
    }

    /**
     * @return list<string>
     */
    private function pathCandidates(string $requestPath): array
    {
        if ($requestPath === '') {
            return [];
        }

        return [
            $requestPath,
            $requestPath . '.html',
            $requestPath . '/index.html',
            $requestPath . '.css',
            $requestPath . '.js',
        ];
    }
}
