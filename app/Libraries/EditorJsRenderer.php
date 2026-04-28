<?php

namespace App\Libraries;

class EditorJsRenderer
{
    public function render(string $json): string
    {
        $data = json_decode($json, true);
        if (!$data || !isset($data['blocks'])) {
            return $json; // Fallback to raw if not JSON
        }

        $html = '';
        foreach ($data['blocks'] as $block) {
            $html .= $this->renderBlock($block);
        }

        return $html;
    }

    private function renderBlock(array $block): string
    {
        switch ($block['type']) {
            case 'header':
                $level = $block['data']['level'] ?? 2;
                return "<h{$level}>" . $block['data']['text'] . "</h{$level}>";
            
            case 'paragraph':
                return "<p>" . ($block['data']['text'] ?? '') . "</p>";
            
            case 'list':
                $tag = ($block['data']['style'] === 'ordered') ? 'ol' : 'ul';
                $items = '';
                foreach ($block['data']['items'] as $item) {
                    $items .= "<li>{$item}</li>";
                }
                return "<{$tag}>{$items}</{$tag}>";
            
            case 'image':
                $url = $block['data']['file']['url'] ?? '';
                $caption = $block['data']['caption'] ?? '';
                $withBorder = ($block['data']['withBorder'] ?? false) ? 'border' : '';
                $withBackground = ($block['data']['withBackground'] ?? false) ? 'background' : '';
                $stretched = ($block['data']['stretched'] ?? false) ? 'stretched' : '';
                
                return "<figure class=\"editorjs-image {$withBorder} {$withBackground} {$stretched}\">
                            <img src=\"{$url}\" alt=\"{$caption}\">
                            " . ($caption ? "<figcaption>{$caption}</figcaption>" : "") . "
                        </figure>";
            
            case 'table':
                $rows = '';
                foreach ($block['data']['content'] as $row) {
                    $cols = '';
                    foreach ($row as $col) {
                        $cols .= "<td>{$col}</td>";
                    }
                    $rows .= "<tr>{$cols}</tr>";
                }
                return "<table>{$rows}</table>";
            
            case 'quote':
                $text = $block['data']['text'] ?? '';
                $caption = $block['data']['caption'] ?? '';
                return "<blockquote>
                            <p>{$text}</p>
                            " . ($caption ? "<cite>{$caption}</cite>" : "") . "
                        </blockquote>";
            
            case 'delimiter':
                return "<hr>";

            default:
                return "";
        }
    }
}
