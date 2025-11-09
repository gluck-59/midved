<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Markdown
{
    public function parse(string $markdown): string
    {
        $markdown = str_replace(["\r\n", "\r"], "\n", $markdown);
        $markdown = preg_replace('/<!--.*?-->/s', '', $markdown);
        $lines = explode("\n", $markdown);

        $html = '';
        $listOpen = false;
        $codeOpen = false;
        $paragraphBuffer = [];

        foreach ($lines as $line) {
            if (preg_match('/^```/', $line)) {
                $html .= $this->flushParagraph($paragraphBuffer, $listOpen);
                if ($listOpen) {
                    $html .= '</ul>';
                    $listOpen = false;
                }

                if ($codeOpen) {
                    $html .= '</code></pre>';
                    $codeOpen = false;
                } else {
                    $html .= '<pre><code>';
                    $codeOpen = true;
                }
                continue;
            }

            if ($codeOpen) {
                $html .= $this->escape($line).'\n';
                continue;
            }

            if (trim($line) === '') {
                $html .= $this->flushParagraph($paragraphBuffer, $listOpen);
                if ($listOpen) {
                    $html .= '</ul>';
                    $listOpen = false;
                }
                continue;
            }

            if (preg_match('/^(#{1,6})\s+(.*)$/', $line, $matches)) {
                $html .= $this->flushParagraph($paragraphBuffer, $listOpen);
                if ($listOpen) {
                    $html .= '</ul>';
                    $listOpen = false;
                }
                $level = strlen($matches[1]);
                $content = $this->parseInline(trim($matches[2]));
                $html .= '<h'.$level.'>'.$content.'</h'.$level.'>';
                continue;
            }

            if (preg_match('/^[-*]\s+(.*)$/', $line, $matches)) {
                $html .= $this->flushParagraph($paragraphBuffer, $listOpen);
                if (! $listOpen) {
                    $html .= '<ul class="doc-list">';
                    $listOpen = true;
                }
                $html .= '<li>'.$this->parseInline(trim($matches[1])).'</li>';
                continue;
            }

            $paragraphBuffer[] = trim($line);
        }

        if ($codeOpen) {
            $html .= '</code></pre>';
        }

        if ($listOpen) {
            $html .= '</ul>';
        }

        $html .= $this->flushParagraph($paragraphBuffer, false);

        return $html;
    }

    private function flushParagraph(array &$buffer, bool $listOpen): string
    {
        if (empty($buffer)) {
            return '';
        }

        $text = implode(' ', $buffer);
        $buffer = [];
        $content = $this->parseInline($text);
        return '<p>'.$content.'</p>';
    }

    private function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    private function parseInline(string $text): string
    {
        $escaped = $this->escape($text);

        $escaped = preg_replace_callback('/`([^`]+)`/', function ($matches) {
            return '<code>'.$this->escape($matches[1]).'</code>';
        }, $escaped);

        $escaped = preg_replace_callback('/\[([^\]]+)\]\(([^)]+)\)/', function ($matches) {
            $label = $matches[1];
            $rawUrl = trim($matches[2]);
            $transformed = $this->transformLink($rawUrl);
            $url = htmlspecialchars($transformed, ENT_QUOTES, 'UTF-8');
            $attrs = $this->isExternalLink($transformed) ? ' target="_blank" rel="noopener"' : '';
            return '<a href="'.$url.'"'.$attrs.'>'.$label.'</a>';
        }, $escaped);

        $escaped = preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $escaped);
        $escaped = preg_replace('/\*([^*]+)\*/', '<em>$1</em>', $escaped);

        return $escaped;
    }

    private function transformLink(string $url): string
    {
        if ($url === '') {
            return $url;
        }

        if ($this->isExternalLink($url)) {
            return $url;
        }

        if ($url[0] === '#') {
            return $url;
        }

        if (stripos($url, 'README.md') === 0 || strcasecmp($url, 'README') === 0) {
            return '/docs';
        }

        if (substr($url, -3) === '.md') {
            $slug = basename($url, '.md');
            if ($slug === '' || strcasecmp($slug, 'README') === 0) {
                return '/docs';
            }
            return '/docs/'.strtolower($slug);
        }

        if ($url[0] === '/') {
            return $url;
        }

        return $url;
    }

    private function isExternalLink(string $url): bool
    {
        return preg_match('/^(https?:)?\/\//i', $url) === 1;
    }
}
