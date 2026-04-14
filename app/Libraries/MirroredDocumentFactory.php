<?php

namespace App\Libraries;

class MirroredDocumentFactory
{
    /**
     * @return array{
     *   doctype:string,
     *   htmlAttributes:string,
     *   headContent:string,
     *   bodyAttributes:string,
     *   bodyContent:string
     * }
     */
    public function fromFile(string $absolutePath): array
    {
        return $this->fromHtml((string) file_get_contents($absolutePath));
    }

    /**
     * @return array{
     *   doctype:string,
     *   htmlAttributes:string,
     *   headContent:string,
     *   bodyAttributes:string,
     *   bodyContent:string
     * }
     */
    public function fromHtml(string $html): array
    {
        $doctype = '<!DOCTYPE html>';
        $htmlAttributes = '';
        $headContent = '';
        $bodyAttributes = '';
        $bodyContent = $html;

        if (preg_match('/<!DOCTYPE[^>]*>/i', $html, $matches) === 1) {
            $doctype = $matches[0];
        }

        if (preg_match('/<html\b([^>]*)>/i', $html, $matches) === 1) {
            $htmlAttributes = trim($matches[1]);
        }

        if (preg_match('/<head\b[^>]*>(.*?)<\/head>/is', $html, $matches) === 1) {
            $headContent = trim($matches[1]);
        }

        if (preg_match('/<body\b([^>]*)>(.*?)<\/body>/is', $html, $matches) === 1) {
            $bodyAttributes = trim($matches[1]);
            $bodyContent = $matches[2];
        }

        return [
            'doctype'        => $doctype,
            'htmlAttributes' => $htmlAttributes,
            'headContent'    => $headContent,
            'bodyAttributes' => $bodyAttributes,
            'bodyContent'    => $bodyContent,
        ];
    }
}
