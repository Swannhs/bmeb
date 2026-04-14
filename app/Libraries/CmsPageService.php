<?php

namespace App\Libraries;

use App\Models\CmsPageModel;
use CodeIgniter\HTTP\IncomingRequest;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;

class CmsPageService
{
    public function __construct(
        private readonly CmsPageModel $pages = new CmsPageModel(),
        private readonly MirroredDocumentFactory $documents = new MirroredDocumentFactory(),
    ) {
    }

    public function findPublishedForRequest(IncomingRequest $request): ?array
    {
        $builder = $this->pages
            ->whereIn('route_key', $this->routeKeyCandidatesForRequest($request))
            ->where('status', 'published')
            ->orderBy('updated_at', 'DESC');

        return $builder->first();
    }

    /**
     * @return list<string>
     */
    public function routeKeyCandidatesForRequest(IncomingRequest $request): array
    {
        $path = '/' . trim($request->getUri()->getPath(), '/');
        $path = $path === '/' || $path === '//' ? '/' : $path;
        $rawQuery = trim((string) $request->getServer('QUERY_STRING'));
        $normalizedQuery = $this->normalizeQuery($request->getGet());

        return array_values(array_unique(array_filter([
            $path,
            $rawQuery !== '' ? $path . '?' . $rawQuery : null,
            $rawQuery !== '' ? $path . '?' . rawurldecode($rawQuery) : null,
            $normalizedQuery !== '' ? $path . '?' . $normalizedQuery : null,
            $normalizedQuery !== '' ? $path . '?' . rawurldecode($normalizedQuery) : null,
        ])));
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public function preparePageData(array $data): array
    {
        $routeKey = trim((string) ($data['route_key'] ?? ''));

        if ($routeKey === '') {
            return $data;
        }

        $data['route_key'] = $this->normalizeRouteKey($routeKey);
        [$routePath, $queryString] = array_pad(explode('?', $data['route_key'], 2), 2, null);
        $routePath = $routePath ?: '/';

        $data['route_path'] = $routePath;
        $data['query_string'] = $queryString;
        $data['section'] = $this->extractSection($routePath);
        $data['slug'] = $this->extractSlug($routePath);

        if (($data['title'] ?? '') === '' && ($data['html_content'] ?? '') !== '') {
            $data['title'] = $this->extractTitle((string) $data['html_content']);
        }

        return $data;
    }

    public function importMirrorPages(bool $skipExisting = true): int
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(FCPATH, FilesystemIterator::SKIP_DOTS),
        );

        $imported = 0;

        foreach ($iterator as $fileInfo) {
            if (! $fileInfo->isFile() || strtolower($fileInfo->getExtension()) !== 'html') {
                continue;
            }

            $absolutePath = $fileInfo->getPathname();
            $relativePath = ltrim(str_replace(FCPATH, '', $absolutePath), DIRECTORY_SEPARATOR);
            $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
            $routeKey = $this->routeKeyFromRelativePublicPath($relativePath);

            if ($skipExisting && $this->pages->where('route_key', $routeKey)->first() !== null) {
                continue;
            }

            $html = (string) file_get_contents($absolutePath);
            $payload = $this->preparePageData([
                'route_key'    => $routeKey,
                'title'        => $this->extractTitle($html),
                'html_content' => $html,
                'source_path'  => $relativePath,
                'source_type'  => 'mirror',
                'status'       => 'published',
            ]);

            $this->pages->save($payload);
            $imported++;
        }

        return $imported;
    }

    public function extractTitle(string $html): string
    {
        $document = $this->documents->fromHtml($html);

        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $document['headContent'], $matches) === 1) {
            return trim(html_entity_decode(strip_tags($matches[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        return '';
    }

    public function routeKeyFromRelativePublicPath(string $relativePath): string
    {
        $relativePath = ltrim($relativePath, '/');

        if ($relativePath === 'index.html') {
            return '/';
        }

        $withoutExtension = preg_replace('/\.html$/i', '', $relativePath) ?? $relativePath;

        return '/' . ltrim($withoutExtension, '/');
    }

    private function normalizeRouteKey(string $routeKey): string
    {
        $routeKey = '/' . ltrim($routeKey, '/');

        return $routeKey === '//' ? '/' : $routeKey;
    }

    private function extractSection(string $routePath): ?string
    {
        $segments = array_values(array_filter(explode('/', trim($routePath, '/'))));

        if ($segments === []) {
            return 'home';
        }

        if (($segments[0] ?? null) === 'pages') {
            return $segments[1] ?? 'pages';
        }

        return $segments[0];
    }

    private function extractSlug(string $routePath): ?string
    {
        $segments = array_values(array_filter(explode('/', trim($routePath, '/'))));

        if ($segments === []) {
            return null;
        }

        if (($segments[0] ?? null) === 'pages') {
            if (count($segments) <= 2) {
                return null;
            }

            return implode('/', array_slice($segments, 2));
        }

        if (count($segments) <= 1) {
            return null;
        }

        return implode('/', array_slice($segments, 1));
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
}
