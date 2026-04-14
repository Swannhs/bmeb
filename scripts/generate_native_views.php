<?php

declare(strict_types=1);

$projectRoot = dirname(__DIR__);
$publicRoot = $projectRoot . '/public';
$viewsRoot = $projectRoot . '/app/Views/generated';

if (! is_dir($publicRoot)) {
    fwrite(STDERR, "Public directory not found.\n");
    exit(1);
}

if (! is_dir($viewsRoot) && ! mkdir($viewsRoot, 0775, true) && ! is_dir($viewsRoot)) {
    fwrite(STDERR, "Unable to create generated views directory.\n");
    exit(1);
}

$cleanupIterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($viewsRoot, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::CHILD_FIRST,
);

foreach ($cleanupIterator as $item) {
    if ($item->isDir()) {
        @rmdir($item->getPathname());
        continue;
    }

    @unlink($item->getPathname());
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($publicRoot, FilesystemIterator::SKIP_DOTS),
);

$generated = 0;
$manifest = [];

foreach ($iterator as $fileInfo) {
    if (! $fileInfo->isFile() || strtolower($fileInfo->getExtension()) !== 'html') {
        continue;
    }

    $absolutePath = $fileInfo->getPathname();
    $relativePath = ltrim(str_replace($publicRoot, '', $absolutePath), DIRECTORY_SEPARATOR);
    $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
    $viewFile = $viewsRoot . '/' . buildViewPath($relativePath) . '.php';
    $manifest[$relativePath] = str_replace($viewsRoot . '/', '', $viewFile);
    $html = file_get_contents($absolutePath);

    if ($html === false) {
        fwrite(STDERR, "Failed to read {$relativePath}\n");
        exit(1);
    }

    $header = "<?php /* Generated from public/{$relativePath}. */ ?>\n";

    $viewDirectory = dirname($viewFile);

    if (! is_dir($viewDirectory) && ! mkdir($viewDirectory, 0775, true) && ! is_dir($viewDirectory)) {
        fwrite(STDERR, "Failed to create {$viewDirectory}\n");
        exit(1);
    }

    if (file_put_contents($viewFile, $header . $html) === false) {
        fwrite(STDERR, "Failed to write {$viewFile}\n");
        exit(1);
    }

    $generated++;
}

ksort($manifest);

$manifestFile = $viewsRoot . '/_manifest.php';
$manifestContent = "<?php\n\nreturn " . var_export($manifest, true) . ";\n";

if (file_put_contents($manifestFile, $manifestContent) === false) {
    fwrite(STDERR, "Failed to write manifest file.\n");
    exit(1);
}

echo "Generated {$generated} CodeIgniter views.\n";

function buildViewPath(string $relativePath): string
{
    $segments = explode('/', $relativePath);
    $lastIndex = count($segments) - 1;

    foreach ($segments as $index => $segment) {
        if ($index === $lastIndex) {
            $segment = preg_replace('/\.html$/i', '', $segment) ?? $segment;
        }

        $segments[$index] = encodeSegment($segment);
    }

    return implode('/', $segments);
}

function encodeSegment(string $segment): string
{
    $encoded = rawurlencode($segment);

    if (strlen($encoded) <= 140) {
        return $encoded;
    }

    return substr($encoded, 0, 96) . '--' . md5($segment);
}
