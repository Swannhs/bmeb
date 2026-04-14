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

        // Try to extract only the main content to avoid double headers/footers
        $mainContent = $bodyContent;
        if (preg_match('/<div class="body">(.*?)<\/div>/is', $bodyContent, $matches) === 1) {
             $mainContent = $matches[1];
        } elseif (preg_match('/<div class="wrapper">(.*?)<\/div>/is', $bodyContent, $matches) === 1) {
             $mainContent = $matches[1];
        }

        // Extract Title from headContent
        $title = 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড';
        if (preg_match('/<title\b[^>]*>(.*?)<\/title>/is', $headContent, $matches) === 1) {
            $title = $matches[1];
        }

        return [
            'doctype'        => $doctype,
            'htmlAttributes' => $htmlAttributes,
            'headContent'    => $headContent,
            'bodyAttributes' => $bodyAttributes,
            'bodyContent'    => $bodyContent,
            'mainContent'    => $mainContent,
            'title'          => $title,
        ];
    }
}
