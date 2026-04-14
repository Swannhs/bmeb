<?php

namespace App\Libraries;

class NativePageViewLocator
{
    public function viewNameForFile(string $absolutePath): string
    {
        $relativePath = $this->relativePublicPath($absolutePath);

        return 'generated/' . $this->viewPathFromRelativePublicPath($relativePath);
    }

    public function viewFilePathForFile(string $absolutePath): string
    {
        return APPPATH . 'Views/' . $this->viewNameForFile($absolutePath) . '.php';
    }

    public function hasViewForFile(string $absolutePath): bool
    {
        return is_file($this->viewFilePathForFile($absolutePath));
    }

    public function relativePublicPath(string $absolutePath): string
    {
        return ltrim(str_replace(FCPATH, '', $absolutePath), '/');
    }

    private function viewPathFromRelativePublicPath(string $relativePath): string
    {
        $segments = explode('/', $relativePath);
        $lastIndex = count($segments) - 1;

        foreach ($segments as $index => $segment) {
            if ($index === $lastIndex) {
                $segment = preg_replace('/\.html$/i', '', $segment) ?? $segment;
            }

            $segments[$index] = $this->encodeSegment($segment);
        }

        return implode('/', $segments);
    }

    private function encodeSegment(string $segment): string
    {
        $encoded = rawurlencode($segment);

        if (strlen($encoded) <= 140) {
            return $encoded;
        }

        return substr($encoded, 0, 96) . '--' . md5($segment);
    }
}
